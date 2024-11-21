<?php
include 'conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Compras</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        table th {
            background-color: #f0f0f0;
        }
        .edit-btn {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .edit-btn:hover {
            background-color: #0056b3;
        }
        .save-btn {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 3px;
        }
        .save-btn:hover {
            background-color: #218838;
        }
    </style>


    <script>
        // Função para habilitar edição de uma linha
        function editRow(row) {
            const cells = row.getElementsByTagName('td');
            for (let i = 1; i < cells.length - 1; i++) { // Ignorar o CPF (1º) e os botões (último)
                const cell = cells[i];
                const currentValue = cell.innerText;
                cell.innerHTML = `<input type="text" value="${currentValue}" />`;
            }
            row.querySelector('.edit-btn').style.display = 'none';
            row.querySelector('.save-btn').style.display = 'inline-block';
        }

        // Função para salvar as edições no banco de dados
        function saveRow(row, cpf) {
            const cells = row.getElementsByTagName('td');
            const data = {
                cpf: cpf,
                ingresso: cells[1].querySelector('input').value,
                tipo: cells[2].querySelector('input').value,
                status: cells[3].querySelector('input').value
            };

            fetch('update_ingresso.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    for (let i = 1; i < cells.length - 1; i++) {
                        const cell = cells[i];
                        cell.innerText = data[Object.keys(data)[i]]; // Atualiza a célula
                    }
                    alert('Atualizado com sucesso!');
                } else {
                    alert('Erro ao atualizar!');
                }
            })
            .catch(error => alert('Erro na requisição: ' + error));

            row.querySelector('.edit-btn').style.display = 'inline-block';
            row.querySelector('.save-btn').style.display = 'none';
        }
    </script>

</head>
<body>
    <h1>Lista de Compras</h1>
    <table border="1">
        <tr>
            <th>Cliente (CPF)</th>
            <th>Ingresso</th>
            <th>Tipo</th>
            <th>Status</th>
        </tr>
        
        <td>
            <button class='edit-btn' onclick='editRow(this.parentNode.parentNode)'>Editar</button>
            <button class='save-btn' style='display:none;' onclick='saveRow(this.parentNode.parentNode, "cpf_placeholder")'>Salvar</button>
        </td>
        <?php
        $sql
         = "SELECT vendas.*, cliente.nome FROM vendas JOIN cliente ON vendas.cpf = cliente.cpf";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['cpf']}</td>
                    <td>{$row['num_ingresso']}</td>
                    <td>{$row['tipo']}</td>
                    <td>{$row['status']}</td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Nenhuma compra realizada</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="index.php">Voltar</a>


    <h2>Adicionar Novo Ingresso</h2>
    <form id="add-ingresso-form">

        <label for="ingresso">Número do Ingresso:</label><br>
        <input type="text" id="ingresso" name="ingresso" required><br><br>

        <label for="tipo">Tipo:</label><br>
        <input type="text" id="tipo" name="tipo" required><br><br>

        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" required><br><br>

        <button type="button" onclick="addIngresso()">Adicionar</button>
    </form>
    <script>
        function addIngresso() {
            const form = document.getElementById('add-ingresso-form');
            const data = {
                cpf: form.cpf.value,
                ingresso: form.ingresso.value,
                tipo: form.tipo.value,
                status: form.status.value
            };

            fetch('add_ingresso.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.success) {
                    alert('Ingresso adicionado com sucesso!');
                    location.reload(); // Recarrega a página para mostrar os novos dados
                } else {
                    alert('Erro ao adicionar ingresso: ' + result.message);
                }
            })
            .catch(error => alert('Erro na requisição: ' + error));
        }
    </script>

updated_lista_compras_with_form = updated_lista_compras.replace(
    "</body>",
    f"{formulario_adicionar}\n</body>"
)


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

// Inserindo os dados no banco de dados
$sql = "INSERT INTO vendas (cpf, num_ingresso, tipo, status) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param('iiss', $cpf, $ingresso, $tipo, $status);

if ($stmt->execute()) {
    echo json_encode(['success' => true, 'message' => 'Ingresso adicionado com sucesso.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Erro ao adicionar ingresso.']);
}
?>


 Salvando os arquivos atualizados
updated_lista_compras_with_form_path = '/mnt/data/updated_lista_compras_with_form.php'
add_ingresso_path = '/mnt/data/add_ingresso.php'

with open(updated_lista_compras_with_form_path, 'w', encoding='utf-8') as f:
    f.write(updated_lista_compras_with_form)

with open(add_ingresso_path, 'w', encoding='utf-8') as f:
    f.write(add_ingresso_php)

updated_lista_compras_with_form_path, add_ingresso_path

</body>
</html>

