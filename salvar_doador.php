<?php
require 'config.php'; // Arquivo para conexão com o banco

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome                  = trim($_POST['nome']);
    $email                 = trim($_POST['email']);
    $cpf                   = trim($_POST['cpf']);
    $telefone              = trim($_POST['telefone']);
    $data_nascimento       = trim($_POST['data_nascimento']);
    $intervalo_doacao      = trim($_POST['intervalo_doacao']);
    $valor_doacao          = trim($_POST['valor_doacao']);
    $forma_pagamento       = trim($_POST['forma_pagamento']);
    $conta_bancaria        = isset($_POST['conta_bancaria']) && $_POST['conta_bancaria'] !== "" ? $_POST['conta_bancaria'] : null;
    $bandeira_cartao       = isset($_POST['bandeira_cartao']) ? trim($_POST['bandeira_cartao']) : null;
    $seis_primeiros_cartao = isset($_POST['seis_primeiros_cartao']) ? trim($_POST['seis_primeiros_cartao']) : null;
    $quatro_ultimos_cartao = isset($_POST['quatro_ultimos_cartao']) ? trim($_POST['quatro_ultimos_cartao']) : null;
    $endereco              = trim($_POST['endereco']);
    $data_cadastro         = date("Y-m-d H:i:s");

    if ($forma_pagamento === "Crédito" && !empty($seis_primeiros_cartao) && !empty($quatro_ultimos_cartao)) {
        $sqlVerifica = "SELECT COUNT(*) FROM doadores WHERE seis_primeiros_cartao = :seis_primeiros_cartao AND quatro_ultimos_cartao = :quatro_ultimos_cartao";
        $stmtVerifica = $pdo->prepare($sqlVerifica);
    
        $stmtVerifica->bindParam(':seis_primeiros_cartao', $seis_primeiros_cartao);
        $stmtVerifica->bindParam(':quatro_ultimos_cartao', $quatro_ultimos_cartao);
    
        $stmtVerifica->execute();
    
        $count = $stmtVerifica->fetchColumn();
    
        if ($count > 0) {
            echo "Não foi possível cadastrar esse número de cartão, entre em contato com o seu supervisor.";
            exit;
        }
    }

    $sql = "INSERT INTO doadores (nome, email, cpf, telefone, data_nascimento, data_cadastro, intervalo_doacao, valor_doacao, forma_pagamento, conta_bancaria, bandeira_cartao, seis_primeiros_cartao, quatro_ultimos_cartao, endereco)
                VALUES (:nome, :email, :cpf, :telefone, :data_nascimento, :data_cadastro, :intervalo_doacao, :valor_doacao, :forma_pagamento, :conta_bancaria, :bandeira_cartao, :seis_primeiros_cartao, :quatro_ultimos_cartao, :endereco)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':data_nascimento', $data_nascimento);
    $stmt->bindParam(':data_cadastro', $data_cadastro);
    $stmt->bindParam(':intervalo_doacao', $intervalo_doacao);
    $stmt->bindParam(':valor_doacao', $valor_doacao);
    $stmt->bindParam(':forma_pagamento', $forma_pagamento);
    $stmt->bindParam(':conta_bancaria', $conta_bancaria);
    $stmt->bindParam(':bandeira_cartao', $bandeira_cartao);
    $stmt->bindParam(':seis_primeiros_cartao', $seis_primeiros_cartao);
    $stmt->bindParam(':quatro_ultimos_cartao', $quatro_ultimos_cartao);
    $stmt->bindParam(':endereco', $endereco);

    if ($stmt->execute()) {
        echo "Doador cadastrado com sucesso!";
        http_response_code(200);
        return json_encode(["message" => "Doador cadastrado com sucesso!"]);
    } else {
        echo "Erro ao cadastrar o doador.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Método inválido.";
}
