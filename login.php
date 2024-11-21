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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
        <a href="index.php"><button class="btn-voltar">voltar</button></a>
            <h2>Login</h2>
            <form method="POST">
                <div class="input-group">
                    <span class="icon">👤</span>
                    <input type="number" name="cpf" placeholder="CPF" required>
                </div>
                <div class="input-group">
                    <span class="icon">🔒</span>
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                <button type="submit" class="btn-login">Entrar</button>
                <p class="signup-text">Novo cliente? <a href="cadastro_cliente.php">Cadastrar-se</a></p>
            </form>
        </div>
    </div>
</body>
</html>