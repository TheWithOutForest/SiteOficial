
<?php
include 'conexao.php'; // Certifique-se de que este arquivo conecta ao banco de dados corretamente

// Lê os dados JSON enviados pela requisição
$data = json_decode(file_get_contents('php://input'), true);

if (!isset($data['cpf']) || !isset($data['ingresso']) || !isset($data['tipo']) || !isset($data['status'])) {
    echo json_encode(['success' => false, 'message' => 'Dados incompletos.']);
    exit;
}

$cpf = $data['cpf'];
$ingresso = $data['ingresso'];
$tipo = $data['tipo'];
$status = $data['status'];

// Atualiza os dados no banco de dados
$sql = "UPDATE vendas SET num_ingresso = ?, tipo = ?, status = ? WHERE cpf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('isss', $ingresso, $tipo, $status, $cpf);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Atualização realizada com sucesso.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao atualizar.']);
}
?>
