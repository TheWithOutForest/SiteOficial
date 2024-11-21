<?php
include 'conexao.php';

try {
    // Consulta SQL para pegar todos os clientes
    $sql = "SELECT * FROM cliente";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    // Obter resultados
    $result = $stmt->get_result();
    $cliente = $result->fetch_all(MYSQLI_ASSOC);
} catch (PDOException $e) {
    echo "Erro ao buscar cliente: " . $e->getMessage();
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
                        <h1>Os Sem Floresta</h1>
                        <h2>CRUD: Altere, cadastre ou exclua um perfil</h2>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Seção de Listagem de Clientes -->
    <div class="container text-center mt-5">
        <div class="mb-3">
            <a href="create.php" class="btn btn-success mb-3">Cadastrar Novo Cliente</a>
            <a href="listar.php" class="btn btn-primary mb-3">Listar Todos os Clientes</a>
        </div>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>CPF</th>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Ações</th> <!-- Coluna de Ações -->
                </tr>
            </thead>
            <tbody>
                <?php if ($cliente): ?>
                    <?php foreach ($cliente as $cliente): ?>
                        <tr>
                            <td><?php echo $cliente['cpf']; ?></td>
                            <td><?php echo $cliente['nome']; ?></td>
                            <td><?php echo $cliente['endereco_cliente']; ?></td>
                            <td><?php echo $cliente['telefone']; ?></td>
                            <td>
                                <!-- Botões de Editar e Excluir -->
                                <a href="update.php?cpf=<?php echo $cliente['cpf']; ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="delete.php?cpf=<?php echo $cliente['cpf']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja deletar este cliente?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Nenhum cliente encontrado</td> <!-- Ajuste no colspan -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
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
