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
    role_id INT NOT NULL,
    FOREIGN KEY (role_id) REFERENCES roles(id)
);

-- Tabela para eventos
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao TEXT,
    data DATE NOT NULL,
    loc VARCHAR(255) NOT NULL,
    capacidade INT NOT NULL,
    id_organizador INT NOT NULL,
    FOREIGN KEY (id_organizador) REFERENCES users(id) ON DELETE CASCADE
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

-- View para ver o numero de inscritos por evento
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


-- Iserir Dados
INSERT INTO roles (nome) VALUES
('organizador'),
('participante'),
('admin');

INSERT INTO users (nome, email, password, role_id) VALUES
('Organizador', 'org@exemplo.com', '123', 1),  
('Participante', 'part@exemplo.com', '456', 2),
('Admin', 'admin@exemplo.com', '789', 3);

INSERT INTO eventos (nome, descricao, data, loc, capacidade, id_organizador) VALUES
('Conferencia Tecnologia 2024', 'Conderencia sobre tecnologia.', '2024-12-15', 'Tech Hall', 100, 1),
('Festical de Musica 2024', 'Para amantes de meusica.', '2024-12-20', 'Festival Grounds', 200, 1);

INSERT INTO registos (id_evento, id_user) VALUES
(1, 2),
(2, 2);
