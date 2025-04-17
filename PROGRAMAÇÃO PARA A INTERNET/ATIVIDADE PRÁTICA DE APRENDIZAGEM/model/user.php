<?php
class Usuario{
    protected string $nome;
    protected string $idade;
    protected string $senha;
    protected string $cidade;

    public function __construct(string $nome, string $idade, string $senha, string $cidade){
        $this->nome = $nome;
        $this->idade = $idade;
        $this->senha = $senha;
        $this->cidade = $cidade;
    }

    public function salvar(){}
}
?>

