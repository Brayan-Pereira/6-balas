<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_cerveja = $_POST['id_cerveja'];

    // Prepara e executa a query SQL para deletar a cerveja
    $sql = "DELETE FROM produtos WHERE id = '$id_cerveja'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cerveja deletada com sucesso.";
    } else {
        echo "Erro ao deletar a cerveja: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
