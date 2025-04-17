<?php
require_once __DIR__ . '/../model/vendedor.php';
//require_once __DIR__ . '/../db/db.php';
//require_once __DIR__ . '/model/user.php';

class Conexao{
private static $host = 'localhost';
private static $dbname = 'loja_autopecas';
private static $username = 'root';
private static $password = '';

private static $sqlFile = __DIR__.'/init.sql';

private static $init = false;

public static function conectar(){
    try {
        $conn = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8", self::$username, self::$password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "✅Conexão com o banco de dados realizada com sucesso!";
        // if (self::$init == false) {
        //     self::init($conn);
        // }          
        return $conn;
    } catch (PDOException $e) {
        die("❌Erro ao conectar com o banco de dados: " . $e->getMessage());
    }
}

private static function init($conn) {
    try {
        if (file_exists(self::$sqlFile)) {
            echo "🟠 Criando tabelas...";
             $sqlFile = file_get_contents(self::$sqlFile);
             $conn->exec($sqlFile);
             echo "✅Tabelas criadas com sucesso!";           
        }
        else {
            echo "❌ Arquivo SQL não encontrado: " . self::$sqlFile;
        }
        echo "🟠 Inserindo Vendedor Padrão";

        $stmt = $conn->prepare("SELECT COUNT(*) FROM vendedores WHERE email = :email");
        $stmt->execute(['email' => 'marcospp@bloggs.com']);
        if ($stmt->fetchColumn() > 0) {
            echo "🟠 Vendedor padrão já existe no banco de dados.";
            return;
        }
        else{
            $vendedor = new Vendedor(
                "Marcos Paulo",
                32,
                "Mp?123",
                "São Paulo",
                "011 00345 6000",
                "marcospp@bloggs.com"
            );
            $vendedor->salvar();
            echo "✅Vendedor padrão inserido com sucesso!";
        }
        self::$init = true;

    } catch (\Throwable $th) {
        echo "❌Erro ao inserir vendedor padrão: " . $th->getMessage();
    }    
}

}
?>
