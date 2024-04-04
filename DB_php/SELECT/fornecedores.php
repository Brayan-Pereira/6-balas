<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Exibir Fornecedores</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Fornecedores</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome da Empresa</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefone de Contato</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">E-mail de Contato</th>
                    <th scope="col">CNPJ</th>
                    <th scope="col">Identidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluir arquivo de configuração do banco de dados
                include '../config.php';

                // Query SQL para selecionar todos os fornecedores
                $sql = "SELECT * FROM fornecedores";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Saída de dados de cada linha
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["nomeempresa"] . "</td>";
                        echo "<td>" . $row["telefone"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["telcontato"] . "</td>";
                        echo "<td>" . $row["endereco"] . "</td>";
                        echo "<td>" . $row["emailcontato"] . "</td>";
                        echo "<td>" . $row["cnpj"] . "</td>";
                        echo "<td>" . $row["identidade"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Nenhum fornecedor encontrado</td></tr>";
                }
                $conn->close(); // Fecha a conexão com o banco de dados
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
