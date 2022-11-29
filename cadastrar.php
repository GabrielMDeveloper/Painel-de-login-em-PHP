 <?php
ini_set("display_errors", "1");
ini_set("display_startup_errors", "1");
error_reporting(E_ALL);
session_start();
include('conexao.php');

//Pega informações que usuario passou pela página cadastro.php
$nome = mysqli_real_escape_string($conexao, $_POST['nome']);
$usuario = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

//Valida se o usuario informou o nome, email ou senha
if (empty($nome) || empty($usuario) || empty($senha)) {
    //enviar mensagem para o usuario informando que o campo está vazio
    $_SESSION['dados_incompletos'] = $usuario;
    //Redirecionar para a página cadastro.php
    header('Location: cadastro.php');
    exit();
}
//Consulta no banco para verificar se o Usuario existe
$query = "SELECT * FROM usuario WHERE email = '{$usuario}'";
$result = mysqli_query($conexao, $query);
$numero_linha = mysqli_num_rows($result);


if ($numero_linha >0) {
    //O usuario ja existe no sistema
    //enviar mensagem para o usuario informando que o usuario ja esxiste
    $_SESSION['usuario_cadastrado'] = $usuario;
    //Redirecionar para a página cadastro.php
    header('Location: cadastro.php');
    exit();
} else {
    //Caso o usuario informado não exista, então 
    //vamos incluir no banco e retornar a mensagem de 
    //cadastrado com sucesso!
    $insereNoBanco = "INSERT INTO usuario (id, nome, email, senha, permissao)
            VALUES (NULL, '{$nome}', '{$usuario}', md5('{$senha}'), 'usuario')";

    //Insere no banco de dados
    if ($conexao->query($insereNoBanco) === true) {
        //Se a inserção dos dado no banco for feita
        //Retorno mensagem para o painel do usuário
        $_SESSION['usuario_cadastrado_sucesso'] = true;
        //seta a sessão para o usuario
        $_SESSION['usuario'] = $usuario;
    }
    //fecha a conexão com o banco de dados por segurança
    $conexao->close();
    header('Location: painel.php');
    exit;
}
