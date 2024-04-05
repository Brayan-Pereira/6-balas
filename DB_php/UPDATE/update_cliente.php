<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica se o formulário foi enviado corretamente
    if (isset($_POST['id']) && isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['number']) && isset($_POST['password']) && isset($_POST['gender'])) {
        // Obtém os valores dos campos do formulário HTML
        $id = $_POST['id'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $email = $_POST['email'];
        $number = $_POST['number'];
        $password = $_POST['password'];
        $gender = $_POST['gender'];

        // Verifica se o cliente com o ID especificado existe na tabela de clientes
        $check_cliente_sql = "SELECT id FROM clientes WHERE id = '$id'";
        $result = $conn->query($check_cliente_sql);

        if ($result->num_rows > 0) {
            // Se o cliente existir, atualiza os dados no banco de dados
            $sql = "UPDATE clientes SET firstname='$firstname', lastname='$lastname', email='$email', number='$number', password='$password', gender='$gender' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Dados do cliente atualizados com sucesso.";
            } else {
                echo "Erro ao atualizar os dados do cliente: " . $conn->error;
            }
        } else {
            // Se o cliente não existir, exibe uma mensagem de erro
            echo "Cliente não encontrado.";
        }
    } else {
        // Se algum campo estiver faltando, exibe uma mensagem de erro
        echo "Todos os campos são obrigatórios.";
    }
}

$conn->close(); // Fecha a conexão com o banco de dados

