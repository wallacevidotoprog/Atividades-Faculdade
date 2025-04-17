<?php
require_once './model/vendedor.php';

$menssagem = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vendedor = new Vendedor(
        $_POST['nome'],
        $_POST['idade'],
        $_POST['senha'],
        $_POST['cidade'],
        $_POST['telefone'],
        $_POST['email']
    );

    $vendedor->salvar();
    $mensagem = "Vendedor cadastrado com sucesso!";
}
$vendedores = Vendedor::listarTodos();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Vendedores</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        form {
            margin-bottom: 30px;
        }
        input, label {
            display: block;
            margin-bottom: 10px;
            width: 300px;
        }
        table {
            border-collapse: collapse;
            width: 90%;
        }
        th, td {
            border: 1px solid #999;
            padding: 8px;
        }
        th {
            background-color: #eee;
        }
        .mensagem {
            color: green;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <h1>Cadastro de Vendedor</h1>

   

    <form method="POST">
        <label>Nome:
            <input type="text" name="nome" required>
        </label>
        <label>Idade:
            <input type="number" name="idade" required>
        </label>
        <label>Senha:
            <input type="password" name="senha" required>
        </label>
        <label>Cidade:
            <input type="text" name="cidade" required>
        </label>
        <label>Telefone:
            <input type="text" name="telefone" required>
        </label>
        <label>Email:
            <input type="email" name="email" required>
        </label>
        <button type="submit">Cadastrar</button>
    </form>

    <h2>Vendedores Cadastrados</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Idade</th>
            <th>Cidade</th>
            <th>Telefone</th>
            <th>Email</th>
        </tr>
        <?php foreach ($vendedores as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= htmlspecialchars($v['nome']) ?></td>
                <td><?= $v['idade'] ?></td>
                <td><?= htmlspecialchars($v['cidade']) ?></td>
                <td><?= htmlspecialchars($v['telefone']) ?></td>
                <td><?= htmlspecialchars($v['email']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <?php if ($mensagem): ?>
        <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>
</body>
</html>