CREATE DATABASE IF NOT EXISTS loja_autopecas CHARACTER SET utf8 COLLATE utf8_general_ci;

USE loja_autopecas;

CREATE TABLE IF NOT EXISTS vendedores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    idade INT,
    senha VARCHAR(100),
    cidade VARCHAR(100),
    telefone VARCHAR(20),
    email VARCHAR(100)
);
