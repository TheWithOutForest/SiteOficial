<?php
// Conectar ao banco de dados
$mysqli = new mysqli("localhost", "usuario", "senha", "ControleDeEventos");

if ($mysqli->connect_error) {
    die("Conexão falhou: " . $mysqli->connect_error);
}

// Consultar os ingressos
$query = "SELECT * FROM ingressos";
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row['num_ingresso'] . "</td>";
    echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
    echo "<td>" . ($row['status'] ? "Ativo" : "Inativo") . "</td>";
    echo "<td>" . $row['dt_hr_compra'] . "</td>";
    echo "<td>" . $row['id_fazenda'] . "</td>";
    echo "<td><button class='edit-btn' onclick='editarIngresso(" . $row['num_ingresso'] . ")'>Editar</button>
              <button class='delete-btn' onclick='deletarIngresso(" . $row['num_ingresso'] . ")'>Deletar</button></td>";
    echo "</tr>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Ingressos</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Ingressos</h1>
        
        <table>
            <thead>
                <tr>
                    <th>Número do Ingresso</th>
                    <th>Valor</th>
                    <th>Status</th>
                    <th>Data/Hora da Compra</th>
                    <th>Fazenda</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemplo de ingresso, você pode preenchê-lo dinamicamente com PHP -->
                <tr>
                    <td>12345</td>
                    <td>R$ 150,00</td>
                    <td>Ativo</td>
                    <td>2024-11-20 15:30</td>
                    <td>Fazenda São João</td>
                    <td>
                        <button class="edit-btn" onclick="editarIngresso(12345)">Editar</button>
                        <button class="delete-btn" onclick="deletarIngresso(12345)">Deletar</button>
                    </td>
                </tr>
                <!-- Adicionar mais ingressos dinamicamente -->
            </tbody>
        </table>
    </div>

    <script src="script.js"></script>
</body>
</html>

<script>
        // Função para editar um ingresso
    function editarIngresso(numIngresso) {
        alert("Abrir formulário para editar ingresso: " + numIngresso);
        // Aqui você pode redirecionar o usuário para um formulário de edição ou abrir um modal
        // Exemplo: window.location.href = '/editar_ingresso.php?id=' + numIngresso;
    }

    // Função para deletar um ingresso
    function deletarIngresso(numIngresso) {
        if (confirm("Tem certeza que deseja deletar este ingresso?")) {
            // Aqui você pode fazer uma requisição para excluir o ingresso do banco de dados
            alert("Ingresso " + numIngresso + " deletado.");
            // Exemplo: fetch('/deletar_ingresso.php?id=' + numIngresso, { method: 'DELETE' })
        }
    }
</script>
<Style>
    /* Resetando alguns estilos padrões */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Corpo da página */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
    padding: 20px;
}

/* Container principal */
.container {
    max-width: 1200px;
    margin: 0 auto;
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Título */
h1 {
    text-align: center;
    margin-bottom: 20px;
}

/* Estilo da tabela */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    padding: 12px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #4CAF50;
    color: white;
}

td {
    background-color: #f9f9f9;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Botões de ação */
button {
    padding: 8px 12px;
    margin: 5px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.edit-btn {
    background-color: #4CAF50;
    color: white;
}

.edit-btn:hover {
    background-color: #45a049;
}

.delete-btn {
    background-color: #f44336;
    color: white;
}

.delete-btn:hover {
    background-color: #e53935;
}

/* Responsividade */
@media (max-width: 768px) {
    table {
        font-size: 14px;
    }

    th, td {
        padding: 8px;
    }

    button {
        font-size: 12px;
    }
}

</Style>