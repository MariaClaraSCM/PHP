<?php
session_start();

if (!isset($_SESSION['usuario_id']) || $_SESSION['nivel_acesso'] !== 'adm') {
    header('Location: index.php');
    exit;
}
?>