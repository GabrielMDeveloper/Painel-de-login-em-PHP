<?php
session_start();
include('conexao.php');

$usuario = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);



//Valida se o usuario informou o email e senha
if (empty($usuario) || empty($senha)) {
    //enviar mensagem para o usuario informando que o campo está vazio
    $_SESSION['usuario_nao_autenticado'] = $usuario;
    //Redirecionar para a página inicial
    header('Location: index.php');
    exit();
}else{

$query = "SELECT * FROM usuario WHERE email = '{$usuario}' AND senha = md5('{$senha}')";

$result = mysqli_query($conexao, $query);
$numero_linha = mysqli_num_rows($result);

if ($numero_linha > 0) {
    $_SESSION['usuario'] = $usuario;
    //Se o Usuario está logado, redirecionar ele para a pagina do usuario
    header('Location: painel.php');
    exit;
} else {
    //Não está logado
    //Enviar mensagem para o usuario informando que o email está incorreto
    $_SESSION['usuario_invalido'] = $usuario;
    header('location: index.php');
    exit;
}
}
