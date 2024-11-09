<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Compras</title>
</head>
<body>
    <h1>Lista de Compras</h1>
    <table border="1">
        <tr>
            <th>Cliente (CPF)</th>
            <th>Ingresso</th>
            <th>Tipo</th>
            <th>Status</th>
        </tr>
        <?php
        $sql = "SELECT vendas.*, cliente.nome FROM vendas JOIN cliente ON vendas.cpf = cliente.cpf";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['cpf']}</td>
                    <td>{$row['num_ingresso']}</td>
                    <td>{$row['tipo']}</td>
                    <td>{$row['status']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhuma compra realizada</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
