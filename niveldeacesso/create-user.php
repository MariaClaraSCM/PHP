<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $caminho_foto = null; // valor padrão

    // Verifica se veio um arquivo
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $nome_arquivo = uniqid('user_', true) . '.' . $extensao;
        $pasta_destino = 'imgs/users/';
        $caminho_foto = $pasta_destino . $nome_arquivo;

        // Cria a pasta se não existir
        if (!is_dir($pasta_destino)) {
            mkdir($pasta_destino, 0777, true);
        }

        // Move o arquivo enviado
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $caminho_foto)) {
            echo 'Erro ao salvar a foto.';
            $caminho_foto = null;
        }
    } else if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {
        // Só mostra erro se houve tentativa de upload e falhou
        echo 'Erro no upload da foto.';
    }

    // Criptografa a senha
    $senha_hash = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    // Insere no banco
    $query = $pdo->prepare("INSERT INTO usuario (nm_usuario, email, senha, foto) VALUES (?, ?, ?, ?)");
    $query->execute([$_POST['nome'], $_POST['email'], $senha_hash, $caminho_foto]);

    header("Location: login.php");
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="text" name="nome" id="">
        <input type="email" name="email" id="">
        <input type="password" name="senha" id="">
        <input type="file" name="foto" id="">

        <input type="submit" value="Salvar">
    </form>

    <p>Já tem cadastro? <a href="login.php">Clique aqui</a></p>
</body>

</html>