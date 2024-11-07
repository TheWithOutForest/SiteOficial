/* Lógico_1: */

CREATE TABLE cliente (
    cpf INT PRIMARY KEY,
    nome varchar(50),
    endereco_cliente varchar(100),
    telefone VARCHAR(20)
);

CREATE TABLE ingressos (
    num_ingresso int,
    valor int,
    status boolean,
    dt_hr_compra datetime,
    id_fazenda int,
    PRIMARY KEY (num_ingresso, id_fazenda)
);

CREATE TABLE vendas (
    num_ingresso int,
    cpf int,
    tipo varchar(10),
    status varchar(30),
    PRIMARY KEY (num_ingresso, cpf)
);

CREATE TABLE usuarios (
    cpf int PRIMARY KEY,
    senha VARCHAR(255),
    perfil VARCHAR(50)
);

CREATE TABLE locais (
    id_fazenda int PRIMARY KEY,
    estado varchar(2),
    endereco_fazenda varchar(100),
    nome_fazenda varchar(50),
    caminho_img VARCHAR(255),
    descricao text
);