<?php

include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Criptografa a senha
    $gender = $_POST['gender'];

    // Prepara e executa a query SQL
    $sql = "INSERT INTO clientes (firstname, lastname, email, number, password, gender) VALUES ('$firstname', '$lastname', '$email', '$number', '$password', '$gender')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Cliente cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o cliente: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
