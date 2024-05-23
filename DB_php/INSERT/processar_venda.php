<?php
// Inclui o arquivo de configuração do banco de dados
include '../config.php';

if (isset($_POST['input_hidden'])) {
    $stmt = $conn->prepare("INSERT INTO vendas (id_produto, quantidade, valor_unitario, data_venda) VALUES (?, ?, ?, ?)");

    // Verifica se a consulta está preparada corretamente
    if (!$stmt) {
        echo "Erro na preparação da consulta: (" . $conn->errno . ") " . $conn->error;
    }

    $jsonProdutos = $_POST['input_hidden'];
   
    $produtos = json_decode($jsonProdutos);

    // Obtém a data atual
    $data_venda = date("Y-m-d");
    
    // Itera sobre os produtos e registra as vendas no banco de dados
    foreach ($produtos as $produto) {
        $id_produto = (int)$produto->codigo; // Converte para número inteiro
        $valor_unitario = $produto->preco;
        echo "<script>console.log('$id_produto');</script>";
        $quantidade = 1;
        
        
        // Supõe-se que id_cliente vem de algum formulário ou fonte de dados

        // Verifica se o id_produto existe na tabela produtos
        $check_stmt = $conn->prepare("SELECT id FROM produtos WHERE id = '$id_produto'");
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        // Se o id_produto existe, proceda com a inserção na tabela vendas
        if ($check_result->num_rows > 0) {
            // Associa os parâmetros à consulta preparada e executa a inserção
            $stmt->bind_param("iids", $id_produto, $quantidade, $valor_unitario, $data_venda);
            $stmt->execute();
        } else {
            echo "Produto com id $id_produto não encontrado na tabela produtos. Venda não registrada.";
        }
    }

    // Fecha a conexão e a declaração
    $stmt->close();
    $check_stmt->close();
    $conn->close();

    echo "Vendas registradas com sucesso!";
} else {
    echo "Campo input_hidden não encontrado";
}