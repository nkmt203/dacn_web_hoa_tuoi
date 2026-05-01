<?php
function loadEnv($path)
{
    if (!file_exists($path)) {
        die(".env file not found");
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;

        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

loadEnv(__DIR__ . '/../.env');

function pdo_connect()
{
    $mode = $_ENV['APP_ENV'] ?? 'local';

    if ($mode === 'local') {
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dbname = $_ENV['DB_NAME'];
        $user = $_ENV['DB_USER'];
        $pass = $_ENV['DB_PASS'];
    } else {
        $host = $_ENV['AIVEN_DB_HOST'];
        $port = $_ENV['AIVEN_DB_PORT'];
        $dbname = $_ENV['AIVEN_DB_NAME'];
        $user = $_ENV['AIVEN_DB_USER'];
        $pass = $_ENV['AIVEN_DB_PASS'];
    }

    try {
        $conn = new PDO(
            "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4",
            $user,
            $pass
        );

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}
