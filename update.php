<?php
include 'conexao.php';

if (isset($_GET['cpf'])) {
    $cpf_antigo = $_GET['cpf'];

    // Busca os dados do cliente pelo CPF
    $sql = "SELECT * FROM cliente WHERE cpf = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $cpf_antigo);
    $stmt->execute();
    $result = $stmt->get_result();
    $cliente = $result->fetch_assoc();

    if (!$cliente) {
        echo "Cliente não encontrado!";
        exit();
    }

    // Verifica se o formulário foi enviado para atualizar os dados
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $cpf_novo = $_POST['cpf'];
        $nome = $_POST['nome'];
        $endereco_cliente = $_POST['endereco_cliente'];
        $telefone = $_POST['telefone'];

        // Inicia uma transação para garantir a integridade dos dados
        $conn->begin_transaction();

        try {
            // Atualiza os dados na tabela cliente
            $sql = "UPDATE cliente SET cpf = ?, nome = ?, endereco_cliente = ?, telefone = ? WHERE cpf = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $cpf_novo, $nome, $endereco_cliente, $telefone, $cpf_antigo);
            $stmt->execute();

            // Atualiza o CPF na tabela usuarios
            $sql = "UPDATE usuarios SET cpf = ? WHERE cpf = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $cpf_novo, $cpf_antigo);
            $stmt->execute();

            // Confirma a transação
            $conn->commit();

            echo "Dados atualizados com sucesso!";
            header("Location: listar.php"); // Redireciona para a página de listagem
            exit();
        } catch (Exception $e) {
            // Em caso de erro, desfaz a transação
            $conn->rollback();
            echo "Erro ao atualizar os dados: " . $e->getMessage();
        }
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>Editar Cliente</title>
    <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
    <link href="css/styles.css" rel="stylesheet"/>

</head>
<body>
    <div class="container mt-5">
        <h2>Editar Cliente</h2>
        <form method="POST">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cliente['cpf']; ?>" required>
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
</body>
</html>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f9;
    color: #333;
}

.container {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 30px;
    max-width: 600px;
    margin: auto;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #444;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: bold;
    color: #555;
    margin-bottom: 5px;
    display: block;
}

input.form-control {
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    width: 100%;
    font-size: 16px;
    transition: border-color 0.3s;
}

input.form-control:focus {
    border-color: #FFC107; 
    outline: none;
}

button.btn-primary {
    background-color: #FFC107; 
    border: none;
    padding: 12px 20px;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    width: 100%;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button.btn-primary:hover {
    background-color: #FFC107; 
}

button.btn-secondary {
    background-color: #6c757d;
    border: none;
    padding: 12px 20px;
    color: white;
    font-size: 16px;
    border-radius: 5px;
    display: block;
    width: 100%;
    text-align: center;
    margin-top: 10px;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

button.btn-secondary:hover {
    background-color: #495057;
}

@media (max-width: 576px) {
    .container {
        padding: 20px;
    }

    button.btn-primary, button.btn-secondary {
        width: 100%;
    }
}

</style>
