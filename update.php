<?php
include 'conexao.php';

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Busca os dados do cliente pelo CPF
    $sql = "SELECT * FROM cliente WHERE cpf = :cpf";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->execute();
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        echo "Cliente não encontrado!";
        exit();
    }

    // Verifica se o formulário foi enviado para atualizar os dados
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $endereco_cliente = $_POST['endereco_cliente'];
        $telefone = $_POST['telefone'];

        // Atualiza os dados no banco
        $sql = "UPDATE cliente SET nome = :nome, endereco_cliente = :endereco_cliente, telefone = :telefone WHERE cpf = :cpf";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':endereco_cliente', $endereco_cliente);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();

        echo "Dados atualizados com sucesso!";
        header("Location: listar.php"); // Redireciona para a página de listagem
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Editar Cliente</h2>
        <form method="POST">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cliente['cpf']; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?php echo $cliente['nome']; ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco_cliente">Endereço</label>
                <input type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" value="<?php echo $cliente['endereco_cliente']; ?>" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $cliente['telefone']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Atualizar Cliente</button>
        </form>
        <a href="listar.php" class="btn btn-secondary mt-3">Voltar para a Lista</a>
    </div>

    <!-- Inclusão do Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
