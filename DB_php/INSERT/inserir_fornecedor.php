<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeempresa = $_POST['nomeempresa'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $telcontato = $_POST['telcontato'];
    $endereco = $_POST['endereco'];
    $emailcontato = $_POST['emailcontato'];
    $cnpj = $_POST['cnpj'];
    $identidade = $_POST['identidade'];

    // Prepara e executa a query SQL
    $sql = "INSERT INTO fornecedores (nomeempresa, telefone, email, telcontato, endereco, emailcontato, cnpj, identidade) VALUES ('$nomeempresa', '$telefone', '$email', '$telcontato', '$endereco', '$emailcontato', '$cnpj', '$identidade')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Fornecedor cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o fornecedor: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
