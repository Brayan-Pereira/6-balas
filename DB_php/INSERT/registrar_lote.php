<?php
include '../config.php';

// Recebendo dados do formulário
$id_produto = $_POST['produto'];
$data_elaboracao = $_POST['data_elaboracao'];

// Preparando a query SQL
$sql = "INSERT INTO lotes_cerveja (id_produto, data_elaboracao) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $id_produto, $data_elaboracao);

// Executando a query e verificando sucesso
if ($stmt->execute()) {
    echo "Novo lote registrado com sucesso.";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();

