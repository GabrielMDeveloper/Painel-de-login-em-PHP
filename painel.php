<?php
session_start();
include('verificacao.php');
include('conexao.php');
$usuario = $_SESSION['usuario'];

$query = "SELECT * FROM usuario WHERE email = '{$usuario}'";
$result = mysqli_query($conexao, $query);
$dados_usuario = mysqli_fetch_assoc($result);

//if($dados_usuario['permissao'] == 'usuario'){
//header('location: painelUsuario.php');
//exit();
//}

//variaveis:
$ShowNome = $dados_usuario['nome'];
$ShowPermissao = $dados_usuario['permissao'];
?>

<!-- ### ALERTAS ### -->

<!-- Alerta: que a conta foi cadastrado com sucesso. -->
<?PHP
if (isset($_SESSION['usuario_cadastrado_com_sucesso'])) {
?>
    <script>
        alert('Usuário cadastrado com sucesso!')
    </script>
<?PHP
}
unset($_SESSION['usuario_cadastrado_com_sucesso'])
?> <!-- FIM -->

<!-- Alerta que o Administrador tentar deletar a propria conta. -->
<?PHP
if (isset($_SESSION['usuario_nao_excluido'])) {
?>
    <script>
        alert('Você não pode excluir o usuário em que está logado!')
    </script>
<?PHP
}
unset($_SESSION['usuario_nao_excluido'])
?> <!-- FIM -->

<!-- Alerta que a conta foi editada com sucesso. -->
<?PHP
if (isset($_SESSION['usuario_editado_sucesso'])) {
?>
    <script>
        alert('O Usuário foi editado com sucesso!')
    </script>
<?PHP
}
unset($_SESSION['usuario_editado_sucesso'])
?> <!-- FIM -->

 <!-- Alerta que a conta foi deletada com sucesso. -->
<?PHP
if (isset($_SESSION['usuario_deletado'])) {
?>
    <script>
        alert('O Usuário foi deletado com sucesso!')
    </script>
<?PHP
}
unset($_SESSION['usuario_deletado'])
?> <!-- FIM -->
<!-- ### FIM ALERTAS ### -->


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Adiministrador </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-dark">
    <nav1 class="d-flex flex-column">
        <div class="d-flex flex-column text-center">
            <h1 class="text-light">Painel do Adiministrador</h1>
        </div>
    
        <div class="d-flex">
            <h3 class="text-light">Usuário logado:    </h3>
            <div class="d-flex flex-column">
                <div class="d-flex">
                <h4 class="text-light"> Nome:  </h4>
                   <h4 class="text-info"> <?php echo $ShowNome ?> </h4>
                </div>
                <div>
                    <h4 class="text-light"> Email: </h4>
                    <h4 class="text-info"><?php echo $usuario ?></h4>
                </div>
            </div>
        </div>
    <br>
    <h3 class="text-light">
        Fazer Logout: <a href="logout.php">SAIR</a>
    </h3>
    </nav1>
    
<div class="">
    
</div>
    <!-- Consulta PHP para retonar informações do Usuario -->
    <?php
    $consulta = "SELECT * FROM usuario";
    $resultado = mysqli_query($conexao, $consulta);
    ?>
    <br><br>
    <table class="table table-striped text-center"  method="POST">
        <!-- 1º Linha da nossa tabela -->
        <tr class="bg-primary">
            <th class="text-light">ID</th>
            <th class="text-light">Nome</th>
            <th class="text-light">E-mail</th>
            <th class="text-light">Senha</th>
            <th class="text-light">Permissao</th>
            <th colspan="5" class="text-align-center text-light">Operações</th>
        </tr>
        <!-- Proximas Linhas da tabela -->
        <?php
        while ($linha = mysqli_fetch_assoc($resultado)) {
            $id = $linha['id'];
            $nome = $linha['nome'];
            $email = $linha['email'];
            $senha = $linha['senha'];
            $permissao = $linha['permissao'];
        ?>
            <tr>
                <td class="text-light"><?php echo $id ?></td>
                <td class="text-light"><?php echo $nome ?></td>
                <td class="text-light"><?php echo $email ?></td>
                <td class="text-light"><?php echo $senha ?></td>
                <td class="text-light"><?php echo $permissao ?></td>
                <td>
                    <a href="update.php?id=<?php echo $id; ?>">                         
                        <button class="btn btn-primary">Editar</button>
                    </a>
                </td>
                <td>
                    <a href="update.php?id=<?php echo $id; ?>">
                        <button class="btn btn-success">Alterar Senha</button>
                    </a>
                </td>
                <td>
                    <a href="delete.php?id=<?php echo $id ?>">
                       <button class="btn btn-danger">Deletar</button>
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>