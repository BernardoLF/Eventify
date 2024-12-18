CREATE DATABASE IF NOT EXISTS controlo_eventos;
USE controlo_eventos;

-- Tabela para roles
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE
);

-- Tabela para users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL DEFAULT 2, 
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Tabela para categorias
CREATE TABLE categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL UNIQUE
);

-- Tabela para eventos
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    data DATE NOT NULL,
    horas TIME NOT NULL, 
    loc VARCHAR(255) NOT NULL,
    capacidade INT NOT NULL,
    id_organizador INT NOT NULL,
    id_categoria INT,  
    FOREIGN KEY (id_organizador) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (id_categoria) REFERENCES categorias(id)  
);

-- Tabela de registos
CREATE TABLE registos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    id_user INT NOT NULL, 
    data_registo TIMESTAMP DEFAULT CURRENT_TIMESTAMP, 
    FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

/*
-- Tabela das Imagens dos Eventos
CREATE TABLE imagens_eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_evento INT NOT NULL,
    imagem LONGBLOB, 
    FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE
);
*/

-- View para ver o número de inscritos por evento
CREATE VIEW view_inscritos_eventos AS
SELECT 
    e.id AS id_evento,
    e.nome AS nome_evento,
    COUNT(r.id) AS numero_inscritos
FROM 
    eventos e
LEFT JOIN 
    registos r ON e.id = r.id_evento
GROUP BY 
    e.id, e.nome;


-- Inserir Dados
-- Inserir dados na tabela roles
INSERT INTO roles (nome) VALUES
('organizador'),
('participante'),
('admin');

-- Inserir dados na tabela users
INSERT INTO users (nome, email, password, role_id) VALUES
('Organizador', 'org@exemplo.com', '123', 1),  
('Participante', 'part@exemplo.com', '456', 2),
('Admin', 'admin@exemplo.com', '789', 3);

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

-- Inserir eventos na tabela eventos
INSERT INTO eventos (nome, descricao, data, horas, loc, capacidade, id_organizador, id_categoria) VALUES
('Conferencia Tecnologia 2024', 'Conferência sobre tecnologia.', '2024-12-15', '10:00:00', 'Tech Hall', 100, 1, 4), -- Categoria: Tecnologia e Inovação
('Festival de Musica 2024', 'Para amantes de música.', '2024-12-20', '18:00:00', 'Festival Grounds', 200, 1, 2); -- Categoria: Arte e Cultura

-- Inserir registos de participantes
INSERT INTO registos (id_evento, id_user) VALUES
(1, 2),  -- Participante no evento de tecnologia
(2, 2);  -- Participante no evento de música
