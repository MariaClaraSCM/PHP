<?php
require 'config.php';
session_start();

// Se o usuário estiver logado, busca apenas os dados dele
$usuario = null;
if (isset($_SESSION['usuario_id'])) {
    $id = $_SESSION['usuario_id'];
    $query = $pdo->prepare("SELECT * FROM usuario WHERE id = ?");
    $query->execute([$id]);
    $usuario = $query->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página</title>
</head>

<body>
    <header>
        <nav>
            <?php if ($usuario): ?>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="comprar.php">Comprar</a></li>
                    <div class="perfil">
                        <img src="<?= htmlspecialchars($usuario['foto']) ?>" 
                             alt="<?= htmlspecialchars($usuario['nome']) ?>" 
                             class="foto-perfil">
                        <span><?= htmlspecialchars($usuario['nome']) ?></span>
                    </div>
                    <li><a href="logout.php">Sair</a></li>
                </ul>

            <?php else: ?>
                <ul>
                    <li><a href="index.php">Início</a></li>
                    <li><a href="login.php">Entrar</a></li>
                    <li><a href="create-user.php">Cadastrar</a></li>
                </ul>
            <?php endif; ?>
        </nav>
    </header>
</body>
</html>
