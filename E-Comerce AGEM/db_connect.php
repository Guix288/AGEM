<?php
// Define os detalhes da conexão com o banco de dados MySQL
$servername = "localhost";
$username = "seu_usuario"; // ATUALIZE com seu usuário do MySQL
$password = "sua_senha";   // ATUALIZE com sua senha do MySQL
$dbname = "agem_db";       // Nome do banco de dados

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão e retorna erro se falhar
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados: " . $conn->connect_error]);
    exit();
}

// Configura o charset para UTF-8
$conn->set_charset("utf8mb4");

// O objeto $conn é usado pelos arquivos da API.
?>