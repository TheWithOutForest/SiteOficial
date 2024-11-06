const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const app = express();
const port = 3000;

// Middleware para processar dados do corpo
app.use(bodyParser.urlencoded({ extended: true }));

// Serve arquivos estáticos (ex: HTML, CSS)
app.use(express.static('dist'));

// Conexão com o banco de dados MySQL
const db = mysql.createConnection({
    host: 'localhost',
    user: 'seu_usuario',
    password: 'sua_senha',
    database: 'seu_banco_de_dados'
});

// Verifica se a conexão foi bem-sucedida
db.connect((err) => {
    if (err) {
        console.error('Erro ao conectar no banco de dados: ' + err.stack);
        return;
    }
    console.log('Conectado ao banco de dados MySQL como ID ' + db.threadId);
});

// Rota para exibir o formulário
app.get('/contact', (req, res) => {
    res.sendFile(__dirname + '/dist/equipe.html');
});

// Rota para processar os dados do formulário
app.post('/submit', (req, res) => {
    const { cpf, nome, telefone } = req.body;

    // Aqui você insere os dados no banco de dados
    const query = 'INSERT INTO usuarios (cpf, nome, telefone) VALUES (?, ?, ?)';
    db.query(query, [cpf, nome, telefone], (err, result) => {
        if (err) {
            console.error('Erro ao inserir dados no banco de dados:', err);
            return res.send('Erro ao enviar o formulário.');
        }

        console.log('Dados inseridos:', { cpf, nome, telefone });

        // Resposta ao usuário
        res.send(`<h1>Formulário enviado com sucesso!</h1><p>CPF: ${cpf}</p><p>Nome: ${nome}</p><p>Telefone: ${telefone}</p>`);
    });
});

// Inicia o servidor
app.listen(port, () => {
    console.log(`Servidor rodando em http://localhost:${port}`);
});
