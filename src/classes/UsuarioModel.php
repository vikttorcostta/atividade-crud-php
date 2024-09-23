<?php

namespace UsuarioModel;
use BancoDados\BancoDados;
use Auth\Auth;

use PDO;
class UsuarioModel
{
    private string $nome;
    private string $email;
    private string $telefone;
    private string $cpf;
    private string $senha;
    private PDO $connection;
    private CONST ENTIDADE = 'usuario';

    public function __construct ()
    {
        $this->connection = BancoDados::getInstance()->getConnection();
    }
    public function cadastrar (string $nome, string $email, string $telefone, string $cpf, string $senha): bool
    {
        
        if (!Auth::validarCriacao($email)){
            header('Location: ../index.php');
            exit();
        }
     
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cpf = $cpf;
        $this->senha = $senha;

        $pdo = "INSERT INTO " . self::ENTIDADE. " (nome, email, telefone, cpf, senha) VALUES (:nome, :email, :telefone, :cpf, :senha)";
        $estado = $this->connection->prepare($pdo);
        $estado->bindParam(":nome", $this->nome);
        $estado->bindParam(":email", $this->email);
        $estado->bindParam(":telefone", $this->telefone);
        $estado->bindParam(":cpf", $this->cpf);
        $estado->bindParam(":senha", $this->senha);
        $estado->execute();

        header('Location: ../index.php');
        
        return true;
       
    }

    public static function listar (): array
    {
       $pdo = "SELECT * FROM " . self::ENTIDADE;
       $estado = BancoDados::getInstance()->getConnection()->prepare($pdo);
       $estado->execute();
       return $estado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function editar ($nome, $email, $telefone, $cpf, $id): bool
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->cpf = $cpf;

        try {
            $pdo = "UPDATE " . self::ENTIDADE . " SET nome = :nome, email = :email, telefone = :telefone, cpf = :cpf WHERE usuario_id = :id";
            $estado = $this->connection->prepare($pdo);
            $estado->bindParam(":nome", $this->nome);
            $estado->bindParam(":email", $this->email);
            $estado->bindParam(":telefone", $this->telefone);
            $estado->bindParam(":cpf", $this->cpf);
            $estado->bindParam(":id", $id);
            $estado->execute();
            $estado->fetchAll(PDO::FETCH_ASSOC);
        }catch (\PDOException $e){
            echo "Erro ao editar usuario: " . $e->getMessage();
        }
        return false;
    }

    public function excluir($id): bool {

        if (empty($id) || !is_numeric($id)) {
            error_log("ID inválido: " . var_export($id, true)); // Log para debugar
            return false;
        }

        $pdo = "DELETE FROM " . self::ENTIDADE . " WHERE usuario_id = :id";
        $estado = $this->connection->prepare($pdo);
        $estado->bindParam(":id", $id, PDO::PARAM_INT);
        $estado->execute();

        if ($estado->rowCount() > 0) {
            return true;
        } else {
            error_log("Nenhum usuário encontrado para ID: " . var_export($id, true)); // Log para debugar
            return false;
        }
    }

}