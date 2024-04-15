<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registrar Insumos em Lote</title>
</head>
<body>
    <h1>Adicionar Insumos a um Lote</h1>
    <form action="http://localhost/6-BALAS/DB_php/INSERT/adicionar_insumos.php" method="POST">
        <label for="lote">Selecione o Lote:</label>
        <select name="lote" id="lote" required>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "cerveja";
            // Conectar ao banco de dados
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Checar conexão
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            // Consulta para obter os lotes
            $sqlLotes = "SELECT id, data_elaboracao FROM lotes_cerveja";
            $resultLotes = $conn->query($sqlLotes);
            // Verificar se a consulta retornou linhas
            if ($resultLotes->num_rows > 0) {
                // Iterar sobre os resultados e criar uma opção para cada linha
                while ($rowLote = $resultLotes->fetch_assoc()) {
                    echo '<option value="' . $rowLote["id"] . '">Lote ' . $rowLote["id"] . ' - ' . $rowLote["data_elaboracao"] . '</option>';
                }
            } else {
                echo '<option>Não há lotes disponíveis</option>';
            }
            ?>
        </select>
        <br>
        <label for="insumo">Selecione o Insumo:</label>
        <select name="insumo" id="insumo" required>
            <?php
            // Consulta para obter os insumos
            $sqlInsumos = "SELECT id, insumo FROM insumos";
            $resultInsumos = $conn->query($sqlInsumos);
            // Verificar se a consulta retornou linhas
            if ($resultInsumos->num_rows > 0) {
                // Iterar sobre os resultados e criar uma opção para cada linha
                while ($rowInsumo = $resultInsumos->fetch_assoc()) {
                    echo '<option value="' . $rowInsumo["id"] . '">' . $rowInsumo["insumo"] . '</option>';
                }
            } else {
                echo '<option>Não há insumos disponíveis</option>';
            }
            ?>
        </select>
        <br>
        <label for="quantidade">Quantidade Utilizada:</label>
        <input type="number" step="0.01" name="quantidade" id="quantidade" required>
        <br>
        <button type="submit">Adicionar Insumo ao Lote</button>
       
    </form>
</body>
</html>
