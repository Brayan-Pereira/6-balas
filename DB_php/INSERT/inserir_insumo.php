<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores dos campos do formulário HTML
    $codfornecedor = $_POST['codfornecedor'];
    $insumo = $_POST['insumo'];
    $quantidade = $_POST['quantidade'];

    // Verifica se o código do fornecedor existe na tabela de fornecedores
    $check_fornecedor_sql = "SELECT id FROM fornecedores WHERE id = '$codfornecedor'";
    $result = $conn->query($check_fornecedor_sql);

    if ($result->num_rows > 0) {
        // Se o código do fornecedor existir, insere o insumo no banco de dados
        $sql = "INSERT INTO insumos (codfornecedor, insumo, quantidade) VALUES ('$codfornecedor', '$insumo', '$quantidade')";

        if ($conn->query($sql) === TRUE) {
            echo "Insumo cadastrado com sucesso.";
        } else {
            echo "Erro ao cadastrar o insumo: " . $conn->error;
        }
    } else {
        // Se o código do fornecedor não existir, exibe uma mensagem de erro
        echo "Código do fornecedor inválido.";
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
