<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Exibir Cervejas</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Lista de Cervejas</h1>

        <!-- Formulário de filtro -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" class="form-inline mb-3">
            <div class="form-group mr-2">
                <label for="tipo">Filtrar por Tipo:</label>
                <input type="text" class="form-control" id="tipo" name="tipo" placeholder="Digite o tipo">
            </div>
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../config.php'; // Inclua o arquivo de configuração do banco de dados

                // Definir o filtro padrão
                $filtro = "";

                // Verificar se um filtro foi submetido
                if(isset($_GET['tipo']) && !empty($_GET['tipo'])) {
                    $filtro = "WHERE tipo LIKE '%" . $_GET['tipo'] . "%'";
                }

                // Query SQL para selecionar cervejas com base no filtro
                $sql = "SELECT * FROM produtos $filtro";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Saída de dados de cada linha
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<th scope='row'>" . $row["id"] . "</th>";
                        echo "<td>" . $row["nomecerveja"] . "</td>";
                        echo "<td>" . $row["tipo"] . "</td>";
                        echo "<td>" . $row["valor"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Nenhuma cerveja encontrada</td></tr>";
                }
                $conn->close(); // Fecha a conexão com o banco de dados
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
