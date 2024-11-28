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

    <header class="masthead" style="background-image: url('assets/img/home.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>ㅤ</h1>
                        <h1>Conforto e tranquilidade</h1>
                        <h2>Onde a sua estadia é um refúgio perfeito</h2>
                        <h1>ㅤ</h1>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="container">
    <div class="row gy-4">
        <!-- Card 1 -->
        <div class="col-12 col-sm-6">
            <div class="card">
                <img class="card-img-top" src="assets/img/fazenda1soares.jpg" alt="Fazenda Soares">
                <div class="card-body">
                    <h5 class="card-title">Fazenda Soares</h5>
                    <p class="card-text">Localizada em um vale tranquilo, a Fazenda Soares é o destino ideal para quem busca contato com a natureza. A fazenda possui um lago para pesca esportiva, trilhas ecológicas que atravessam áreas de mata nativa e locais perfeitos para piqueniques com vistas deslumbrantes dos campos ao redor. </p>
                    <p>Sorocaba - SP</p>
                    <a href="sobreEspacos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-12 col-sm-6">
            <div class="card">
                <img class="card-img-top" src="assets/img/fazenda2estrada.jpg" alt="Fazenda Estrada">
                <div class="card-body">
                    <h5 class="card-title">Fazenda Estrada</h5>
                    <p class="card-text">Conhecida por suas plantações, a Fazenda Estrada oferece a experiência única de colher frutas frescas diretamente do pomar. Além disso, conta com trilhas naturais que revelam paisagens incríveis e uma área especial para interação com animais como coelhos, galinhas e ovelhas. Um passeio educativo e divertido para todas as idades.</p>
                    <p>Atibaia - SP</p>
                    <a href="sobreEspacos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-12 col-sm-6">
            <div class="card">
                <img class="card-img-top" src="assets/img/fazenda3ramos.jpg" alt="Fazenda Ramos">
                <div class="card-body">
                    <h5 class="card-title">Fazenda Ramos</h5>
                    <p class="card-text">A Fazenda Ramos combina tradição rural e diversão. Os visitantes podem participar de passeios a cavalo por áreas panorâmicas, aprender técnicas de cultivo sustentável em oficinas de plantio e aproveitar momentos de lazer ao lado de animais de fazenda. É uma experiência completa para quem deseja explorar a vida no campo.</p>
                    <p>Suzano - SP</p>
                    <a href="sobreEspacos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-12 col-sm-6">
            <div class="card">
                <img class="card-img-top" src="assets/img/fazenda4medeiros.avif" alt="Fazenda Medeiros">
                <div class="card-body">
                    <h5 class="card-title">Fazenda Medeiros</h5>
                    <p class="card-text">Com foco em atividades ao ar livre, a Fazenda Medeiros oferece uma experiência interativa para toda a família. Passeios de bicicleta por trilhas exclusivas, oficinas de culinária com ingredientes colhidos no local e um playground natural com tirolesa e escalada para crianças são algumas das atrações. Ideal para quem busca aventura.</p>
                    <p>Guarulhos - SP</p>
                    <a href="sobreEspacos.php" class="btn btn-primary btn-sm">Saiba Mais</a>
                </div>
            </div>
        </div>
    </div>
</div>

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
