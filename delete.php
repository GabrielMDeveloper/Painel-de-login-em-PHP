<?php
session_start();
include('verificacao.php');
include('conexao.php');

//Usuario logado
$usuario_logado = $_SESSION['usuario'];
//
$query = "SELECT * FROM usuario WHERE email = '{$usuario}'";
$result = mysqli_query($conexao, $query);
$dados_usuario = mysqli_fetch_assoc($result);

$id_usuario_logado = $dados_usuario['id'];
$id = $_GET['id'];
//verificação Se o Id foi  passado
if (isset($id)) {
    //Se o id for o logado não será excluido!
    if ($id == $id_usuario_logado) {
        $_SESSION["usuario_nao_excluido"] = $usuario_logado;
        header('location: painel.php');
        exit;
    } else {

        //Se existe essa id então vamos deleter o usuario no banco
        $query = "DELETE FROM usuario WHERE id = {$id}";
        $result = mysqli_query($conexao, $query);
        $_SESSION['usuario_deletado'] = true;
        header('location: painel.php');
        exit;
    }
}
