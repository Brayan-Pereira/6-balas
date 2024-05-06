<?php
include '../config.php';

$produtosSelecionados = json_decode($_POST['produtosSelecionados'], true);

// Inserir a venda na tabela de vendas
foreach ($produtosSelecionados as $produto) {
    $titulo = $produto['titulo'];
    $quantidade = $produto['quantidade'];
    // Consulta SQL para inserir a venda na tabela de vendas
    $sql = "INSERT INTO vendas (id_produto, quantidade, valor_unitario, data_venda) VALUES ('$titulo', '$quantidade', '$valor', NOW())";
    // Executar a consulta
    if ($conn->query($sql) !== TRUE) {
        echo "Erro ao registrar venda: " . $conn->error;
    }
}

$conn->close();

