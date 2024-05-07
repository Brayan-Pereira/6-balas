<?php
// Inclua o arquivo de configuração do banco de dados
include '../config.php';

// Receba os dados do produto da requisição POST
$data = json_decode(file_get_contents('php://input'), true);

// Verifique se os dados foram recebidos corretamente
if (!empty($data)) {
    // Inserir a venda na tabela de vendas
    foreach ($data as $produto) {
        $id_produto = $produto['codigo'];
        $quantidade = 1; // Assumindo uma quantidade padrão de 1 para cada produto
        $valor_unitario = $produto['preco'];
        $data_venda = date('Y-m-d'); // Data atual

        // Consulta SQL para inserir a venda na tabela de vendas
        $sql = "INSERT INTO vendas (id_produto, quantidade, valor_unitario, data_venda) 
                VALUES ('$id_produto', '$quantidade', '$valor_unitario', '$data_venda')";

        // Executar a consulta
        if ($conn->query($sql) !== TRUE) {
            // Se ocorrer um erro, envie um código de erro HTTP
            http_response_code(500);
            echo "Erro ao registrar venda: " . $conn->error;
            exit(); // Sair do script em caso de erro
        }
    }
    // Envie uma resposta de sucesso
    http_response_code(200);
    echo "Venda registrada com sucesso.";
} else {
    // Se não houver dados recebidos, envie um código de erro HTTP
    http_response_code(400);
    echo "Nenhum dado recebido.";
}

// Fechar a conexão com o banco de dados
$conn->close();

