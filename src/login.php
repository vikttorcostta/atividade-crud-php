<?php

include_once __DIR__ . '/classes/Auth.php';
include_once __DIR__ . '/classes/UsuarioModel.php';
include_once __DIR__ . '/classes/BancoDados.php';

use BancoDados\BancoDados;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

        $email = $_POST['email'];
        $senha = $_POST['senha'];

        $pdo = "SELECT email, senha FROM usuario WHERE email = :email and senha = :senha";
        $estado = BancoDados::getInstance()->getConnection()->prepare($pdo);
        $estado->bindParam(":email", $email);
        $estado->bindParam(":senha", $senha);
        $estado->execute();
        $usuario = $estado->fetch(\PDO::FETCH_ASSOC);
    
        if ($usuario){
            header('Location: system.php?mensagem=sucesso');
        } else {
            header('Location: ../index.php?messagem=error');
        }
}
