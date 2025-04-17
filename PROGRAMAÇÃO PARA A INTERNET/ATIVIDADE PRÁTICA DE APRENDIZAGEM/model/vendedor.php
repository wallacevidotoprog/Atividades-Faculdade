<?php
class Vendedor extends Usuario{
    protected string $telefone;
    protected string $email;

    public function __construct(string $name, string $idade, string $senha, string $cidade, string $telefone, string $email){
        parent::__construct($name, $idade, $senha, $cidade);
        $this->telefone = $telefone;
        $this->email = $email;
    }
    public function exibirPropriedades(): void {
        echo "Nome: " . $this->name;
        echo "Idade: " . $this->idade;
        echo "Cidade: " . $this->cidade;
        echo "Telefone: " . $this->telefone;
        echo "Email: " . $this->email;
    }
    public function salvar()
    {
        $conn = Conexao::conectar();
        $sql = "INSERT INTO vendedor (name, idade, senha, cidade, telefone, email) VALUES (:name, :idade, :senha, :cidade, :telefone, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':idade', $this->idade);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':cidade', $this->cidade);
        $stmt->bindParam(':telefone', $this->telefone);
        $stmt->bindValue(':email', $this->email);
        $stmt->execute();

    }
}
?>