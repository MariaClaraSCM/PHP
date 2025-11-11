<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $query = $pdo->prepare('SELECT * FROM usuario WHERE email = ?');
    $query->execute([$email]);
    $usuario = $query->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        session_start();// vem do banco
        foreach($usuario as $u){
            if ($u['nivel'] === 'adm') {
                header('Location: dashboard.php');
            } else {
                header('Location: index.php');
            }
            exit;
        }
    } else {
        echo "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<body>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="password" name="senha" id="">

        <input type="submit" value="Salvar">
    </form>

    <p>Não tem cadastro? <a href="create-user.php">Clique aqui</a></p>
</body>

</html>