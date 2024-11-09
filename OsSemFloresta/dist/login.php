<?php
include 'conecta.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Verificar se o usuário existe
    $sql = "SELECT * FROM usuarios WHERE cpf = '$cpf'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();

        // Verificar a senha
        if (password_verify($senha, $usuario['senha']) || ($senha == '1234' && $usuario['senha'] == '81dc9bdb52d04dc20036dbd8313ed055')) {
            $_SESSION['cpf'] = $usuario['cpf'];
            $_SESSION['perfil'] = $usuario['perfil'];

            if ($usuario['perfil'] == 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: index.php");
            }
            exit;
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
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
    <a href="index.php"><button class="btn-voltar"><h3>Voltar</h3></button></a>
    <div class="login-container">
        <div class="login-box">
          <h2>Login</h2>
          <form action="#" method="post">
            <div class="input-group">
              <span class="icon">👤</span>
              <input type="text" placeholder="Cpf ou Telefone" required>
            </div>
            <div class="input-group">
              <span class="icon">🔒</span>
              <input type="password" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
            <p class="signup-text">sem login? <a href="cadastro.php">Cadastrar-se</a></p>
          </form>
        </div>
      </div>
</body>
</html>