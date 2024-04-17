<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Relatório de Lotes de Cerveja</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Relatório de Lotes de Cerveja</h1>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th scope="col">Lote ID</th>
                    <th scope="col">Nome da Cerveja</th>
                    <th scope="col">Data de Elaboração</th>
                    <th scope="col">Insumos Utilizados</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php';

                $sql = "SELECT l.id, l.data_elaboracao, p.nomecerveja, i.insumo, il.quantidade_utilizada
                        FROM lotes_cerveja l
                        JOIN produtos p ON l.id_produto = p.id
                        LEFT JOIN insumos_lote il ON l.id = il.id_lote
                        LEFT JOIN insumos i ON il.id_insumo = i.id
                        ORDER BY l.id";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Variável para armazenar o ID atual do lote
                    $currentId = 0;
                    $insumos = [];
                    while ($row = $result->fetch_assoc()) {
                        if ($currentId != $row['id']) {
                            if ($currentId != 0) {
                                // Exibir a linha da tabela
                                echo "<tr>";
                                echo "<th scope='row'>$currentId</th>";
                                echo "<td>$nomeCerveja</td>";
                                echo "<td>$dataElaboracao</td>";
                                echo "<td><ul>";
                                foreach ($insumos as $insumo) {
                                    echo "<li>$insumo</li>";
                                }
                                echo "</ul></td>";
                                echo "</tr>";
                                $insumos = [];
                            }
                            $currentId = $row['id'];
                            $nomeCerveja = $row['nomecerveja'];
                            $dataElaboracao = $row['data_elaboracao'];
                        }
                        if (!is_null($row['insumo'])) {
                            $insumos[] = $row['insumo'] . " - " . $row['quantidade_utilizada'] . " kg";
                        }
                    }
                    // Exibir a última linha da tabela
                    echo "<tr>";
                    echo "<th scope='row'>$currentId</th>";
                    echo "<td>$nomeCerveja</td>";
                    echo "<td>$dataElaboracao</td>";
                    echo "<td><ul>";
                    foreach ($insumos as $insumo) {
                        echo "<li>$insumo</li>";
                    }
                    echo "</ul></td>";
                    echo "</tr>";
                } else {
                    echo "<tr><td colspan='4'>Nenhum lote encontrado</td></tr>";
                }
                $conn->close(); // Fecha a conexão com o banco de dados
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
