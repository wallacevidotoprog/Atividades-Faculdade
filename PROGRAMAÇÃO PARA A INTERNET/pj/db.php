<?php
function dbConnect() {
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'pj';
    $port = 3306;
    $charset = 'utf8mb4';

    // Verifica se o driver PDO MySQL está disponível
    if (!in_array('mysql', PDO::getAvailableDrivers())) {
        die('PDO MySQL driver não está instalado. Por favor, instale a extensão php-mysql');
    }

    try {
        $dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        
        return new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        error_log('Connection error: ' . $e->getMessage(), 3, 'error.log');
        die('Database connection failed. Check error log for details.');
    }
}

try {
    $pdo = dbConnect();
    echo "Conexão bem-sucedida!";
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>