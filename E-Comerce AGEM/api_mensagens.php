<?php
header('Content-Type: application/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'POST') {
    // Recebe os dados JSON do frontend React
    $data = json_decode(file_get_contents("php://input"), true);
    
    // Prepara os dados para evitar injeção SQL
    $nome = $conn->real_escape_string($data['nome_cliente']);
    $telefone = $conn->real_escape_string($data['telefone']);
    $mensagem = $conn->real_escape_string($data['mensagem']);

    $sql = "INSERT INTO mensagens (nome_cliente, telefone, mensagem, status) VALUES ('$nome', '$telefone', '$mensagem', 'Novo')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(["success" => true, "message" => "Mensagem/Pedido salvo com sucesso!"]);
    } else {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Erro ao salvar a mensagem: " . $conn->error]);
    }
} else {
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método não permitido."]);
}

$conn->close();
?>