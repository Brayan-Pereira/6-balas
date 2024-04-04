<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cliente = $_POST['id_cliente'];

    // Prepara e executa a query SQL para deletar o cliente
    $sql = "DELETE FROM clientes WHERE id = '$id_cliente'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente deletado com sucesso.";
    } else {
        echo "Erro ao deletar o cliente: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
