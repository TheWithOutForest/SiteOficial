<?php
include 'conexao.php';
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Os Sem-Floresta</title>
        <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <link href="css/styles.css" rel="stylesheet" />
        <link href="css/estilo.css" rel="stylesheet" />
        <link href="css/sobreespacos.css" rel="stylesheet" />
        
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

        <header class="masthead" style="background-image: url('assets/img/homesobre.avif')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="page-heading">
                            <h2>ㅤ</h2>
                            <h2>ㅤ</h2>
                            <h2>ㅤ</h2>
                            <h1>Conheça um pouco mais</h1>
                            <h2>ㅤ</h2>
                            <h2>ㅤ</h2>
                            <h2>ㅤ</h2>
                        </div>
                    </div>
                </div>
            </div>
        </header>

<!-- Seção 1 -->

<section id="sobreEspacos">
  <h1 class="text-center">Fazenda Soares</h1>
  <div class="container">
      <div class="row">
          <div class="col-md-4">
              <div class="card color text-center">
                  <img src="assets/img/fazenda1soares.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-text">Desfrute da tranquilidade e das belezas naturais, ideal para um descanso longe da cidade.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card color text-center">
                  <img src="assets/img/fazenda1soares2.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-text">Explore trilhas, riachos e o ar puro, um espaço onde natureza e conforto se encontram.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card color text-center">
                  <img src="assets/img/fazenda1soares3.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-text">A tirolesa é um salto de coragem, onde o vento na face e a visão panorâmica criam uma sensação única de aventura.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card color text-center">
                  <img src="assets/img/fazenda1soares4.avif" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-text">Aproveite o melhor do campo, com belas vistas, ar puro e muita paz ao redor.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card color text-center">
                  <img src="assets/img/fazenda1soares5.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-text">Desfrute de pôr do sol inesquecível e de um ambiente acolhedor, rodeado pela natureza.</p>
                  </div>
              </div>
          </div>
          <div class="col-md-4">
              <div class="card color text-center">
                  <img src="assets/img/equipamentos1.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                      <p class="card-text">Uma mochila resistente permite transportar tudo com segurança, deixando as mãos livres para explorar com liberdade.<p>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="rent-button-wrapper">
    <a href="comprar.php">
        <button class="rent-button">Agendar</button>
    </a>
</div>
</section>

<!-- Seção 2 -->

        <section id="sobreEspacos">
            <h1 class="text-center ">Fazenda Estrada</h1>
            <div class="row espaço-titulo">
              <div class="col-md-4 esquerda">            
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda2estrada.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Aproveite dias de paz e conforto, rodeado por belíssimas paisagens naturais.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 esquerda">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda2estrada2.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Oferece o equilíbrio perfeito entre lazer e natureza, ideal para descansar</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 esquerda">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda2estrada3.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Simplicidade e beleza em um só lugar, é o refúgio ideal para quem busca paz.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda2estrada4.jpg" class="card-img-top " alt="...">
                  <div class="card-body">
                    <p class="card-text">Desfrute de um espaço encantador, perfeito para relaxar e curtir as paisagens.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda2estrada5.avif" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">O balanço é a dança do vento, levando a mente a um estado de leveza e liberdade.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/equipamentos2.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">A lanterna é vital para visibilidade noturna, permitindo caminhar com segurança e iluminar o acampamento ao anoitecer.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="rent-button-wrapper">
              <a href="comprar.php">
                  <button class="rent-button">Agendar</button>
              </a>
          </div>
          </section>

<!-- Seção 3 -->

        <section id="sobreEspacos">
            <h1 class="text-center ">Fazenda Ramos</h1>
            <div class="row espaço-titulo">
              <div class="col-md-4 esquerda">            
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda3ramos.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Charme rústico e muito verde fazem desta fazenda o destino ideal para fugir da cidade."</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 esquerda">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda3ramos2.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text"> Aproveite o melhor do campo, com belas vistas, ar puro e muita paz ao redor.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 esquerda">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda3ramos3.avif" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Uma atmosfera única e belas paisagens tornam esta fazenda ideal para recarregar.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda3ramos4.jpg" class="card-img-top " alt="...">
                  <div class="card-body">
                    <p class="card-text">Descubra a beleza do campo e o conforto, um convite para dias de relaxamento.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda3ramos5.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Desfrute de um espaço encantador, perfeito para relaxar e curtir as paisagens.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/equipamentos3.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">O saco de dormir garante isolamento térmico, prevenindo o frio e proporcionando uma noite de descanso revitalizante</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="rent-button-wrapper">
              <a href="comprar.php">
                  <button class="rent-button">Agendar</button>
              </a>
          </div>
          </section>

<!-- Seção 4 -->

        <section id="sobreEspacos">
            <h1 class="text-center ">Fazenda Medeiros</h1>
            <div class="row espaço-titulo">
              <div class="col-md-4 esquerda">            
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda4medeiros.avif" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Local perfeito para quem deseja uma experiência autêntica no campo com muito conforto.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 esquerda">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda4medeiros2.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Perfeita para quem busca tranquilidade e lazer, com estrutura para descontração.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 esquerda">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda4medeiros3.jpg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Explore trilhas, riachos e o ar puro, um espaço onde natureza e conforto se encontram.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda4medeiros4.jpg" class="card-img-top " alt="...">
                  <div class="card-body">
                    <p class="card-text">Rodeada por colinas e verde, esta fazenda oferece o cenário perfeito para momentos de lazer.</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/fazenda4medeiros5.jpeg" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Ambiente relaxante e acolhedor, ideal para desconectar e aproveitar o campo</p>
                  </div>
                </div>
              </div>
              <div class="col-md-4 espaço-baixo">
                <div class="card color" style="width: 18rem;">
                  <img src="assets/img/equipamentos4.webp" class="card-img-top" alt="...">
                  <div class="card-body">
                    <p class="card-text">Kit de primeiros socorros compacto, com tudo que você precisa para emergências em ambientes externos.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="rent-button-wrapper">
              <a href="comprar.php">
                  <button class="rent-button">Agendar</button>
              </a>
          </div>
          </section>
          
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
            </div>
        </div>
    </div>
</footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>