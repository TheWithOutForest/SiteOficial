const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql2');
const app = express();
const port = 3000;


app.use(bodyParser.urlencoded({ extended: true }));


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

// Rota para exibir o formulário de contato
app.get('/contact', (req, res) => {
    res.sendFile(__dirname + '/dist/equipe.html');
});

// Rota para processar os dados do formulário de contato
app.post('/submit', (req, res) => {
    const { cpf, nome, telefone } = req.body;

    const query = 'INSERT INTO usuarios (cpf, nome, telefone) VALUES (?, ?, ?)';
    db.query(query, [cpf, nome, telefone], (err, result) => {
        if (err) {
            console.error('Erro ao inserir dados no banco de dados:', err);
            return res.send('Erro ao enviar o formulário.');
        }

        console.log('Dados inseridos:', { cpf, nome, telefone });
        res.send(`<h1>Formulário enviado com sucesso!</h1><p>CPF: ${cpf}</p><p>Nome: ${nome}</p><p>Telefone: ${telefone}</p>`);
    });
});

// Rota para processar compra de ingressos
app.post('/comprar-ingresso', (req, res) => {
    const { cpf, nome, evento, quantidade } = req.body;

    // Query para inserir dados da compra de ingresso no banco
    const query = 'INSERT INTO ingressos (cpf, nome, evento, quantidade) VALUES (?, ?, ?, ?)';
    db.query(query, [cpf, nome, evento, quantidade], (err, result) => {
        if (err) {
            console.error('Erro ao registrar a compra de ingresso:', err);
            return res.send('Erro ao processar a compra.');
        }

        console.log('Compra de ingresso registrada:', { cpf, nome, evento, quantidade });
        res.send(`<h1>Compra realizada com sucesso!</h1><p>CPF: ${cpf}</p><p>Nome: ${nome}</p><p>Evento: ${evento}</p><p>Quantidade: ${quantidade}</p>`);
    });
});

// servidor
app.listen(3000, () => {
    console.log('Servidor rodando na porta 3000');
  });
