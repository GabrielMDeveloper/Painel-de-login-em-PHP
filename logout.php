<?php
session_start();
session_destroy();
$_SESSION['usuario'] = "";
header('Location: index.php');
exit();
