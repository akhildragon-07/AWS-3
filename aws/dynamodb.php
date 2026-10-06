<?php
/**
 * Amazon DynamoDB Service Integration
 * Uses AWS SDK for PHP with EC2 IAM Role default credentials provider.
 * NO HARD-CODED AWS KEYS.
 */

require_once __DIR__ . '/../config/database.php';

/**
 * Returns an instance of the AWS DynamoDB Client.
 *
 * @return \Aws\DynamoDb\DynamoDbClient|null
 */
function getDynamoDbClient() {
    static $client = null;

    if ($client !== null) {
        return $client;
    }

    if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
        error_log("AWS SDK not found. Please run 'composer require aws/aws-sdk-php' on EC2.");
        return null;
    }

    require_once __DIR__ . '/../vendor/autoload.php';

    if (!class_exists('Aws\DynamoDb\DynamoDbClient')) {
        return null;
    }

    $region = getenv('AWS_REGION') ?: ($_ENV['AWS_REGION'] ?? ($_SERVER['AWS_REGION'] ?? 'us-east-1'));

    // AWS SDK automatically uses EC2 Instance Profile / IAM Role when no hardcoded keys are passed.
    $config = [
        'region'  => $region,
        'version' => 'latest',
        'http'    => [
            'timeout' => 5 // 5 second timeout for responsiveness
        ]
    ];

    try {
        $client = new \Aws\DynamoDb\DynamoDbClient($config);
        return $client;
    } catch (\Exception $e) {
        error_log("DynamoDB client initialization error: " . $e->getMessage());
        return null;
    }
}

/**
 * Fetch student portfolio information (Skills, Certifications, Extracurriculars) from DynamoDB.
 *
 * @param string $studentId
 * @return array
 */
function getStudentPortfolioData($studentId = 'akhil-rajan-p') {
    $tableName = getenv('DYNAMODB_TABLE') ?: ($_ENV['DYNAMODB_TABLE'] ?? ($_SERVER['DYNAMODB_TABLE'] ?? 'student_portfolio'));
    $client = getDynamoDbClient();

    if ($client === null) {
        $allowMock = (getenv('APP_ENV') === 'development' || !empty($_GET['mock']));
        if ($allowMock) {
            return [
                'success' => true,
                'is_mock' => true,
                'source'  => 'Local Simulated Fallback (Configure .env & AWS SDK for Live DynamoDB)',
                'data'    => getMockDynamoDbData()
            ];
        }

        return [
            'success' => false,
            'is_mock' => false,
            'source'  => 'Amazon DynamoDB',
            'error'   => 'Unable to retrieve skills information at the moment.',
            'data'    => []
        ];
    }

    try {
        $marshaler = new \Aws\DynamoDb\Marshaler();

        // Query DynamoDB using partition key student_id
        $result = $client->query([
            'TableName' => $tableName,
            'KeyConditionExpression' => 'student_id = :sid',
            'ExpressionAttributeValues' => [
                ':sid' => ['S' => $studentId]
            ]
        ]);

        $structured = [
            'skills'          => null,
            'certifications'  => null,
            'extracurricular' => null
        ];

        foreach ($result['Items'] as $item) {
            $unmarshaled = $marshaler->unmarshalItem($item);
            $cat = $unmarshaled['category'] ?? '';
            if (isset($structured[$cat])) {
                $structured[$cat] = $unmarshaled;
            }
        }

        return [
            'success' => true,
            'is_mock' => false,
            'source'  => 'Amazon DynamoDB',
            'data'    => $structured
        ];

    } catch (\Aws\Exception\AwsException $e) {
        error_log("DynamoDB Query AWS Exception: " . $e->getAwsErrorMessage());
        
        $allowMock = (getenv('APP_ENV') === 'development' || !empty($_GET['mock']));
        if ($allowMock) {
            return [
                'success' => true,
                'is_mock' => true,
                'source'  => 'Local Simulated Fallback (Configure DynamoDB table for Live data)',
                'data'    => getMockDynamoDbData()
            ];
        }

        return [
            'success' => false,
            'is_mock' => false,
            'source'  => 'Amazon DynamoDB',
            'error'   => 'Unable to retrieve skills information at the moment.',
            'data'    => []
        ];
    } catch (\Exception $e) {
        error_log("DynamoDB General Exception: " . $e->getMessage());
        return [
            'success' => false,
            'is_mock' => false,
            'source'  => 'Amazon DynamoDB',
            'error'   => 'Unable to retrieve skills information at the moment.',
            'data'    => []
        ];
    }
}

/**
 * Fallback student portfolio data matching Akhil Rajan P's verified resume.
 * Used for local testing or graceful demonstration when AWS is not connected.
 *
 * @return array
 */
function getMockDynamoDbData() {
    return [
        'skills' => [
            'student_id' => 'akhil-rajan-p',
            'category'   => 'skills',
            'name'       => 'Technical Skills',
            'items'      => [
                'Python', 'Java', 'JavaScript', 'C', 'C++',
                'FastAPI', 'OpenCV', 'HTML', 'CSS',
                'MongoDB', 'SQLite', 'SQLAlchemy',
                'Git', 'GitHub', 'Postman', 'VS Code'
            ],
            'groups'     => [
                'Programming Languages' => ['Python', 'Java', 'JavaScript', 'C', 'C++'],
                'Frameworks & Web'      => ['FastAPI', 'OpenCV', 'HTML', 'CSS'],
                'Databases'             => ['MongoDB', 'SQLite', 'SQLAlchemy'],
                'Developer Tools'       => ['Git', 'GitHub', 'Postman', 'VS Code']
            ],
            'description' => 'Core programming languages, frameworks, databases, and developer tools.'
        ],
        'certifications' => [
            'student_id'  => 'akhil-rajan-p',
            'category'    => 'certifications',
            'name'        => 'Certifications',
            'items'       => [
                'IBM Agentic AI Internship Certificate'
            ],
            'description' => 'Recognized credential validating practical engineering capability in Agentic AI workflows, prompt optimization, and AI application development.',
            'issuer'      => 'IBM'
        ],
        'extracurricular' => [
            'student_id'   => 'akhil-rajan-p',
            'category'     => 'extracurricular',
            'name'         => 'Extracurricular Activities',
            'items'        => [
                'Member – IIAIC Club, VIT-AP University'
            ],
            'description'  => 'Active member of IIAIC Club at VIT-AP University participating in technical initiatives, workshops, and AI collaboration.',
            'organization' => 'VIT-AP University'
        ]
    ];
}
