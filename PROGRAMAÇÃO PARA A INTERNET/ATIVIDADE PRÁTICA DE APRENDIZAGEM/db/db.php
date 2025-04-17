<?php
class Conexao{
private static $host = 'localhost';
private static $dbname = 'loja_autopecas';
private static $username = 'root';
private static $password = '';

private static $sqlFile = './init.sql';

public static function conectar(){
    try {
        $conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$username, self::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "✅Conexão com o banco de dados realizada com sucesso!";

        if (file_exists(self::$sqlFile)) {
            echo "🟠 Criando tabelas...";
             $sqlFile = file_get_contents(self::$sqlFile);
             $conn->exec($sqlFile);
             echo "✅Tabelas criadas com sucesso!";           
        }
        else {
            echo "❌ Arquivo SQL não encontrado: " . self::$sqlFile;
        }


        return $conn;
    } catch (PDOException $e) {
        die("❌Erro ao conectar com o banco de dados: " . $e->getMessage());
    }
}
}
?>
