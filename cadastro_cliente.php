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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>
    <link rel="stylesheet" href="css/cadastro.css">
    <link rel="icon" type="image/x-icon" href="assets/icon.ico">
</head>

<body>
    <div class="container">
        <!-- Painel esquerdo com mensagem de boas-vindas -->
        <aside class="left-panel">
            <div class="welcome-message">
                <a href="index.php"><button class="btn-voltar">Voltar</button></a>
                <h2>Seja bem-vindo!</h2>
                <p class="msgcrie">Crie sua conta para poder realizar seu primeiro agendamento no nosso site!</p>
                </a>
            </div>
        </aside>

        <!-- Painel direito com formulário de cadastro -->
        <section class="right-panel">
            <h2 class="txtlogin">Criar conta</h2>

            <form action="#" method="POST">
                <div class="input-group">
                    <label for="cpf">CPF</label>
                    <input type="number" id="cpf" name="cpf" placeholder="CPF" required>
                </div>
                <div class="input-group">
                    <label for="nome">Nome Completo</label>
                    <input type="text" id="nome" name="nome" placeholder="Nome Completo" required>
                </div>
                <div class="input-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" placeholder="Endereço" required>
                </div>
                <div class="input-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" id="telefone" name="telefone" placeholder="Telefone" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                </div>
                <button type="submit" class="btn-signup">Cadastrar</button>

                <!-- Exibir mensagem de sucesso ou erro -->
                <?php if (!empty($message)): ?>
                    <p class="message"><?= htmlspecialchars($message) ?></p>
                <?php endif; ?>

                <!-- Botão para redirecionar após sucesso -->
                <?php if (isset($success) && $success): ?>
                    <a href="login.php" class="btn-voltar">Ir Para a Tela de Login</a>
                <?php endif; ?>
            </form>
        </section>
    </div>
</body>
</html>
