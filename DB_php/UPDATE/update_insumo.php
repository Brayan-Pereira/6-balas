<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['codfornecedor']) && isset($_POST['insumo']) && isset($_POST['quantidade'])) {
        $id = $_POST['id'];
        $codfornecedor = $_POST['codfornecedor'];
        $insumo = $_POST['insumo'];
        $quantidade = $_POST['quantidade'];

        $check_insumo_sql = "SELECT id FROM insumos WHERE id = '$id'";
        $result = $conn->query($check_insumo_sql);

        if ($result->num_rows > 0) {
            $sql = "UPDATE insumos SET codfornecedor='$codfornecedor', insumo='$insumo', quantidade='$quantidade' WHERE id='$id'";

            if ($conn->query($sql) === TRUE) {
                echo "Dados do insumo atualizados com sucesso.";
            } else {
                echo "Erro ao atualizar os dados do insumo: " . $conn->error;
            }
        } else {
            echo "Insumo não encontrado.";
        }
    } else {
        echo "Todos os campos são obrigatórios.";
    }
}

$conn->close();

