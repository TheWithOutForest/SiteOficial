<?php
include 'conexao.php';

if (isset($_GET['id_fazenda'])) {
    $id_fazenda = $_GET['id_fazenda'];
    $sql = "SELECT * FROM ingressos WHERE id_fazenda=$id_fazenda AND status=1";
    $result = $conn->query($sql);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $num_ingresso = $_POST['num_ingresso'];
    $cpf = $_POST['cpf'];
    $tipo_ingresso = $_POST['tipo_ingresso'];

    // Registrar venda
    $sql = "INSERT INTO vendas (num_ingresso, cpf, tipo, status) VALUES ('$num_ingresso', '$cpf', '$tipo_ingresso', 'Confirmado')";
    $conn->query($sql);

    // Atualizar status do ingresso
    $sql = "UPDATE ingressos SET status=0 WHERE num_ingresso=$num_ingresso";
    $conn->query($sql);
    echo "Compra realizada com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Os Sem-Floresta - Comprar Ingresso</title>
    <link rel="icon" type="image/x-icon" href="assets/icon.ico"/>
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
    <link href="css/styles.css" rel="stylesheet" />
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
                        <h1>ㅤ</h1>
                        <h2>Seu momento é esse, venha se divertir!</h2>
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
                <input type="number" name="cpf" id="cpf" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="num_ingresso" class="form-label">Escolha o ingresso:</label>
                <select name="num_ingresso" id="num_ingresso" class="form-select" required>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['num_ingresso']}'>Ingresso {$row['num_ingresso']} - R$ {$row['valor']}</option>";
                        }
                    } else {
                        echo "<option disabled>Nenhum ingresso disponível</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Comprar</button>
        </form>
        <div id="mensagem" class="mt-3 text-center"></div>
    </div>

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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
