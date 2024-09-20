<?php

namespace BancoDados;
use PDO;
use PDOException;
class BancoDados {

    private string $host = "localhost";
    private string $dbname = "crudloginphp";
    private string $username = "root";
    private string $password = "";

    private static ?self $instance = null;
    private PDO $connection;

    public function __construct ()
    {
        try {
            $dsnMySQL = "mysql:host=$this->host;dbname=$this->dbname";
            $this->connection = new PDO($dsnMySQL, $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //echo "Conectado com sucesso!";
        }catch (PDOException $e){
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
        }
    }


    public static function getInstance(): BancoDados
    {
        if (self::$instance == null){
            self::$instance = new BancoDados();
        }
        return self::$instance;
    }

    public function getConnection (): PDO
    {
        return $this->connection;
    }

    private function __clone (): void
    {

    }


}