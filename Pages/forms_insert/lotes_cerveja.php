<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrar Lote de Cerveja</title>
</head>

<body>
    <h1>Registrar Novo Lote de Cerveja</h1>
    <form action="http://localhost/6-BALAS/DB_php/INSERT/registrar_lote.php" method="POST">
        <label for="produto">Selecione o Produto:</label>
        <select name="produto" id="produto" required>
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
            // Consulta para obter os produtos
            $sql = "SELECT id, nomecerveja FROM produtos";
            $result = $conn->query($sql);

            // Verificar se a consulta retornou linhas
            if ($result->num_rows > 0) {
                // Iterar sobre os resultados e criar uma opção para cada linha
                while ($row = $result->fetch_assoc()) {
                    echo '<option value="' . $row["id"] . '">' . $row["nomecerveja"] . '</option>';
                }
            } else {
                echo '<option>Não há produtos disponíveis</option>';
            }

            // Fechar conexão
            $conn->close();
            ?>
        </select>
        <br>
        <label for="data_elaboracao">Data de Elaboração:</label>
        <input type="date" name="data_elaboracao" id="data_elaboracao" required>
        <br>
        <button type="submit">Registrar Lote</button>
    </form>
</body>

</html>