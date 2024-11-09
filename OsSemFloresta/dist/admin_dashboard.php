<?php
include 'conexao.php';
session_start();

if ($_SESSION['perfil'] !== 'admin') {
    header("Location: index.php");
    exit;
}

// Excluir ingresso
if (isset($_GET['delete'])) {
    $num_ingresso = $_GET['delete'];
    $conn->query("DELETE FROM ingressos WHERE num_ingresso = '$num_ingresso'");
    header("Location: admin_dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Gerenciamento de Ingressos</h1>
    <table border="1">
        <tr>
            <th>Número do Ingresso</th>
            <th>Valor</th>
            <th>Status</th>
            <th>Data de Compra</th>
            <th>ID Fazenda</th>
            <th>Ações</th>
        </tr>
        <?php
        $sql = "SELECT * FROM ingressos";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['num_ingresso']}</td>
                    <td>{$row['valor']}</td>
                    <td>" . ($row['status'] ? 'Disponível' : 'Vendido') . "</td>
                    <td>{$row['dt_hr_compra']}</td>
                    <td>{$row['id_fazenda']}</td>
                    <td>
                        <a href='editar_ingresso.php?num_ingresso={$row['num_ingresso']}'>Editar</a> | 
                        <a href='admin_dashboard.php?delete={$row['num_ingresso']}' onclick="return confirm('Tem certeza que deseja excluir este ingresso?');">Excluir</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>Nenhum ingresso encontrado</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="index.php">Voltar para a Página Inicial</a> | <a href="logout.php">Logout</a>
</body>
</html>