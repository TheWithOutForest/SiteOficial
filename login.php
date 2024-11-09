<?php
include 'conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Verificar se o cliente existe
    $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        
        // Verificar a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['cpf'] = $usuario['cpf'];
            $_SESSION['perfil'] = $usuario['perfil'];
            
            echo "Login realizado com sucesso!";
            header("Location: index.php");
            exit;
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Cliente não encontrado!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/estilo.css" rel="stylesheet"/>
</head>
<body>
    <h1>Login de Cliente</h1>
    <form method="POST">
        CPF: <input type="number" name="cpf" required><br>
        Senha: <input type="password" name="senha" required><br>
        <input type="submit" value="Entrar">
    </form>
    <br>
    <a href="cadastro_cliente.php">Cadastrar Novo Cliente</a>
</body>
</html>
