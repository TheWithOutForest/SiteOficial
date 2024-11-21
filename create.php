<?php
include 'conexao.php';
$mensagem = ''; // Variável para armazenar a mensagem de sucesso ou erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recebe os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $endereco_cliente = $_POST['endereco_cliente'];
    $telefone = $_POST['telefone'];

    // Inicia uma transação
    $conn->begin_transaction();

    try {
        // Insere na tabela cliente
        $sql_cliente = "INSERT INTO cliente (cpf, nome, endereco_cliente, telefone) 
                        VALUES (?, ?, ?, ?)";
        $stmt_cliente = $conn->prepare($sql_cliente);

        if (!$stmt_cliente) {
            throw new Exception("Erro ao preparar consulta para tabela 'cliente': " . $conn->error);
        }

        $stmt_cliente->bind_param("ssss", $cpf, $nome, $endereco_cliente, $telefone);
        $stmt_cliente->execute();

        // Insere na tabela usuarios (somente cpf)
        $sql_usuario = "INSERT INTO usuarios (cpf) VALUES (?)";
        $stmt_usuario = $conn->prepare($sql_usuario);

        if (!$stmt_usuario) {
            throw new Exception("Erro ao preparar consulta para tabela 'usuarios': " . $conn->error);
        }

        $stmt_usuario->bind_param("s", $cpf);
        $stmt_usuario->execute();

        // Confirma a transação
        $conn->commit();
        $mensagem = "Cliente cadastrado com sucesso!";
    } catch (Exception $e) {
        // Reverte a transação em caso de erro
        $conn->rollback();
        $mensagem = "Erro ao cadastrar cliente: " . $e->getMessage();
    }
}

// Fecha a conexão
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Os Sem-Floresta</title>
    <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href="css/estilo.css" rel="stylesheet"/>
</head>

<body>
    <!-- Navegação -->
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="index.php">Os Sem-Floresta</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Inicial</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="sobreEspacos.php">Sobre</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="comprar.php">Agendamento</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="equipe.php">Equipe</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="cadastro_cliente.php">Cadastro</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cabeçalho -->
    <header class="masthead" style="background-image: url('assets/img/home.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>Conforto e tranquilidade</h1>
                        <h2>Onde a sua estadia é um refúgio perfeito</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <h2>Cadastrar Novo Cliente</h2>
        <form method="POST">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="endereco_cliente">Endereço</label>
                <input type="text" class="form-control" id="endereco_cliente" name="endereco_cliente" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone</label>
                <input type="text" class="form-control" id="telefone" name="telefone" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar Cliente</button>
        </form>

        <!-- Exibe a mensagem abaixo do formulário -->
        <?php if ($mensagem): ?>
            <div class="mt-3 alert <?php echo strpos($mensagem, 'Erro') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo $mensagem; ?>
            </div>
        <?php endif; ?>

        <a href="listar.php" class="btn btn-secondary mt-3">Voltar para a Lista</a>
    </div>

    <!-- Rodapé -->
    <footer class="border-top mt-5">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <ul class="list-inline text-center">
                        <li class="list-inline-item">
                            <a href="https://www.instagram.com/the_without_forest/">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <img src="assets/img/instaicon.png" class="fa-stack-1x" style="width: 70%; height: 70%; object-fit: contain; alt="Instagram Icon">
                                </span>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a href="https://github.com/TheWithOutForest">
                                <span class="fa-stack fa-lg">
                                    <i class="fas fa-circle fa-stack-2x"></i>
                                    <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <div class="small text-center text-muted fst-italic">© Desenvolvido por Lucas Martins, Pedro Henrique, Tiago Estrada, Vinícius Ramos e Wesley Mendes</div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
