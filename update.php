<?php
session_start(); //Verifica se há uma sessão iniciada (conta conectada).
include('verificacao.php');
include('conexao.php');


//Pega informações do usuario que será editado, obtidos do painel.php.
if(isset($_GET['id'])){                                                 
    $_SESSION['idSalvo'] = $_GET['id'];                                 
}                                                            

$id = $_SESSION['idSalvo'];                                             

 //Se a VAR id tiver valor, então fazer consulta no Banco de dados.
if(isset($id)){
    $query = "SELECT * FROM usuario WHERE id = {$id}";
    $result = mysqli_query($conexao, $query);
    $dados_usuario = mysqli_fetch_assoc($result);
    
    //Define as variavéis que vão preencher os inputs, com valores recebidos do BD.
    $nome = $dados_usuario['nome'];
    $email = $dados_usuario['email'];
}

   //Quando o botão enviar for pressionado, Definir variavéis com os dados editados.
if(isset($_POST['concluir'])){
    $nome_editado = $_POST['nome'];   //captura os dados editados do input NOME.
    $email_editado = $_POST['email'];//captura os dados editados do input EMAIL.
    

    if ($nome_editado && $email_editado){//verificação Se os campos estão definidos.
        //Se os dados estiverem definidos, verificar se não existe outra conta ultilizando o mesmo email.
        $query = "SELECT * FROM usuario WHERE email = '{$email_editado}'";
        $result = mysqli_query($conexao, $query);
        $numero_linha = mysqli_num_rows($result);

            //Se existir uma conta cadastrada que já ultiliza o email_editado, avisar o usuário e recarregar a pag.
            if($numero_linha >= 1){
                $consultaEmail= "SELECT * FROM usuario WHERE id = '{$id}'";
                $resultado = mysqli_query($conexao, $consultaEmail);
                $DadosEmail = mysqli_fetch_assoc($resultado);
                $QueryEmail = $DadosEmail['email'];

                if($email_editado != $QueryEmail){
                    $_SESSION['email_ja_ultilizado'] = true; //ALERTA: Que o email já está em uso
                    header('location: update.php');
                    exit();
                
                }else{
                $query = "UPDATE usuario SET nome = '{$nome_editado}', email = '{$email_editado}' WHERE id = {$id}";
                $result = mysqli_query($conexao, $query);
                $_SESSION['usuario_editado_sucesso'] = true; // ALERTA: Que o usuário foi editado com sucesso.
                header('location: painel.php');  //Redirecionar para o painel Admin.
                unset($_SESSION['idSalvo']);     //Remover o valor "ID" da SESSION.
                exit;
                }
            }
    } else {
        //Se o administrador não preencheu todos os dados, emitir aviso.
        header('location: update.php'); //Retornar a pagina de edição.
        $_SESSION['dados_incompletos'] = true; // ALERTA: Que o usuário não preencheu todos os campos.
        exit();
            }   
}
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
    <title>Sistema de Edição</title>
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
                                    <h4 class="mt-1 mb-5 pb-1">Sistema de Edição</h4>
                                </div>

                                <div> <!-- ### ALERTAS ### -->

                                    <!-- ALERTA: se houver campos vazios. -->
                                    <?PHP
                                    if (isset($_SESSION['dados_incompletos'])) {
                                    ?>
                                        <h4 style="color: red;">Dados incompletos!! Preencha todos os dados!!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['dados_incompletos'])
                                    ?><!-- FIM -->

                                    <!-- ALERTA: Se houver um outro usuário já cadastrado com o mesmo email. -->
                                    <?PHP
                                    if (isset($_SESSION['email_ja_ultilizado'])) {
                                    ?>
                                        <h4 style="color: red;">Este Email está cadastrado em outra conta existe!</h4>
                                    <?PHP
                                    }
                                    unset($_SESSION['email_ja_ultilizado'])
                                    ?><!-- FIM -->

            
                                </div> <!-- ### FIM ALERTAS ### -->

                                <form action="update.php" class="text-center w-75" style="margin-right: auto;  margin-left: auto;" method="POST">
                                    <p>Informe os dados para realizar a Edição!</p>

                                    <input type="hidden" name="id" value="<?php echo $id ?>">

                                    <div class="form-outline mb-4 text-center">
                                        <input value="<?php echo $nome ?>" type="text" name="nome" class="form-control" placeholder="informe seu nome completo" />
                                        <label class="form-label" for="nome">Nome Completo:</label>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <input value="<?php echo $email ?>" type="email" name="email" class="form-control" placeholder="informe seu email" />
                                        <label class="form-label" for="email">E-mail</label>
                                    </div>

                                    <div class="text-center pt-1 mb-5 pb-1">
                                        <button name="concluir" class="btn btn-primary btn-block gradient-custom-2" type="submit">Concluir</button>
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