CREATE DATABASE IF NOT EXISTS saep_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE saep_db;

CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE clientes (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(150) NOT NULL,
    cpf TEXT NOT NULL COMMENT 'Armazenado criptografado (LGPD)',
    telefone VARCHAR(20) NOT NULL,
    email VARCHAR(150) NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE veiculos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cliente_id BIGINT UNSIGNED NOT NULL,
    placa VARCHAR(10) NOT NULL UNIQUE,
    marca VARCHAR(80) NOT NULL,
    modelo VARCHAR(80) NOT NULL,
    ano INT NOT NULL,
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_veiculos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE
);

CREATE TABLE agendamentos (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    cliente_id BIGINT UNSIGNED NOT NULL,
    veiculo_id BIGINT UNSIGNED NOT NULL,
    data_agendamento DATETIME NOT NULL,
    descricao_servico VARCHAR(255) NOT NULL,
    status ENUM('Pendente', 'Em Andamento', 'Concluido', 'Cancelado') DEFAULT 'Pendente',
    created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_agendamentos_cliente FOREIGN KEY (cliente_id) REFERENCES clientes(id) ON DELETE CASCADE,
    CONSTRAINT fk_agendamentos_veiculo FOREIGN KEY (veiculo_id) REFERENCES veiculos(id) ON DELETE CASCADE
);

INSERT INTO users (name, email, password) VALUES
('Administrador Oficina', 'admin@oficina.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Carlos Mecânico', 'carlos@oficina.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'),
('Ana Recepção', 'ana@oficina.com', '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

INSERT INTO clientes (nome, cpf, telefone, email) VALUES
('João da Silva', 'eyJpdiI6IkxHUERfQ1JZUFRfMSIsInZhbHVlIjoiMTExLjIyMi4zMzMtNDQifQ==', '(11) 98888-1111', 'joao@email.com'),
('Maria Oliveira', 'eyJpdiI6IkxHUERfQ1JZUFRfMiIsInZhbHVlIjoiMjIyLjMzMy40NDQtNTUifQ==', '(11) 97777-2222', 'maria@email.com'),
('Pedro Santos', 'eyJpdiI6IkxHUERfQ1JZUFRfMyIsInZhbHVlIjoiMzMzLjQ0NC41NTUtNjYifQ==', '(11) 96666-3333', 'pedro@email.com');

INSERT INTO veiculos (cliente_id, placa, marca, modelo, ano) VALUES
(1, 'ABC1D23', 'Volkswagen', 'Gol 1.6', 2020),
(2, 'XYZ9K88', 'Fiat', 'Argo Drive', 2022),
(3, 'JKL4M56', 'Chevrolet', 'Onix LT', 2021);

INSERT INTO agendamentos (cliente_id, veiculo_id, data_agendamento, descricao_servico, status) VALUES
(1, 1, '2026-11-18 09:00:00', 'Troca de óleo e filtros', 'Pendente'),
(2, 2, '2026-11-17 14:30:00', 'Alinhamento e balanceamento', 'Pendente'),
(3, 3, '2026-11-19 10:00:00', 'Revisão sistema de freios', 'Em Andamento');
