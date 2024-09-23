<?php

include_once __DIR__ . '/classes/UsuarioModel.php';
use UsuarioModel\UsuarioModel;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $dados = json_decode(file_get_contents('system.php'), true);
    var_dump($dados);

    $usuarioID = $dados['usuario_id'];
    $usuario = new UsuarioModel();
    $usuario->excluir($usuarioID);
    echo json_encode(['success' => true]);

}
