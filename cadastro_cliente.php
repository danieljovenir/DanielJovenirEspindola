<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['tempoSessao'])) {
    $tempoTotal = 300;
    $tempoDecorrido = time() - $_SESSION['tempoSessao'];
    if ($tempoDecorrido > $tempoTotal) {
        session_unset();
        session_destroy();
        echo "<script language='javascript' type='text/javascript'>alert('Sessão expirada. Por favor, faça o login novamente.'); window.location.href='index.html';</script>";
        exit();
    } else {
        $tempoRestante = $tempoTotal - $tempoDecorrido;
        echo 'Sessão ativa. Tempo restante: ' . gmdate('H:i:s', $tempoRestante);
    }
} else {
    echo "Sessão não iniciada";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro de Clientes</h1>
        <form action="cadastrar_cliente.php" method="post">
            <input type="text" name="username" placeholder="Usuário">
            <input type="password" name="password" placeholder="Senha">
            <input type="submit" value="Entrar">
        </form>
        <a href="busca_clientes.php">Consultar Cadastro Cliente</a>
    </div>
</body>
</html>
