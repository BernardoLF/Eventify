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
    id_user INT NOT NULL, -- Nome ajustado para consistência com outras tabelas
    data_registo TIMESTAMP DEFAULT CURRENT_TIMESTAMP, -- Nome ajustado para consistência com snake_case
    FOREIGN KEY (id_evento) REFERENCES eventos(id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) REFERENCES users(id) ON DELETE CASCADE
);

-- Iserir Dados
INSERT INTO users (nome, email, password, role_id) VALUES
('Admin Organizer', 'admin@events.com', 'hashed_password1', 1),  
('John Participant', 'john@events.com', 'hashed_password2', 2);  

INSERT INTO roles (nome) VALUES
('organizador'),
('participante'),
('admin');

INSERT INTO eventos (nome, descricao, data, loc, capacidade, id_organizador) VALUES
('Tech Conference 2024', 'A conference about the latest in technology.', '2024-12-15', 'Tech Hall', 100, 1),
('Music Festival 2024', 'A vibrant music festival for all music lovers.', '2024-12-20', 'Festival Grounds', 200, 1);

INSERT INTO registos (id_evento, id_user) VALUES
(1, 2),
(2, 2);
