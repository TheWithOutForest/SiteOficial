<?php
include 'conexao.php';
session_start();


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

    <header class="masthead" style="background-image: url('assets/img/fazenda2estrada2.jpg')">
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <div class="site-heading">
                        <h1>ㅤ</h1>
                        <h1>Os Sem Floresta</h1>
                        <h2>Altere, cadastre ou exclua seu perfil(CRUD)</h2>
                        <h1>ㅤ</h1>
                    </div>
                </div>
            </div>
        </div>  
    </header>

    <div class="container text-center mt-5">
    <div class="mb-3">
        <h1>Informações do Perfil</h1>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>CPF</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
                <th>Ações</th>
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
                            <a href="update.php?cpf=<?php echo $cliente['cpf']; ?>" class="btn custom-btn btn-sm">Editar</a>
                            <a href="delete.php?cpf=<?php echo $cliente['cpf']; ?>" class="btn custom-btn btn-sm" onclick="return confirm('Tem certeza que deseja deletar este cliente?');">Excluir</a>
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

<div class="container text-center mt-5">
<div class="mb-3">

        <a href="cadastro_cliente.php" class="btn btn-success mb-3">Cadastrar Novo Cliente</a>
        <a href="listar.php" class="btn btn-primary mb-3">Listar Todos os Clientes</a>
    </div>
</div>
</div>

<style>
    h1 {
    padding-bottom: 30px; 
    }

.custom-btn {
    background-color: white; 
    color: black; 
    border: 1px solid #ccc; 
}

.custom-btn:hover {
    background-color: #f8f9fa; 
    color: black; 
    border-color: #bbb; 
}

    @media (max-width: 768px) {
        table {
            width: 100%;
            font-size: 0.9rem; 
        }
        
        table th, table td {
            padding: 8px; 
        }

        .btn {
            padding: 8px 16px; 
            font-size: 0.9rem; 
        }

        h1 {
            font-size: 1.75rem;
        }
    }

    @media (max-width: 480px) {
        table th, table td {
            font-size: 0.8rem;
        }
        
        .btn {
            padding: 7px 14px; 
        }
        
        h1 {
            font-size: 1.5rem;
        }
    }
</style>

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
