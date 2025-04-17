<?php
require_once __DIR__ . '/../db/db.php';
require_once __DIR__ . '/user.php';


class Vendedor extends Usuario{
    protected string $telefone;
    protected string $email;

    public function __construct(string $name, string $idade, string $senha, string $cidade, string $telefone, string $email){
        parent::__construct($name, $idade, $senha, $cidade);
        $this->telefone = $telefone;
        $this->email = $email;
    }
    public function exibirPropriedades(): void {
        echo "Nome: " . $this->nome;
        echo "Idade: " . $this->idade;
        echo "Cidade: " . $this->cidade;
        echo "Telefone: " . $this->telefone;
        echo "Email: " . $this->email;
    }
    public function salvar()
    {
        $conn = Conexao::conectar();
        $sql = "INSERT INTO vendedores (nome, idade, senha, cidade, telefone, email) VALUES (:nome, :idade, :senha, :cidade, :telefone, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();

    }
    public static function listarTodos() {
        $conn = Conexao::conectar();
        $stmt = $conn->query("SELECT * FROM vendedores ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>