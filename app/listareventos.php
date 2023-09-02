<?php

class listareventos{

    function index(){

    }
    
    function listareventos($date){
        
        $listaeventos = [];
        require_once "../calendario/app/database.php";
        $db = new Database;
        if((int)$date%100==0){
            $db->query("SELECT id,data,evento FROM `eventos` WHERE data > $date and data < $date+32");
        }else{
            $db->query("SELECT id,data,evento FROM `eventos` WHERE data = $date");
        }
        
        $db->executa();
        $totalPerguntas=$db->totalResultados();
        $resultado = [];
        
        if ($db->totalResultados() > 0) {
            for($x = 0; $x < $totalPerguntas; $x++){
                $resultado[$x] = $db->resultado();
                array_push($listaeventos,$resultado[$x]);
            }
        } else {
        }
        $saida = json_encode($listaeventos);
        echo $saida;
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
}
?>