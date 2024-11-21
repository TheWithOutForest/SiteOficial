<?php
include 'conexao.php';
$message = ""; // Variável para armazenar a mensagem de feedback

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    // Verificar se o cliente já existe
    $check_sql = $conn->prepare("SELECT * FROM cliente WHERE cpf = ?");
    $check_sql->bind_param("s", $cpf);
    $check_sql->execute(); 
    $result = $check_sql->get_result();

    if ($result->num_rows > 0) {
        $message = "CADASTRE-SE";
    } else {
        // Inserir novo cliente
        $sql = $conn->prepare("INSERT INTO cliente (cpf, nome, endereco_cliente, telefone) VALUES (?, ?, ?, ?)");
        $sql->bind_param("ssss", $cpf, $nome, $endereco, $telefone);

        // Inserir novo usuário
        $usuario_sql = $conn->prepare("INSERT INTO usuarios (cpf, senha, perfil) VALUES (?, ?, 'cliente')");
        $usuario_sql->bind_param("ss", $cpf, $senha);

        // Executar as consultas preparadas
        if ($sql->execute() && $usuario_sql->execute()) {
            $message = "Cliente cadastrado com sucesso!";
            $success = true; // Variável para indicar sucesso
        } else {
            $message = "Erro ao cadastrar cliente: " . $conn->error;
        }

        // Fechar as consultas preparadas
        if (isset($sql)) {
            $sql->close();
        }
        if (isset($usuario_sql)) {
            $usuario_sql->close();
        }
    }

    // Fechar a consulta de verificação
    $check_sql->close();
}

// Fechar a conexão com o banco de dados
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
</head>

<body>
    <div class="container">
        <div class="left-panel">
            <div class="escrit">
                <h2>Seja bem-vindo!</h2>
                <p>Crie sua conta para aproveitar conteúdos exclusivos e se conectar com nossa comunidade!</p>
                <a href="login.php"><button class="btn-signin">LOGIN</button></a>
            </div>
        </div>

        <div class="right-panel">
            <h2>Criar conta</h2>
            <p>Use seu e-mail para o registro:</p>

            <form action="#" method="POST">
                <div class="input-group">
                    <input type="number" name="cpf" placeholder="CPF" required>
                </div>
                <div class="input-group">
                    <input type="text" name="nome" placeholder="Nome Completo" required>
                </div>
                <div class="input-group">
                    <input type="text" name="endereco" placeholder="Endereço" required>
                </div>
                <div class="input-group">
                    <input type="text" name="telefone" placeholder="Telefone" required>
                </div>
                <div class="input-group">
                    <input type="password" name="senha" placeholder="Senha" required>
                </div>
                <input type="submit" value="Cadastrar" class="btn-signup">
                <!-- Exibir mensagem de sucesso ou erro -->
                <?php if (!empty($message)): ?>
                    <p class="message"><?= $message ?></p>
                <?php endif; ?>

                <!-- Botão para redirecionar após sucesso -->
                <?php if (isset($success) && $success): ?>
                    <a href="index.php" class="btn-voltar">Ir Para a Página Inicial</a>
                <?php endif; ?>
            </form>
        </div>
    </div>
</body>
</html>
