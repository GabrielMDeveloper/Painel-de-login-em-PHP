<?php

//Host, nome DB, Usuário DB, Senha DB
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '0000');
define('BD', 'login');

$conexao = mysqli_connect(HOST, USUARIO, SENHA, BD) or die('Não foi possível se conetar ao banco de dado!');
