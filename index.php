<?php
include 'conexao.php';
session_start();
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

    <!-- Seção de Mensagem de Boas-Vindas e Login -->
    <div class="container text-center mt-5">
        <?php if (isset($_SESSION['cpf'])): ?>
            <p class="welcome-msg">Bem-vindo, usuário de CPF: <?= $_SESSION['cpf'] ?>!</p>
            <a href="logout.php" class="btn btn-secondary mb-3">Logout</a>
            <a href="listar.php" class="btn btn-primary mb-3">Listar Cliente</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-primary mb-3">Login</a>
            <a href="cadastro_cliente.php" class="btn btn-success mb-3">Cadastrar Cliente</a>

        <?php endif; ?>
    </div>

    <!-- Seção de Locais com Imagens e Descrições -->
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <!-- Fazenda Soares -->
                <div class="post-preview">
                    <a href="sobreEspacos.php">
                        <h2 class="post-title">Fazenda Soares</h2>
                        <img class="imginicio" src="assets/img/fazenda1soares.jpg" alt="Fazenda Soares">
                        <h3 class="post-subtitle2">Na Fazenda Soares, é possível pescar em um lago tranquilo, caminhar pelas trilhas e fazer piqueniques com vistas para os campos...</h3>
                        <h3 class="post-subtitle">Saiba Mais</h3>
                    </a>
                </div>
                <br>
                <!-- Fazenda Estrada -->
                <div class="post-preview">
                    <a href="sobreEspacos.php">
                        <h2 class="post-title">Fazenda Estrada</h2>
                        <img class="imginicio" src="assets/img/fazenda2estrada.jpg" alt="Fazenda Estrada">
                        <h3 class="post-subtitle2">A Fazenda Estrada oferece atividades como colheita de frutas frescas, passeios pelas trilhas naturais e interação com animais...</h3>
                        <h3 class="post-subtitle">Saiba Mais</h3>
                    </a>
                </div>
                <br>
                <!-- Fazenda Ramos -->
                <div class="post-preview">
                    <a href="sobreEspacos.php">
                        <h2 class="post-title">Fazenda Ramos</h2>
                        <img class="imginicio" src="assets/img/fazenda3ramos.jpg" alt="Fazenda Ramos">
                        <h3 class="post-subtitle2">Na Fazenda Ramos, os visitantes podem fazer passeios a cavalo, participar de oficinas de plantio e brincar com os animais...</h3>
                        <h3 class="post-subtitle">Saiba Mais</h3>
                    </a>
                </div>
                <br>
                <!-- Fazenda Medeiros -->
                <div class="post-preview">
                    <a href="sobreEspacos.php">
                        <h2 class="post-title">Fazenda Medeiros</h2>
                        <img class="imginicio" src="assets/img/fazenda4medeiros.avif" alt="Fazenda Medeiros">
                        <h3 class="post-subtitle2">A Fazenda Medeiros oferece passeios de bicicleta, oficinas de culinária e um playground natural para as crianças...</h3>
                        <h3 class="post-subtitle">Saiba Mais</h3>
                    </a>
                </div>
                <hr class="my-4" />
                <div class="d-flex justify-content-end mb-4">
                    <a class="btn btn-primary text-uppercase" href="#!">Quero conhecer mais</a>
                </div>
            </div>
        </div>
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
