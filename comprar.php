<?php
include 'conexao.php';
session_start();

$mensagem = ''; // Variável para armazenar a mensagem de sucesso ou erro

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_fazenda = $_POST['id_fazenda'];
    $tipo_ingresso = $_POST['tipo_ingresso'];
    $cpf = $_POST['cpf'];

    // Gerar número aleatório único para o ingresso
    do {
        $num_ingresso = rand(100000, 999999); // Gera um número aleatório de 6 dígitos
        $check_ingresso = $conn->query("SELECT 1 FROM ingressos WHERE num_ingresso = $num_ingresso");
    } while ($check_ingresso->num_rows > 0);

    // Inserir o ingresso
    $sql_ingresso = "INSERT INTO ingressos (num_ingresso, id_fazenda, tipo_ingresso, status) 
                     VALUES ($num_ingresso, $id_fazenda, '$tipo_ingresso', 'Ativo')";
    if ($conn->query($sql_ingresso)) {
        // Registrar a venda
        $sql_venda = "INSERT INTO vendas (num_ingresso, cpf, status) 
                      VALUES ($num_ingresso, '$cpf', 'Confirmado')";
        if ($conn->query($sql_venda)) {
            $mensagem = "<div class='alert alert-success text-center'>Compra realizada com sucesso! Número do ingresso: $num_ingresso</div>";
        } else {
            $mensagem = "<div class='alert alert-danger text-center'>Erro ao registrar a venda: " . $conn->error . "</div>";
        }
    } else {
        $mensagem = "<div class='alert alert-danger text-center'>Erro ao criar o ingresso: " . $conn->error . "</div>";
    }
}
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
                <?php if (isset($_SESSION['cpf'])): ?>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="listar.php">Editar Perfil</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="updated_lista_compras.php">Ver Ingressos</a></li>
                <?php endif; ?>
            </ul>
            <div class="navbar-login ms-lg-3">
                <?php if (isset($_SESSION['cpf'])): ?>
                    <span class="navbar-text">Bem-vindo, <?= $_SESSION['cpf'] ?>!</span>
                    <a href="logout.php" class="btn btn-secondary btn-sm ms-2">Logout</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary btn-sm ms-2">Login</a>
                    <a href="cadastro_cliente.php" class="btn btn-success btn-sm ms-2">Cadastrar</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

    <header class="masthead" style="background-image: url('assets/img/fazenda2estrada3.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>ㅤ</h1>
                        <h1>Faça já seu agendamento</h1>
                        <h2>Garanta a melhor oportunidade da sua vida</h2>
                        <h1>ㅤ</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Comprar Ingresso</h1>
        <form method="POST" class="mx-auto" style="max-width: 500px;">
            <div class="mb-3">
                <label for="cpf" class="form-label">Cliente (CPF):</label>
                <input type="text" name="cpf" id="cpf" class="form-control" value="<?= isset($_SESSION['cpf']) ? $_SESSION['cpf'] : '' ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="id_fazenda" class="form-label">Escolha a Fazenda:</label>
                <select name="id_fazenda" id="id_fazenda" class="form-select" required>
                    <option value="1">Fazenda Soares</option>
                    <option value="2">Fazenda Estrada</option>
                    <option value="3">Fazenda Ramos</option>
                    <option value="4">Fazenda Medeiros</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tipo_ingresso" class="form-label">Tipo de Ingresso:</label>
                <select name="tipo_ingresso" id="tipo_ingresso" class="form-select" required>
                    <option value="Meia">Meia</option>
                    <option value="Inteira">Inteira</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Comprar</button>
        </form>
        <div id="mensagem" class="mt-3 text-center">
            <?= $mensagem ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    
<footer class="border-top mt-5 bg-light py-4">
    <div class="container px-4 px-lg-5">
        <div class="row justify-content-center text-center">
            <div class="col-md-12 mt-3">
                <div class="small text-muted fst-italic">
                    <p>© Desenvolvido por Lucas Martins, Pedro Henrique, Tiago Estrada, Vinícius Ramos e Wesley Mendes</p>
                    <p>Alguma dúvida? Entre em contato conosco</p>
                </div>
            </div>
        </div>
        <div class="row align-items-center mt-4">
            <div class="col-lg-4 text-lg-start">
                <p>Os Sem Floresta</p>
            </div>
            <div class="col-lg-4 my-3 my-lg-0 text-center">
                <a class="btn btn-dark btn-social mx-2" href="https://github.com/TheWithOutForest" aria-label="GitHub">
                    <i class="fab fa-github"></i>
                </a>
                <a class="btn btn-dark btn-social mx-2" href="https://www.instagram.com/the_without_forest/" aria-label="Instagram">
                    <i class="fab fa-instagram"></i>
                </a>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a class="link-dark text-decoration-none" href="#!">Termos de Uso</a>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>
