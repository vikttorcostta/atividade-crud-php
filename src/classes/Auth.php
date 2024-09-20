<?php

namespace Auth;
include_once __DIR__ . '/BancoDados.php';
use BancoDados\BancoDados;
class Auth
{
    public static function validarLogin($email, $senha): bool
    {
        $pdo = "SELECT email, senha FROM usuario WHERE email = :email and senha = :senha";
        $estado = BancoDados::getInstance()->getConnection()->prepare($pdo);
        $estado->bindParam(":email", $email);
        $estado->bindParam(":senha", $senha);
        $estado->execute();
        $usuario = $estado->fetch(\PDO::FETCH_ASSOC);
        
        if($usuario){
            return true;
        }
        return false;
    }


    public static function validarCriacao($email): bool
    {
        $pdo = "SELECT COUNT(*) FROM usuario WHERE email = :email";
        $estado = BancoDados::getInstance()->getConnection()->prepare($pdo);
        $estado->bindParam(":email", $email);
        $estado->execute();
        $usuario = $estado->fetchColumn();        
        return !$usuario > 0;
    }


    public static function validarConfirmacaoSenha($senha, $confirmarSenha): bool
    {
        return $senha === $confirmarSenha;
    }
}