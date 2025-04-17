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
        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        h1, h2 {
            color: #2c3e50;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        form {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        label {
            font-weight: 500;
        }

        input {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-top: 5px;
            width: 100%;
        }

        button {
            grid-column: span 2;
            padding: 12px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        button:hover {
            background: #2980b9;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .mensagem {
            background: #e0fbe0;
            color: #2d7a2d;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
            border: 1px solid #b6e4b6;
        }

        @media (max-width: 600px) {
            form {
                grid-template-columns: 1fr;
            }

            button {
                grid-column: span 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro de Vendedor</h1>

        <?php if ($mensagem): ?>
            <div class="mensagem"><?= $mensagem ?></div>
        <?php endif; ?>

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
    </div>
</body>
</html>
