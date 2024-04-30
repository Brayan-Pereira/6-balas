<!DOCTYPE html>
<html lang="pt-br" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/global.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/header.css">
    <link rel="stylesheet" href="http://localhost/6-BALAS/CSS/login/login.css">
    <style>
        .btn-custom {
            color: white;
            text-decoration: none;
        }
    </style>
    <title>Login</title>
</head>

<body class="d-flex justify-content-center">
<?php
include './config.php';
    // Verificar se os campos de email e senha foram submetidos
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $senha = $_POST['senha'];

        // Consulta SQL para verificar se o email e a senha correspondem a um registro na tabela clientes
        $sql = "SELECT id, firstname, lastname FROM clientes WHERE email = '$email' AND password = '$senha'";
        $result = $conn->query($sql);

        // Verificar se a consulta retornou algum resultado
        if ($result->num_rows > 0) {
            // Se houver um registro correspondente, redirecione para a página desejada
            header("Location: http://localhost/6-balas/Pages/user/loja.php");
            exit();
        } else {
            // Se não houver um registro correspondente, exiba um alerta e redirecione de volta para a página de login
            echo "<script>alert('Email ou senha incorretos');</script>";
        }
    }

    $conn->close();
    ?>

    <script src="http://localhost/6-BALAS/JS/menu.js" defer></script>
    <script src="http://localhost/6-BALAS/JS/admin.js" defer></script>
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
                    <li><a onclick="verificacao()" href="#">Área do administrador</a></li>
                </ul>
            </section>
        </nav>

        <h1>Venha beber com a gente!</h1>

        <div class="logo">
            <img src="http://localhost/6-BALAS/Components/header/logo/logo.png" alt="">
        </div>
    </header>
    <div class="login">
        <main class="w-100 m-auto form-container">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <h1 class="h3 mb-5 fw-normal">Login</h1>
                <div class="form-floating">
                    <input type="email" class="form-control" id="email" name="email" placeholder="seu-email@gmail.com" required />
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating pt-2">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Sua senha" required />
                    <label for="senha">Senha</label>
                </div>
                <div class="form-check text-start my-3">
                    <input type="checkbox" class="form-check-input" id="flexCheckDefault" />
                    <label class="form-check-label" for="flexCheckDefault">Continuar conectado</label>
                    <u><a href="http://localhost/6-balas/Pages/forms_insert/clientes.html">Não tenho cadastro</a></u>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Entrar</button>
            </form>
        </main>
    </div>
</body>

</html>
