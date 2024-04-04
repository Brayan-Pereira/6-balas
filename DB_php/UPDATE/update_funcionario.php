<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['endereco']) && isset($_POST['cep']) && isset($_POST['bairro']) && isset($_POST['municipio']) && isset($_POST['datanascimento']) && isset($_POST['estadocivil']) && isset($_POST['grauinstrucao']) && isset($_POST['identidade']) && isset($_POST['cartdetrabalho']) && isset($_POST['gender'])) {
        $id = $_POST['id'];
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

        $check_funcionario_sql = "SELECT id FROM funcionarios WHERE id = '$id'";
        $result = $conn->query($check_funcionario_sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE funcionarios SET name='$name', endereco='$endereco', cep='$cep', bairro='$bairro', municipio='$municipio', datanascimento='$datanascimento', estadocivil='$estadocivil', grauinstrucao='$grauinstrucao', identidade='$identidade', cartdetrabalho='$cartdetrabalho', gender='$gender' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Dados do funcionário atualizados com sucesso.";
            } else {
                echo "Erro ao atualizar os dados do funcionário: " . $conn->error;
            }
        } else {
            echo "Funcionário não atualizado";
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}

$conn->close();
