<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Os Sem-Floresta</title>
        <link rel="icon" type="image/x-icon" href="assets/icon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.html">Os Sem-Floresta</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Inicial</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="sobreEspacos.php">Sobre</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="agendamento.php">Agendamento</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="equipe.php">Equipe</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="cadastro.php">Cadastro</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <h1>ㅤ</h1>
                            <h2>ㅤ</h2>
                            <h2>ㅤ</h2>
                            <h2>Seu momento é esse, venha se divertir!</h2>
                            <h2>ㅤ</h2>
                            <h2>ㅤ</h2>
                            <h1>ㅤ</h1>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <div class="container mt-5">
            <h1 class="text-center mb-4">Agendamento de Ingressos para Fazenda</h1>
            <form id="formAgendamento" class="mx-auto" style="max-width: 500px;">
                <div class="mb-3">
                    <label for="fazenda" class="form-label">Escolha a Fazenda:</label>
                    <div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="fazenda" id="fazendaSoares" value="Fazenda Soares" required>
                            <label class="form-check-label" for="fazendaSoares">
                                Fazenda Soares
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="fazenda" id="fazendaEstrada" value="Fazenda Estrada" required>
                            <label class="form-check-label" for="fazendaEstrada">
                                Fazenda Estrada
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="fazenda" id="fazendaRamos" value="Fazenda Ramos" required>
                            <label class="form-check-label" for="fazendaRamos">
                                Fazenda Ramos
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="fazenda" id="fazendaMedeiros" value="Fazenda Medeiros" required>
                            <label class="form-check-label" for="fazendaMedeiros">
                                Fazenda Medeiros
                            </label>
                        </div>
                    </div>
                </div>
        
                <div class="mb-3">
                    <label for="ingresso" class="form-label">Tipo de ingresso:</label>
                    <select id="ingresso" name="ingresso" class="form-select" required>
                        <option value="inteira">Inteira</option>
                        <option value="meia">Meia</option>
                    </select>
                </div>
        
                <div class="mb-3">
                    <label for="data" class="form-label">Data do agendamento:</label>
                    <input type="date" id="data" name="data" class="form-control" required>
                </div>
        
                <button type="submit" class="btn btn-primary w-100">Agendar</button>
            </form>
        
            <div id="mensagem" class="mt-3 text-center"></div>
        </div>
        
        <!-- Footer-->
        <footer class="border-top">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="https://www.instagram.com/the_without_forest/">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <img src="assets/img/instaicon.png" class="fa-stack-1x" alt="Insta Icon" style="width: 70%; height: 70%; object-fit: contain;">
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
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Developed by Lucas Martins, Pedro Henrique, Tiago Estrada, Vinícius Ramos e Wesley Mendes</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script src="js/scriptagendamento.js"></script>
    </body>
</html>
