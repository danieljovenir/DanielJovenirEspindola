<?php
require_once 'conexao.php';

function listarTodosClientes() {
    global $pdo;

    $sql = "SELECT * FROM cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$clientes = [];

if (isset($_GET['busca'])) {
    $termo_busca = '%' . $_GET['busca'] . '%';

    function buscarClientes($filtro) {
        global $pdo;

        $sql = "SELECT * FROM cliente WHERE nome ILIKE :filtro";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':filtro', $filtro);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $clientes = buscarClientes($termo_busca);
} else {
    $clientes = listarTodosClientes();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Resultado da Busca</title>
    <style>
        /* Estilos da tabela mantidos para fácil leitura */
    </style>
</head>
<body>
    <h1>Resultado da Busca</h1>
    <form action="" method="get">
        <label for="busca">Buscar Cliente:</label>
        <input type="text" id="busca" name="busca" placeholder="Digite o nome do cliente">
        <input type="submit" value="Buscar">
    </form>
    <?php if (isset($termo_busca)): ?>
        <p>Resultados para: <?= htmlspecialchars($_GET['busca']) ?></p>
    <?php endif; ?>
    <table>
        <tr>
            <th>Nome</th>
            <th>Sobrenome</th>
            <th>Data de Nascimento</th>
            <th>Email</th>
        </tr>
        <?php foreach ($clientes as $cliente): ?>
            <tr>
                <td><?= $cliente['nome'] ?></td>
                <td><?= $cliente['sobrenome'] ?></td>
                <td><?= $cliente['data_nascimento'] ?></td>
                <td><?= $cliente['email'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>
    <a href="cadastro_cliente.php">Voltar para a tela de Cadastro</a>
</body>
</html>
