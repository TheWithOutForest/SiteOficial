<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_fazenda = $_POST['id_fazenda'];
    $valor = $_POST['valor'];
    $quantidade = $_POST['quantidade'];

    for ($i = 0; $i < $quantidade; $i++) {
        $sql = "INSERT INTO ingressos (valor, status, id_fazenda) VALUES ('$valor', 1, '$id_fazenda')";
        $conn->query($sql);
    }
    echo "Ingressos cadastrados com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Ingresso</title>
</head>
<body>
    <h1>Cadastrar Novo Ingresso</h1>
    <form method="POST">
        Fazenda:
        <select name="id_fazenda" required>
            <?php
            $sql = "SELECT * FROM locais";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id_fazenda']}'>{$row['nome_fazenda']}</option>";
            }
            ?>
        </select><br>
        Valor: <input type="number" name="valor" required><br>
        Quantidade: <input type="number" name="quantidade" required><br>
        <input type="submit" value="Cadastrar">
    </form>
    <br>
    <a href="index.php">Voltar</a>
</body>
</html>
