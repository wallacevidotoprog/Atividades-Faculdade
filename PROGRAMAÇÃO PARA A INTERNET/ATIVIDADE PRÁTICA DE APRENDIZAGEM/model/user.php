<?php
class Usuario{
    protected string $name;
    protected string $idade;
    protected string $senha;
    protected string $cidade;

    public function __construct(string $name, string $idade, string $senha, string $cidade){
        $this->name = $name;
        $this->idade = $idade;
        $this->senha = $senha;
        $this->cidade = $cidade;
    }

    public function salvar(){}
}
?>

