<?php
include 'conexao.php';
session_start();

if ($_SESSION['perfil'] !== 'admin') {
    header("Location: index.php");
    exit;
}

$num_ingresso = $_GET['num_ingresso'];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $valor = $_POST['valor'];
    $status = $_POST['status'];

    $sql = "UPDATE ingressos SET valor = '$valor', status = '$status' WHERE num_ingresso = '$num_ingresso'";
    $conn->query($sql);
    header("Location: admin_dashboard.php");
    exit;
}

$sql = "SELECT * FROM ingressos WHERE num_ingresso = '$num_ingresso'";
$result = $conn->query($sql);
$ingresso = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Ingresso</title>
</head>
<body>
    <h1>Editar Ingresso</h1>
    <form method="POST">
        Valor: <input type="number" name="valor" value="<?= $ingresso['valor'] ?>" required><br>
        Status: 
        <select name="status" required>
            <option value="1" <?= $ingresso['status'] == 1 ? 'selected' : '' ?>>Disponível</option>
            <option value="0" <?= $ingresso['status'] == 0 ? 'selected' : '' ?>>Vendido</option>
        </select><br>
        <input type="submit" value="Salvar Alterações">
    </form>
    <br>
    <a href="admin_dashboard.php">Voltar</a>
</body>
</html>