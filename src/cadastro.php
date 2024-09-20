<?php

include_once __DIR__ . '/classes/Auth.php';
include_once __DIR__ . '/classes/UsuarioModel.php';

use UsuarioModel\UsuarioModel;
use Auth\Auth;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $cpf = $_POST ['cpf'];
    $senha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmarSenha'];
    
    $usuario = new UsuarioModel();
    $usuario->cadastrar($nome, $email, $telefone, $cpf, $senha);
}
