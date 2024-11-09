<?php
include 'conexao.php';

if (isset($_GET['id_fazenda'])) {
    $id_fazenda = $_GET['id_fazenda'];
    $sql = "SELECT * FROM ingressos WHERE id_fazenda=$id_fazenda AND status=1";
    $result = $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_ingresso = $_POST['num_ingresso'];
    $cpf = $_POST['cpf'];

    // Registrar venda
    $sql = "INSERT INTO vendas (num_ingresso, cpf, tipo, status) VALUES ('$num_ingresso', '$cpf', 'Normal', 'Confirmado')";
    $conn->query($sql);

    // Atualizar status do ingresso
    $sql = "UPDATE ingressos SET status=0 WHERE num_ingresso=$num_ingresso";
    $conn->query($sql);
    echo "Compra realizada com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Comprar Ingresso</title>
</head>
<body>
    <h1>Comprar Ingresso</h1>
    <form method="POST">
        Cliente (CPF): <input type="number" name="cpf" required><br>
        <label>Escolha o ingresso:</label>
        <select name="num_ingresso" required>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['num_ingresso']}'>Ingresso {$row['num_ingresso']} - R$ {$row['valor']}</option>";
                }
            } else {
                echo "<option disabled>Nenhum ingresso disponível</option>";
            }
            ?>
        </select><br>
        <input type="submit" value="Comprar">
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
