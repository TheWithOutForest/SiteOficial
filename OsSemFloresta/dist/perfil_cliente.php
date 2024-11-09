<?php
include 'conexao.php';
session_start();

// Verifica se o cliente está logado
if (!isset($_SESSION['cpf']) || $_SESSION['perfil'] !== 'cliente') {
    header("Location: login.php");
    exit;
}

$cpf_cliente = $_SESSION['cpf'];

// Buscar informações do cliente
$sql_cliente = "SELECT * FROM cliente WHERE cpf = '$cpf_cliente'";
$result_cliente = $conn->query($sql_cliente);
$cliente = $result_cliente->fetch_assoc();

// Buscar ingressos comprados pelo cliente
$sql_ingressos = "SELECT i.num_ingresso, i.valor, i.status, i.dt_hr_compra, l.nome_fazenda 
                  FROM ingressos i 
                  JOIN locais l ON i.id_fazenda = l.id_fazenda
                  WHERE i.cpf_cliente = '$cpf_cliente' AND i.status = 0";
$result_ingressos = $conn->query($sql_ingressos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Perfil do Cliente</h1>

    <h2>Informações Pessoais</h2>
    <p><strong>Nome:</strong> <?= $cliente['nome'] ?></p>
    <p><strong>Endereço:</strong> <?= $cliente['endereco_cliente'] ?></p>
    <p><strong>Telefone:</strong> <?= $cliente['telefone'] ?></p>

    <h2>Ingressos Comprados</h2>
    <?php if ($result_ingressos->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Número do Ingresso</th>
                <th>Nome da Fazenda</th>
                <th>Valor</th>
                <th>Data da Compra</th>
                <th>Status</th>
            </tr>
            <?php while ($ingresso = $result_ingressos->fetch_assoc()): ?>
                <tr>
                    <td><?= $ingresso['num_ingresso'] ?></td>
                    <td><?= $ingresso['nome_fazenda'] ?></td>
                    <td>R$ <?= number_format($ingresso['valor'], 2, ',', '.') ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($ingresso['dt_hr_compra'])) ?></td>
                    <td><?= $ingresso['status'] == 0 ? 'Pago' : 'Pendente' ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Você ainda não possui ingressos comprados.</p>
    <?php endif; ?>

    <br>
    <a href="index.php">Voltar para a Página Inicial</a> | <a href="logout.php">Logout</a>
</body>
</html>