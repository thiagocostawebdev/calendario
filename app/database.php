<?php

class Database {
    private $servername = "127.0.0.1";
    private $username = "calendario";
    private $password = "calendario-01";
    private $stmt;
    private $conn;
    
    public function __construct(){
        try {
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=calendario", $this->username, $this->password);
          // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            //echo "Connection failed: " . $e->getMessage();
        }
    }

    //Prepara o stmt com a query.
    public function query($sql){
        $this->stmt = $this->conn->prepare($sql);
    }
    
    //Vincula um valor ao parâmetro.
    public function bind($parametro,$valor,$tipo = null){
        if(is_null($tipo)):
            switch(true):
                case is_int($valor):
                    $tipo = PDO::PARAM_INT;
                break;
                case is_bool($valor):
                    $tipo = PDO::PARAM_BOOL;
                break;
                case is_null($valor):
                    $tipo = PDO::PARAM_NULL;
                break;
                default:
                    $tipo = PDO::PARAM_STR;
            endswitch;
        endif;
        $this->stmt->bindvalue($parametro,$valor,$tipo);

    }

    public function executa(){
        return $this->stmt->execute();
    }

    public function resultado(){
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function resultados(){
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalResultados(){
        return $this->stmt->rowCount();
    }

    public function ultimoIdInserido(){
        return $this->conn->lastInsertId();
    }

}

?> 