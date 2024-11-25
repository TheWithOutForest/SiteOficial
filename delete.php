<?php
include 'conexao.php';

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    // Inicia uma transação para garantir a consistência
    $conn->begin_transaction();

    try {
        // Proteção contra SQL Injection
        $cpf = $conn->real_escape_string($cpf);

        // Deleta da tabela 'cliente'
        $sql_cliente = "DELETE FROM cliente WHERE cpf = ?";
        $stmt_cliente = $conn->prepare($sql_cliente);
        $stmt_cliente->bind_param("s", $cpf);
        $stmt_cliente->execute();

        // Deleta da tabela 'usuarios'
        $sql_usuarios = "DELETE FROM usuarios WHERE cpf = ?";
        $stmt_usuarios = $conn->prepare($sql_usuarios);
        $stmt_usuarios->bind_param("s", $cpf);
        $stmt_usuarios->execute();

        // Confirma a transação
        $conn->commit();

        echo "Cliente deletado com sucesso!";
        header("Location: listar.php"); // Redireciona para a página de listagem
        exit();
    } catch (Exception $e) {
        // Reverte a transação em caso de erro
        $conn->rollback();
        echo "Erro ao deletar cliente: " . $e->getMessage();
    }
} else {
    echo "CPF não informado.";
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
        <h2>Editar Cliente</h2>
        <form method="POST">
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo $cliente['cpf']; ?>" readonly>
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