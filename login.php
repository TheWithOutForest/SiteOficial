<?php
include 'conexao.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['entrar'])) {
    $cpf = $_POST['cpf'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados (valide o SQL para prevenir SQL Injection)
    $query = "SELECT * FROM usuarios WHERE cpf = ? AND senha = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $cpf, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $result->fetch_assoc(); // Salva o usuário na sessão
        header('Location: painel.php'); // Redireciona para o painel do usuário
        exit;
    } else {
        $erro = "CPF ou senha inválidos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css?v=1.0">
    <title>Login</title>
    <link rel="icon" type="image/x-icon" href="assets/icon.ico">
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <a href="index.php"><button class="btn-voltar">Voltar</button></a>
        <h2 class="logintexto">Login</h2>
        <!-- Mensagem de erro exibida aqui -->
        <?php if (isset($erro)): ?>
            <div class="error-msg"><?php echo htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        <form method="POST" action="">
            <div class="input-group">
                <span class="icon"></span>
                <input type="number" name="cpf" placeholder="CPF" required minlength="11" maxlength="11">
            </div>
            <div class="input-group">
                <span class="icon"></span>
                <input type="password" name="senha" placeholder="Senha" required>
            </div>
            <button type="submit" name="entrar" class="btn-login">Entrar</button>
            <p class="signup-text">Novo cliente? <a href="cadastro_cliente.php">Cadastrar-se</a></p>
        </form>
    </div>
</div>

    <?php
                // Verifica se o formulário foi submetido
                if (isset($_POST['entrar'])) {
                    $cpf = $_POST['cpf'];
                    $senha = $_POST['senha'];

                    // Prepara a consulta SQL para evitar SQL Injection
                    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cpf = ?");
                    $stmt->bind_param("s", $cpf);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    // Verifica se o cliente existe
                    if ($result->num_rows > 0) {
                        $usuario = $result->fetch_assoc();

                        // Verificar a senha
                        if (password_verify($senha, $usuario['senha'])) {
                            // Adiciona o CPF e o nome à sessão
                            $_SESSION['cpf'] = $usuario['cpf'];
                            $_SESSION['nome'] = $usuario['nome']; // Nome do cliente
                            $_SESSION['perfil'] = $usuario['perfil'];

                            echo "Login realizado com sucesso!";
                            header("Location: index.php");
                            exit;
                        } else {
                            echo "<p style='color: red;'>Senha incorreta!</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>Cliente não encontrado!</p>";
                    }

                    // Fecha o statement
                    $stmt->close();
                }
            ?>
    
</body>
</html>

