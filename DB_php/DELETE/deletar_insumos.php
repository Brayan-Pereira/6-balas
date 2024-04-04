<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_insumo = $_POST['id_insumo'];

    // Prepara e executa a query SQL para deletar o insumo
    $sql = "DELETE FROM insumos WHERE id = '$id_insumo'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Insumo deletado com sucesso.";
    } else {
        echo "Erro ao deletar o insumo: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
