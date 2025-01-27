CREATE DATABASE IF NOT EXISTS controlo_eventos;
USE controlo_eventos;

-- Tabela para roles
CREATE TABLE roles (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);

-- Tabela para users
CREATE TABLE users (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL DEFAULT 2, 
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Tabela para categorias
CREATE TABLE categorias (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

-- Tabela para horas
CREATE TABLE data_hora (
  id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  data_inicio date NOT NULL,
  data_encerramento date NOT NULL,
  hora_abertura time NOT NULL,
  hora_encerramento time NOT NULL
);


-- Tabela para eventos
CREATE TABLE eventos (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    descricao TEXT,
    id_days int NOT NULL DEFAULT 0,
    localizacao VARCHAR(255) NOT NULL,
    capacidade INT NOT NULL,
    id_organizador INT NOT NULL,
    id_categoria INT,
    imagem varchar(255) NOT NULL,
    FOREIGN KEY (id_days) REFERENCES data_hora(id),
    FOREIGN KEY (id_organizador) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)  
);

-- Inserir dados na tabela roles
INSERT INTO roles (nome) VALUES
('organizador'),
('participante'),
('admin');

-- Inserir categorias na tabela categorias
INSERT INTO categorias (nome) VALUES
('Educação e Carreira'),
('Arte e Cultura'),
('Desporto e Bem-estar'),
('Tecnologia e Inovação'),
('Empreendedorismo e Negócios'),
('Entretenimento e Lazer'),
('Comunidade e Solidariedade'),
('Ciência e Meio Ambiente');
