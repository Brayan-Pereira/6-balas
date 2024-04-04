<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_fornecedor = $_POST['id_fornecedor'];

    // Prepara e executa a query SQL para deletar o fornecedor
    $sql = "DELETE FROM fornecedores WHERE id = '$id_fornecedor'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Fornecedor deletado com sucesso.";
    } else {
        echo "Erro ao deletar o fornecedor: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
