<?php
class salvaeventos{

    function index(){
        require_once "../calendario/app/database.php";
        $db = new Database;
        $err = false;

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if($_POST["data"]!=""){$data = $this->test_input($_POST["data"]);}else{$err=true;}
            if($_POST["evento"]!=""){$evento = $this->test_input($_POST["evento"]);}else{$err=true;}

            if($err==false){
                $db->query("INSERT INTO eventos (dataInicio,detalhe) VALUES (:dataInicio,:detalhe)");
                $db->bind(":dataInicio",$data);
                $db->bind(":detalhe",$evento);
                $db->executa();
                echo "Sucesso";
            }else{
                echo "Erro";
            }
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

}
?>