<?php
class remeventos{

function index(){
    require_once "../calendario/app/database.php";
    $db = new Database;
    $err = false;

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        if($_POST["id"]!=""){$id = $this->test_input($_POST["id"]);}else{$err=true;}

        if($err==false){
            $db->query("DELETE FROM `eventos` WHERE id = :id");
            $db->bind(":id",$id);
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