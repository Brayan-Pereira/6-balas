<?php
include '../config.php';

// Dados do formulário
$id_lote = $_POST['lote'];
$id_insumo = $_POST['insumo'];
$quantidade = $_POST['quantidade'];

// Preparando a inserção
$sql = "INSERT INTO insumos_lote (id_lote, id_insumo, quantidade_utilizada) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iid", $id_lote, $id_insumo, $quantidade);

// Executando e verificando sucesso
if ($stmt->execute()) {
    echo "Insumo adicionado ao lote com sucesso.";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
