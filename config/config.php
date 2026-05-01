<?php

function loadEnv($path)
{
    if (!file_exists($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;

        list($key, $value) = explode('=', $line, 2);
        $_ENV[trim($key)] = trim($value);
    }
}

loadEnv(__DIR__ . '/../.env');

function envValue($key, $default = null)
{
    return $_ENV[$key] ?? getenv($key) ?? $default;
}

function pdo_connect()
{
    $mode = envValue('APP_ENV', 'local');

    if ($mode === 'local') {
        $host = envValue('DB_HOST');
        $port = envValue('DB_PORT');
        $dbname = envValue('DB_NAME');
        $user = envValue('DB_USER');
        $pass = envValue('DB_PASS');
    } else {
        $host = envValue('AIVEN_DB_HOST');
        $port = envValue('AIVEN_DB_PORT');
        $dbname = envValue('AIVEN_DB_NAME');
        $user = envValue('AIVEN_DB_USER');
        $pass = envValue('AIVEN_DB_PASS');
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