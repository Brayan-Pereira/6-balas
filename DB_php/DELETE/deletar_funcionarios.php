<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_funcionario = $_POST['id_funcionario'];

    // Prepara e executa a query SQL para deletar o funcionário
    $sql = "DELETE FROM funcionarios WHERE id = '$id_funcionario'";
    
    if ($conn->query($sql) === TRUE) {
        echo "Funcionário deletado com sucesso.";
    } else {
        echo "Erro ao deletar o funcionário: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
