<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="styleetesh" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <title>Sistema de Login</title>
</head>

<body style="background-color: #eee;">

    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <!-- Imagem da Logo -->
                                        <img src="img/logo.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Sistema de Login</h4>
                                    </div>
                                    <!-- Validação de sessão Usuario não autenticado -->
                                    <?PHP
                                    if (isset($_SESSION['usuario_nao_autenticado'])) {
                                    ?>
                                        <h4 style="color: red;">Usuário ou senha não informado!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['usuario_nao_autenticado'])
                                    ?>
                                    <!--Validação se o usuario não existe ou se a senha está incorreta-->
                                    <?PHP
                                    if (isset($_SESSION['usuario_invalido'])) {
                                    ?>
                                        <h4 style="color: red;">Usuário ou senha incorretos!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['usuario_invalido'])
                                    ?>



                                    <form action="login.php" method="POST">
                                        <p>Por favor, faça login na sua conta!</p>

                                        <div class="form-outline mb-4">
                                            <input type="email" name="email" class="form-control" placeholder="informe seu email" required />
                                            <label class="form-label" for="email">E-mail</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="senha" class="form-control" placeholder="informe sua senha" required />
                                            <label class="form-label" for="senha">Senha:</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Entrar</button>
                                            <a class="text-muted" href="#">Esqueceu a senha?</a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Não tem uma conta?</p>
                                            <a href="cadastro.php"><button type="button" class="btn btn-outline-danger">Crie uma!</button></a>
                                        </div>
                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Somos mais que uma empresa. Somos Gamers!</h4>
                                    <p class="small mb-0">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed
                                        do eiusmod
                                        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                        quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>