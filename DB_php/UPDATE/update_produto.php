<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o formulário foi enviado corretamente
    if (isset($_POST['id']) && isset($_POST['nomecerveja']) && isset($_POST['tipo']) && isset($_POST['valor'])) {
        // Obtém os valores dos campos do formulário HTML
        $id = $_POST['id'];
        $nomecerveja = $_POST['nomecerveja'];
        $tipo = $_POST['tipo'];
        $valor = $_POST['valor'];

        // Verifica se o produto com o ID especificado existe na tabela de produtos
        $check_produto_sql = "SELECT id FROM produtos WHERE id = '$id'";
        $result = $conn->query($check_produto_sql);

        if ($result->num_rows > 0) {
            // Se o produto existir, atualiza os dados no banco de dados
            $sql = "UPDATE produtos SET nomecerveja='$nomecerveja', tipo='$tipo', valor='$valor' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Dados do produto atualizados com sucesso.";
            } else {
                echo "Erro ao atualizar os dados do produto: " . $conn->error;
            }
        } else {
            // Se o produto não existir, exibe uma mensagem de erro
            echo "Produto não encontrado.";
        }
    } else {
        // Se algum campo estiver faltando, exibe uma mensagem de erro
        echo "Todos os campos são obrigatórios.";
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
