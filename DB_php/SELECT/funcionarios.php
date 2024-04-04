<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Exibir Funcionários</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Funcionários</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Município</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Estado Civil</th>
                    <th scope="col">Grau de Instrução</th>
                    <th scope="col">Identidade</th>
                    <th scope="col">Carteira de Trabalho</th>
                    <th scope="col">Gênero</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir arquivo de configuração do banco de dados
                include '../config.php';

                // Query SQL para selecionar todos os funcionários
                $sql = "SELECT * FROM funcionarios";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Saída de dados de cada linha
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["endereco"] . "</td>";
                        echo "<td>" . $row["cep"] . "</td>";
                        echo "<td>" . $row["bairro"] . "</td>";
                        echo "<td>" . $row["municipio"] . "</td>";
                        echo "<td>" . $row["datanascimento"] . "</td>";
                        echo "<td>" . $row["estadocivil"] . "</td>";
                        echo "<td>" . $row["grauinstrucao"] . "</td>";
                        echo "<td>" . $row["identidade"] . "</td>";
                        echo "<td>" . $row["cartdetrabalho"] . "</td>";
                        echo "<td>" . $row["gender"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='12'>Nenhum funcionário encontrado</td></tr>";
                }
                $conn->close(); // Fecha a conexão com o banco de dados
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
