<?php

include_once __DIR__ . '/classes/UsuarioModel.php';
use UsuarioModel\UsuarioModel;

if (isset($_POST['usuario_id'])) {
    $usuario = new UsuarioModel();
    $usuarioID = $_POST['usuario_id'];

    if ($usuario->excluir($usuarioID)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Erro ao deletar usuário.']);
    }
    exit();
}
