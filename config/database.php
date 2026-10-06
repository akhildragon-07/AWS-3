<?php
/**
 * Database Configuration & RDS MySQL Connection Manager
 * Secure, prepared-statement based PDO connection using environment variables.
 * NO HARD-CODED CREDENTIALS.
 */

// Load .env variables if present
(function() {
    $envPath = __DIR__ . '/../.env';
    if (!file_exists($envPath)) {
        return;
    }

    // Try Composer dotenv if installed
    if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
        require_once __DIR__ . '/../vendor/autoload.php';
        if (class_exists('Dotenv\Dotenv')) {
            $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->safeLoad();
            return;
        }
    }

    // Robust built-in .env parser fallback
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || strpos($line, '#') === 0) {
            continue;
        }
        if (strpos($line, '=') !== false) {
            list($name, $value) = explode('=', $line, 2);
            $name = trim($name);
            $value = trim($value);
            // Remove surrounding quotes if present
            $value = preg_replace('/^([\'"])(.*)\1$/', '$2', $value);
            if (!isset($_SERVER[$name]) && !isset($_ENV[$name])) {
                putenv("{$name}={$value}");
                $_ENV[$name] = $value;
                $_SERVER[$name] = $value;
            }
        }
    }
})();

/**
 * Returns a PDO database connection instance to Amazon RDS MySQL.
 *
 * @return PDO|null Returns PDO on success, null on failure.
 */
function getDbConnection() {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? ($_SERVER['DB_HOST'] ?? ''));
    $name = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? ($_SERVER['DB_NAME'] ?? 'student_portfolio'));
    $user = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? ($_SERVER['DB_USER'] ?? ''));
    $pass = getenv('DB_PASSWORD') ?: ($_ENV['DB_PASSWORD'] ?? ($_SERVER['DB_PASSWORD'] ?? ''));
    $port = getenv('DB_PORT') ?: ($_ENV['DB_PORT'] ?? ($_SERVER['DB_PORT'] ?? 3306));

    // If host is empty, RDS is not configured yet
    if (empty($host) || empty($user)) {
        error_log("RDS Connection notice: DB_HOST or DB_USER not configured in environment variables.");
        return null;
    }

    $dsn = "mysql:host={$host};port={$port};dbname={$name};charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::ATTR_TIMEOUT            => 5, // 5 second timeout for graceful degradation
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Secure server-side error logging - NEVER output raw message/password to user
        error_log("Database connection failure: " . $e->getMessage());
        return null;
    }
}

/**
 * Retrieve academic records from Amazon RDS MySQL.
 * Strictly prepared statements and clean output sanitization.
 * Schema: id, institution, degree, program, qualification, percentage, year.
 *
 * @return array
 */
function getAcademicRecords() {
    $pdo = getDbConnection();

    if ($pdo === null) {
        // Fallback for demonstration / local testing if RDS is not reachable
        $allowMock = (getenv('APP_ENV') === 'development' || !empty($_GET['mock']));
        if ($allowMock) {
            return [
                'success' => true,
                'is_mock' => true,
                'source'  => 'Local Simulated Fallback (Configure .env for Live Amazon RDS)',
                'records' => [
                    [
                        'id' => 1,
                        'institution' => 'VIT-AP University',
                        'degree' => 'B.Tech',
                        'program' => 'Computer Science & Engineering (AI & ML)',
                        'qualification' => 'Undergraduate (Third Year)',
                        'percentage' => null,
                        'year' => '2022 - 2026'
                    ],
                    [
                        'id' => 2,
                        'institution' => 'Velammal Vidyalaya CBSE, Theni',
                        'degree' => 'Senior Secondary',
                        'program' => 'Class XII (CBSE)',
                        'qualification' => 'Class XII',
                        'percentage' => '87.20',
                        'year' => '2021 - 2022'
                    ],
                    [
                        'id' => 3,
                        'institution' => 'Velammal Vidyalaya CBSE, Theni',
                        'degree' => 'Secondary',
                        'program' => 'Class X (CBSE)',
                        'qualification' => 'Class X',
                        'percentage' => '91.80',
                        'year' => '2019 - 2020'
                    ]
                ]
            ];
        }

        return [
            'success' => false,
            'is_mock' => false,
            'source'  => 'Amazon RDS MySQL',
            'error'   => 'Unable to retrieve academic records at the moment.',
            'records' => []
        ];
    }

    try {
        // Prepared statement query - explicitly querying defined columns
        $stmt = $pdo->prepare("SELECT id, institution, degree, program, qualification, percentage, year FROM academic_records ORDER BY id ASC");
        $stmt->execute();
        $records = $stmt->fetchAll();

        return [
            'success' => true,
            'is_mock' => false,
            'source'  => 'Amazon RDS MySQL',
            'records' => $records
        ];
    } catch (PDOException $e) {
        error_log("Academic records query error: " . $e->getMessage());
        return [
            'success' => false,
            'is_mock' => false,
            'source'  => 'Amazon RDS MySQL',
            'error'   => 'Unable to retrieve academic records at the moment.',
            'records' => []
        ];
    }
}
