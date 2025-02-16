<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM doadores WHERE id = ?");
    
    $stmt->execute([$id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => "Doador excluído com sucesso"]);
    } else {
        echo json_encode(["error" => "Doador não encontrado ou já excluído"]);
    }
} else {
    echo json_encode(["error" => "ID não fornecido"]);
}
?>
