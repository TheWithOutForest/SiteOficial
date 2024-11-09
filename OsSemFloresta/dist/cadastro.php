<?php
include 'conecta.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    // Verificar se o cliente já existe
    $check_sql = "SELECT * FROM cliente WHERE cpf = '$cpf'";
    $result = $conn->query($check_sql);

    if ($result->num_rows > 0) {
        echo "Cliente já cadastrado!";
    } else {
        // Inserir novo cliente
        $sql = "INSERT INTO cliente (cpf, nome, endereco_cliente, telefone) VALUES ('$cpf', '$nome', '$endereco', '$telefone')";
        $usuario_sql = "INSERT INTO usuarios (cpf, senha, perfil) VALUES ('$cpf', '$senha', 'cliente')";

        if ($conn->query($sql) === TRUE && $conn->query($usuario_sql) === TRUE) {
            echo "Cliente cadastrado com sucesso!";
        } else {
            echo "Erro: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cadastro.css">
    <title>Cadastro</title>
    <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <a href="login.html"><button type="submit" class="btn-voltar"><h3>voltar</h3></button></a>
            <div class="escrit">
                <h2>Seja bem-vindo!</h2>
                <p>Crie sua conta para aproveitar conteúdos exclusivos e se conectar com nossa comunidade!</p>
                <a href="login.php"><button class="btn-signin">LOGIN</button></a>
            </div>
        </div>
        <div class="right-panel">
          <h2>Criar conta</h2>
          <p>Use seu e-mail para o registro:</p>
          <form action="#" method="post">
            <div class="input-group">
              <input type="text" placeholder="Cpf" required>
            </div>
            <div class="input-group">
              <input type="email" placeholder="Nome" required>
            </div>
            <div class="input-group">
              <input type="text" placeholder="Endereço" required>
            </div>
            <div class="input-group">
              <input type="number" placeholder="Telefone" required>
            </div>
            <div class="input-group">
              <input type="password" placeholder="Senha" required>
            </div>
            <button type="submit" class="btn-signup">Cadastrar-se</button>
          </form>
        </div>
      </div>
</body>
</html>