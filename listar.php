<?php
include 'conexao.php';

try {
    // Consulta SQL para pegar todos os cliente
    $sql = "SELECT * FROM cliente";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $cliente = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar cliente: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Clientes Cadastrados</h2>

        <!-- Botões de navegação -->
        <div class="mb-3">
            <a href="create.php" class="btn btn-success">Cadastrar Novo Cliente</a>
            <a href="listar.php" class="btn btn-primary">Listar Todos os Clientes</a>
        </div>

        <!-- Tabela para exibir os clientes -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($cliente): ?>
                    <?php foreach ($cliente as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['id']; ?></td>
                            <td><?php echo $cliente['cpf']; ?></td>
                            <td><?php echo $cliente['nome']; ?></td>
                            <td><?php echo $cliente['endereco_cliente']; ?></td>
                            <td><?php echo $cliente['telefone']; ?></td>
                            <td>
                                <!-- Botões para editar e excluir -->
                                <a href="update.php?cpf=<?php echo $cliente['cpf']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="delete.php?cpf=<?php echo $cliente['cpf']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este cliente?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum cliente encontrado</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Inclusão do Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
