<?php

class Database {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $stmt;
    private $conn;
    
    public function __construct(){
        echo "<script>console.log('Classe Carregada');</script>";
        try {
            $this->conn = new PDO("mysql:host=".$this->servername.";dbname=portfolio", $this->username, $this->password);
          // set the PDO error mode to exception
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            echo "<script>console.log('Connection Sucessfull');</script>";
        } catch(PDOException $e){
            //echo "Connection failed: " . $e->getMessage();
            echo "<script>console.log('Connection Failed');</script>";
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
        $this.executa();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function resultados(){
        $this.executa();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function totalResultados(){
        return $this->stmt->rowCount();
    }

    public function ultimoIdInserido(){
        return $this->conn->lastInsertId();
    }

}

?> 