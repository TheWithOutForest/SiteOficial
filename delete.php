<?php
include 'conexao.php';

if (isset($_GET['cpf'])) {
    $cpf = $_GET['cpf'];

    try {
        $sql = "DELETE FROM cliente WHERE cpf = :cpf";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->execute();

        echo "Cliente deletado com sucesso!";
        header("Location: listar.php"); // Redireciona para a página de listagem
        exit();
    } catch (PDOException $e) {
        echo "Erro ao deletar cliente: " . $e->getMessage();
    }
} else {
    echo "CPF não informado.";
}
?>
