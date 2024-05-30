<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Exibir Cervejas</title>
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/global.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/header.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/main.css">

    <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <style>
        body {
            background-color: #000000; /* Fundo preto */
            color: #FFFFFF; /* Cor das letras */
            font-family: Arial, sans-serif;
            padding: 20px; /* Adicionando um pouco de espaço ao redor do conteúdo */
            margin: 0; /* Remover margem padrão do corpo */
            padding: 0; /* Remover preenchimento padrão do corpo */
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: rgba(0, 0, 0, 0.8); /* Fundo escuro */
            padding: 10px 20px; /* Espaçamento interno do cabeçalho */
        }

        main {
            padding-top: 100px; /* Adicionando espaço para o cabeçalho */
            display: flex;
            flex-direction: column; /* Organizando os elementos em coluna */
            justify-content: center; /* Centralizando o conteúdo verticalmente */
            align-items: center; /* Centralizando o conteúdo horizontalmente */
            height: 100vh; /* Definindo altura total da viewport */
            color: whithe;
        }

        h1 {
            margin-bottom: 40px; /* Espaço abaixo do título "Atualizar Produto" */
        }

        h2 {
            margin-top: 40px; /* Espaço acima do título "Dados do Produto" */
            margin-bottom: 20px; /* Espaço abaixo do título "Dados do Produto" */}

        form {
            margin-top: 20px; /* Espaço acima do formulário */
        }

        .table{
            color: #ffffff;
            opacity: .8;
        }
        
    </style>
</head>
<body>
<script src="http://localhost/6-balas/JS/menu.js" defer></script>
    <header>
        <nav>
            <span class="material-symbols-outlined" id="btn_menu">
                menu
            </span>
    
            <section class="menu_hamburger" id="menu_hamburger">
                <div class="topo_menu">
                    <img src="http://localhost/6-BALAS/Components/gun.png" alt="">
                    <span class="material-symbols-outlined" id="btnOff_menu">
                        close
                    </span>
                </div>
    
                <ul>
                    <li><a href="////localhost/6-balas/index.html">Tela inicial</a></li>
                    <li><a onclick="verificacao()" href="////localhost/6-balas/Pages/admin/admin.html">Área do administrador</a></li>
                </ul>
            </section>

        </nav>
    
        <div class="logo">
            <img src="http://localhost/6-BALAS/Components/header/logo/logo.png" alt="">
        </div>

    </header>
    <main>
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
    </main>
</body>
</html>
