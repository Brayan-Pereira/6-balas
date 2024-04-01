<?php
include '../config.php'; // Inclua o arquivo de configuração do banco de dados

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $endereco = $_POST['endereco'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $municipio = $_POST['municipio'];
    $datanascimento = $_POST['datanascimento'];
    $estadocivil = $_POST['estadocivil'];
    $grauinstrucao = $_POST['grauinstrucao'];
    $identidade = $_POST['identidade'];
    $cartdetrabalho = $_POST['cartdetrabalho'];
    $gender = $_POST['gender'];

    // Prepara e executa a query SQL
    $sql = "INSERT INTO funcionarios (name, endereco, cep, bairro, municipio, datanascimento, estadocivil, grauinstrucao, identidade, cartdetrabalho, gender) VALUES ('$name', '$endereco', '$cep', '$bairro', '$municipio', '$datanascimento', '$estadocivil', '$grauinstrucao', '$identidade', '$cartdetrabalho', '$gender')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Funcionário cadastrado com sucesso.";
    } else {
        echo "Erro ao cadastrar o funcionário: " . $conn->error;
    }
}

$conn->close(); // Fecha a conexão com o banco de dados
?>
