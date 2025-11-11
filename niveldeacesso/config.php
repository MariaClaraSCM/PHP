<?php
    $host = 'localhost';
    $banco = 'niveisdeacesso';
    $usuario = 'root';
    $senha = '';

    try{
        //pbjeto de conexão
        $pdo = new PDO("mysql:host=$host;dbname=$banco", $usuario, $senha);
    } catch(PDOException $e){
        die("Erro na conexão: " . $e->getMessage());
    }

?>