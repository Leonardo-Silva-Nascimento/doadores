<?php
include 'config.php';

$sql = "CREATE TABLE IF NOT EXISTS doadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    cpf VARCHAR(14) UNIQUE NOT NULL,
    telefone VARCHAR(20) NOT NULL,
    data_nascimento DATE NOT NULL,
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    intervalo_doacao ENUM('Único', 'Bimestral', 'Semestral', 'Anual') NOT NULL,
    valor_doacao DECIMAL(10,2) NOT NULL,
    forma_pagamento ENUM('Débito', 'Crédito') NOT NULL,
    conta_bancaria VARCHAR(50) NULL,
    bandeira_cartao VARCHAR(20) NULL,
    seis_primeiros_cartao VARCHAR(6) NULL,
    quatro_ultimos_cartao VARCHAR(4) NULL,
    endereco TEXT NOT NULL,
    UNIQUE (seis_primeiros_cartao, quatro_ultimos_cartao)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

try {
    $pdo->exec($sql);
    echo "Tabela 'doadores' criada (ou já existe).";
} catch (PDOException $e) {
    die("Erro ao criar tabela: " . $e->getMessage());
}
?>
