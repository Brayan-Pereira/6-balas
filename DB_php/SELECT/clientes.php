<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Exibir Clientes</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Clientes</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Número</th>
                    <th scope="col">Gênero</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir arquivo de configuração do banco de dados
                include '../config.php';

                // Query SQL para selecionar todos os clientes
                $sql = "SELECT * FROM clientes";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Saída de dados de cada linha
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum cliente encontrado</td></tr>";
                }
                $conn->close(); // Fecha a conexão com o banco de dados
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
