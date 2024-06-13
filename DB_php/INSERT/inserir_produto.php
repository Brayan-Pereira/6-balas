<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomecerveja = $_POST['nomecerveja'];
    $tipo = $_POST['tipo'];
    $valor = str_replace(',', '.', $_POST['valor']);


    // Prepara e executa a query SQL
    $sql = "INSERT INTO produtos (nomecerveja, tipo, valor) VALUES ('$nomecerveja', '$tipo', '$valor')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Produto cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o produto: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
