<?php
// Inclui o arquivo de configuração do banco de dados
include '../config.php';

if (isset($_POST['input_hidden'])) {
    $stmt = $conn->prepare("INSERT INTO vendas (codigo_venda, id_produto, quantidade, valor_unitario, data_venda, id_cliente) VALUES (?, ?, ?, ?, ?, ?)");

    // Verifica se a consulta está preparada corretamente
    if (!$stmt) {
        echo "Erro na preparação da consulta: (" . $conn->errno . ") " . $conn->error;
        // Redireciona para a página de login
        header("Location: http://localhost/6-balas/Pages/user/login.php");
        exit();
    } else {
        $jsonProdutos = $_POST['input_hidden'];

        $produtos = json_decode($jsonProdutos);

        // Verifica se a decodificação do JSON foi bem-sucedida
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Erro ao decodificar JSON: " . json_last_error_msg();
            // Redireciona para a página de login
            header("Location: http://localhost/6-balas/Pages/user/login.php");
            exit();
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
                $quantidade = $produto->quant;
                $codigo_usuario = $produto->user->idUser;

                // Verifica se o id_produto existe na tabela produtos
                $check_stmt = $conn->prepare("SELECT id FROM produtos WHERE id = ?");
                $check_stmt->bind_param("i", $id_produto);
                $check_stmt->execute();
                $check_result = $check_stmt->get_result();

                // Se o id_produto existe, proceda com a inserção na tabela vendas
                if ($check_result->num_rows > 0) {
                    // Verifica se o código do usuário existe na tabela de usuários
                    $check_user_stmt = $conn->prepare("SELECT id FROM clientes WHERE id = ?");
                    $check_user_stmt->bind_param("i", $codigo_usuario);
                    $check_user_stmt->execute();
                    $check_user_result = $check_user_stmt->get_result();

                    if ($check_user_result->num_rows > 0) {
                        // Associa os parâmetros à consulta preparada e executa a inserção
                        $stmt->bind_param("iiidsi", $codigo_venda, $id_produto, $quantidade, $valor_unitario, $data_venda, $codigo_usuario);
                        $stmt->execute();
                    } else {
                        echo "ID de cliente inválido. Venda não registrada.";
                        // Redireciona para a página de login
                        header("Location: http://localhost/6-balas/Pages/user/login.php");
                        exit();
                    }

                    // Fecha a declaração de verificação de usuário
                    $check_user_stmt->close();
                } else {
                    echo "Produto com id $id_produto não encontrado na tabela produtos. Venda não registrada.";
                }

                // Fecha a declaração de verificação de produto
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
?>
