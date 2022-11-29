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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <title>Sistema de Login</title>
</head>

<body style="background-color: #eee; ">

    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">

                            <div class="d-flex flex-column card-body p-md-5 mx-md-4 text-center">

                                <div class="text-center">
                                    <!-- Imagem da Logo -->
                                    <img src="img/logo.png" style="width: 185px;" alt="logo">
                                    <h4 class="mt-1 mb-5 pb-1">Sistema de Login</h4>
                                </div>

                                <div>
                                    <!-- Validação: Se todos os campos foram preenchidos. -->
                                    <?PHP
                                    if (isset($_SESSION['dados_incompletos'])) {
                                    ?>
                                        <h4 style="color: red;">Dados incompletos!! imforme todos os dados!!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['dados_incompletos'])
                                    ?>
                                    <?PHP
                                    if (isset($_SESSION['usuario_cadastrado'])) {
                                    ?>
                                        <h4 style="color: red;">Este email já está em uso!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['usuario_cadastrado'])
                                    ?>
                                    <?PHP
                                    if (isset($_SESSION['usuario_cadastrado_com_sucesso'])) {
                                    ?>
                                        <h4 style="color: blue;">Usuário Cadastrado com sucesso!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['usuario_cadastrado_com_sucesso'])
                                    ?>
                                </div>

                                <form action="cadastrar.php" class="text-center w-75" style="margin-right: auto;  margin-left: auto;" method="POST">
                                    <p>Por favor, Informe os dados para realizar o cadastro!</p>

                                    <div class="form-outline mb-4 text-center">
                                        <input type="nome" name="nome" class="form-control" placeholder="informe seu nome completo" required />
                                        <label class="form-label" for="nome">Nome Completo:</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="email" name="email" class="form-control" placeholder="informe seu email" />
                                        <label class="form-label" for="email">E-mail</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input type="password" name="senha" class="form-control" placeholder="informe sua senha" />
                                        <label class="form-label" for="senha">Senha:</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button class="btn btn-primary btn-block gradient-custom-2" type="submit">Cadastrar</button>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Já tem uma conta?</p>
                                            <a href="index.php"><button type="button" class="btn btn-outline-danger">Faça Login!</button></a>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>