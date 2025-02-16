<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("SELECT * FROM doadores WHERE id = ?");
    $stmt->execute([$id]);

    $doador = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($doador) {
        echo json_encode($doador);
    } else {
        echo json_encode(["error" => "Doador não encontrado"]);
    }
} else {
    echo json_encode(["error" => "ID não fornecido"]);
}
?>
