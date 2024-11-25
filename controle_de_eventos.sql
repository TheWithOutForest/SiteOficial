/* Lógico_2: */

CREATE DATABASE ControleDeEventos;

USE ControleDeEventos;

CREATE TABLE cliente (
    cpf INT PRIMARY KEY,
    nome varchar(50),
    endereco_cliente varchar(100),
    telefone VARCHAR(20)
);

CREATE TABLE ingressos (
    num_ingresso int,
    tipo_ingresso varchar(32),
    status varchar(10),
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

INSERT INTO locais (id_fazenda, nome_fazenda) VALUES
(1, 'Fazenda Soares'),
(2, 'Fazenda Estrada'),
(3, 'Fazenda Ramos'),
(4, 'Fazenda Medeiros');

CREATE TABLE Relacionamento_1 (
    fk_ingressos_num_ingresso int,
    fk_ingressos_id_fazenda int,
    fk_vendas_num_ingresso int,
    fk_vendas_cpf int
);

CREATE TABLE Relacionamento_3 (
    fk_cliente_cpf INT,
    fk_vendas_num_ingresso int,
    fk_vendas_cpf int
);

CREATE TABLE Relacionamento_4 (
    fk_cliente_cpf INT,
    fk_usuarios_cpf int
);
 
ALTER TABLE Relacionamento_1 ADD CONSTRAINT FK_Relacionamento_1_1
    FOREIGN KEY (fk_ingressos_num_ingresso, fk_ingressos_id_fazenda)
    REFERENCES ingressos (num_ingresso, id_fazenda)
    ON DELETE SET NULL;
 
ALTER TABLE Relacionamento_1 ADD CONSTRAINT FK_Relacionamento_1_2
    FOREIGN KEY (fk_vendas_num_ingresso, fk_vendas_cpf)
    REFERENCES vendas (num_ingresso, cpf)
    ON DELETE SET NULL;
 
ALTER TABLE Relacionamento_3 ADD CONSTRAINT FK_Relacionamento_3_1
    FOREIGN KEY (fk_cliente_cpf)
    REFERENCES cliente (cpf)
    ON DELETE SET NULL;
 
ALTER TABLE Relacionamento_3 ADD CONSTRAINT FK_Relacionamento_3_2
    FOREIGN KEY (fk_vendas_num_ingresso, fk_vendas_cpf)
    REFERENCES vendas (num_ingresso, cpf)
    ON DELETE SET NULL;
 
ALTER TABLE Relacionamento_4 ADD CONSTRAINT FK_Relacionamento_4_1
    FOREIGN KEY (fk_cliente_cpf)
    REFERENCES cliente (cpf)
    ON DELETE SET NULL;
 
ALTER TABLE Relacionamento_4 ADD CONSTRAINT FK_Relacionamento_4_2
    FOREIGN KEY (fk_usuarios_cpf)
    REFERENCES usuarios (cpf)
    ON DELETE SET NULL;