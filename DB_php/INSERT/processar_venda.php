<?php
// Inclui o arquivo de configuração do banco de dados
include '../config.php';

if (isset($_POST['input_hidden'])) {
    // Verifica se o campo input_hidden não está vazio
    if (!empty($_POST['input_hidden'])) {
        // Recupera os dados do campo input_hidden
        $jsonProdutos = $_POST['input_hidden'];

        // Decodifica os dados JSON em um array PHP
        $produtos = json_decode($jsonProdutos);

        // Verifica se a decodificação foi bem-sucedida
        if ($produtos !== null) {
            // Prepara a consulta de inserção fora do loop foreach
            $stmt = $conn->prepare("INSERT INTO vendas (id_produto, quantidade, valor_unitario, data_venda) VALUES (?, ?, ?, ?)");
            // Verifica se a consulta está preparada corretamente
            if (!$stmt) {
                echo "Erro na preparação da consulta: (" . $conn->errno . ") " . $conn->error;
                exit; // Sai do script se a preparação da consulta falhar
            }

            // Obtém a data atual
            $data_venda = date("Y-m-d");

            // Itera sobre os produtos e registra as vendas no banco de dados
            foreach ($produtos as $produto) {
                // Recupera os dados do produto
                $id_produto = (int)$produto->codigo; // Converte para número inteiro
                $valor_unitario = $produto->preco;
                $quantidade = $produto->quant;

                // Verifica se o id_produto existe na tabela produtos
                $check_stmt = $conn->prepare("SELECT id FROM produtos WHERE id = ?");
                // Verifica se a preparação da consulta está correta
                if (!$check_stmt) {
                    echo "Erro na preparação da consulta: (" . $conn->errno . ") " . $conn->error;
                    exit; // Sai do script se a preparação da consulta falhar
                }
                $check_stmt->bind_param("i", $id_produto);
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

            // Fecha a declaração após o loop foreach
            $stmt->close();
            // Fecha a declaração de verificação
            $check_stmt->close();
            $conn->close();

            echo "Vendas registradas com sucesso!";
        } else {
            echo "Erro ao decodificar os dados JSON.";
        }
    } else {
        echo "Campo input_hidden está vazio";
    }
} else {
    echo "Campo input_hidden não encontrado";
}
?>
