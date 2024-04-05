<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['nomeempresa']) && isset($_POST['telefone']) && isset($_POST['email']) && isset($_POST['telcontato']) && isset($_POST['endereco']) && isset($_POST['emailcontato']) && isset($_POST['cnpj']) && isset($_POST['identidade'])) {
        $id = $_POST['id'];
        $nomeempresa = $_POST['nomeempresa'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $telcontato = $_POST['telcontato'];
        $endereco = $_POST['endereco'];
        $emailcontato = $_POST['emailcontato'];
        $cnpj = $_POST['cnpj'];
        $identidade = $_POST['identidade'];

        $check_fornecedor_sql = "SELECT id FROM fornecedores WHERE id = '$id'";
        $result = $conn->query($check_fornecedor_sql);

        function alert_and_redirect($msg, $url) {
            echo "<script>alert('$msg');</script>";
            echo "<script>window.location.href='$url';</script>";
        }

        if ($result->num_rows > 0) {
            $sql = "UPDATE fornecedores SET nomeempresa='$nomeempresa', telefone='$telefone', email='$email', telcontato='$telcontato', endereco='$endereco', emailcontato='$emailcontato', cnpj='$cnpj', identidade='$identidade' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                alert_and_redirect( "Dados do fornecedor atualizados com sucesso. Redirecionando em 3 segundos...",  "http://localhost/6-BALAS/Pages/admin/admin.html");
            } else {
                alert_and_redirect( `Erro ao atualizar os dados do fornecedor: . $conn->error`, "");
            }
        } else {
            alert_and_redirect( "Fornecedor não encontrado. Redirecionando em 3 segundos...", "http://localhost/6-BALAS/Pages/forms_update/fornecedores.html" );
        }
    }

   
}

$conn->close();

