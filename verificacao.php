<?php
$usuario = $_SESSION['usuario'];

if (!$usuario) {
    header('Location: index.php');
    exit();
}
