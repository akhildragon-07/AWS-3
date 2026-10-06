<?php
/**
 * DynamoDB Seed Script (PHP CLI)
 * Table: student_portfolio
 * Run via: php scripts/seed_dynamodb.php
 */

require_once __DIR__ . '/../config/database.php';

// Check if vendor exists for AWS SDK
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    require_once __DIR__ . '/../vendor/autoload.php';
} else {
    echo "[!] Composer dependencies not found. Please run 'composer install' first.\n";
    exit(1);
}

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use Aws\Exception\AwsException;

$region = getenv('AWS_REGION') ?: 'us-east-1';
$tableName = getenv('DYNAMODB_TABLE') ?: 'student_portfolio';

$sdkParams = [
    'region'  => $region,
    'version' => 'latest'
];

$client = new DynamoDbClient($sdkParams);
$marshaler = new Marshaler();

echo "[*] Connecting to DynamoDB (Region: $region, Table: $tableName)...\n";

$studentId = 'akhil-rajan-p';
$items = [
    [
        'student_id'  => $studentId,
        'category'    => 'skills',
        'name'        => 'Technical Skills',
        'items'       => [
            'Python', 'Java', 'JavaScript', 'C', 'C++',
            'FastAPI', 'OpenCV', 'HTML', 'CSS',
            'MongoDB', 'SQLite', 'SQLAlchemy',
            'Git', 'GitHub', 'Postman', 'VS Code'
        ],
        'groups'      => [
            'Programming Languages' => ['Python', 'Java', 'JavaScript', 'C', 'C++'],
            'Frameworks & Web'      => ['FastAPI', 'OpenCV', 'HTML', 'CSS'],
            'Databases'             => ['MongoDB', 'SQLite', 'SQLAlchemy'],
            'Developer Tools'       => ['Git', 'GitHub', 'Postman', 'VS Code']
        ],
        'description' => 'Core programming languages, frameworks, databases, and developer tools.'
    ],
    [
        'student_id'  => $studentId,
        'category'    => 'certifications',
        'name'        => 'Certifications',
        'items'       => [
            'IBM Agentic AI Internship Certificate'
        ],
        'description' => 'Recognized credential validating practical engineering capability in Agentic AI workflows, prompt optimization, and AI application development.',
        'issuer'      => 'IBM'
    ],
    [
        'student_id'  => $studentId,
        'category'    => 'extracurricular',
        'name'        => 'Extracurricular Activities',
        'items'       => [
            'Member – IIAIC Club, VIT-AP University'
        ],
        'description' => 'Active member of IIAIC Club at VIT-AP University participating in technical initiatives, workshops, and AI collaboration.',
        'organization'=> 'VIT-AP University'
    ]
];

foreach ($items as $item) {
    try {
        $client->putItem([
            'TableName' => $tableName,
            'Item'      => $marshaler->marshalItem($item)
        ]);
        echo "[✓] Inserted category: {$item['category']} ({$item['name']})\n";
    } catch (AwsException $e) {
        echo "[!] Error writing item {$item['category']}: " . $e->getAwsErrorMessage() . "\n";
    }
}

echo "[✓] Seeding completed.\n";
