<?php
// Inclui o arquivo de configuração do banco de dados
include '../config.php';

if (isset($_POST['input_hidden'])) {
    $stmt = $conn->prepare("INSERT INTO vendas (codigo_venda, id_produto, quantidade, valor_unitario, data_venda) VALUES (?, ?, ?, ?, ?)");

    // Verifica se a consulta está preparada corretamente
    if (!$stmt) {
        echo "Erro na preparação da consulta: (" . $conn->errno . ") " . $conn->error;
    } else {
        $jsonProdutos = $_POST['input_hidden'];

        $produtos = json_decode($jsonProdutos);

        // Verifica se a decodificação do JSON foi bem-sucedida
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar JSON: " . json_last_error_msg();
            // Redireciona de volta à mesma página para tentar novamente
            header("Location: " . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Verifica se $produtos é um array ou um objeto
        if (is_array($produtos) || is_object($produtos)) {
            // Obtém a data atual
            $data_venda = date("Y-m-d");

            $codigo_venda = rand(100, 999);

            // Itera sobre os produtos e registra as vendas no banco de dados
            foreach ($produtos as $produto) {
                $id_produto = (int) $produto->codigo; // Converte para número inteiro
                $valor_unitario = str_replace(',', '.', $produto->preco); // Substitui a vírgula por ponto
                echo "<script>console.log('$id_produto');</script>";
                $quantidade = $produto->quant;

                // Verifica se o id_produto existe na tabela produtos
                $check_stmt = $conn->prepare("SELECT id FROM produtos WHERE id = ?");
                $check_stmt->bind_param("i", $id_produto);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();

                // Se o id_produto existe, proceda com a inserção na tabela vendas
                if ($check_result->num_rows > 0) {
                    // Associa os parâmetros à consulta preparada e executa a inserção
                    $stmt->bind_param("iiids", $codigo_venda, $id_produto, $quantidade, $valor_unitario, $data_venda);
                    $stmt->execute();
                } else {
                    echo "Produto com id $id_produto não encontrado na tabela produtos. Venda não registrada.";
                }

                // Fecha a declaração de verificação
                $check_stmt->close();
            }

            // Fecha a declaração de inserção e a conexão
            $stmt->close();
            $conn->close();

            echo "Vendas registradas com sucesso!";
            header("Location: http://localhost/6-balas/Pages/user/processarCompra.html");
            exit();
        } else {
            echo "Nenhum produto para registrar vendas.";
        }
    }
} else {
    echo "Campo input_hidden não encontrado";
}
