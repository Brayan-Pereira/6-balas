<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Relatório de Lotes de Cerveja</title>
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
                    <li><a href="localhost/6-balas/index.html">Tela inicial</a></li>
                    <li><a onclick="verificacao()" href="#">Área do administrador</a></li>
                </ul>
            </section>

        </nav>
    
        <div class="logo">
            <img src="http://localhost/6-BALAS/Components/header/logo/logo.png" alt="">
        </div>

    </header>
    <main>
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
                            $insumos[] = $row['insumo'] . " - " . $row['quantidade_utilizada'] ." kg/ Litro";
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
    </main>
</body>
</html>
