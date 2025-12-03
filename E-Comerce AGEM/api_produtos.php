<?php
// Retorna JSON para o frontend React
header('Content-Type: application/json');

// Permite requisições de origens diferentes (CORS) - ESSENCIAL em ambientes de desenvolvimento
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

// Inclui o script de conexão
include 'db_connect.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Busca todos os produtos na tabela
    $sql = "SELECT id, nome, descricao, preco, imagem_url FROM produtos";
    $result = $conn->query($sql);

    $produtos = [];
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            // Garante que o preço é um número (float) no JSON
            $row['preco'] = (float) $row['preco']; 
            $produtos[] = $row;
        }
    }
    
    // Retorna a lista de produtos para o React
    echo json_encode(["success" => true, "data" => $produtos]);
} else {
    // Método não permitido
    http_response_code(405);
    echo json_encode(["success" => false, "message" => "Método não permitido."]);
}

$conn->close();
?>