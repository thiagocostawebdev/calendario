<?php
class listaimg{
    function index(){
        $dir = "./img/bootstrap-icons/";
        $this->callhead();
        $this->style();
        // Open a directory, and read its contents
        if (is_dir($dir)){
            if ($dh = opendir($dir)){
                $i = 0;
                while (($file = readdir($dh)) !== false and $i < 10){
                    if ($this->filtratipo($file)){
                        $i++;
                        echo '<div class=divImage>';
                        echo '<div> ./img/bootstrap-icons/'.$file.' </div>';
                        echo '<object type="image/svg+xml" data="./img/bootstrap-icons/'.$file.'"></object>';
                        //echo '<img class="imagem" src="./img/bootstrap-icons/'.$file.'">';
                        echo '</div>';
                    }
                }
                closedir($dh);
            }
        }
    }
    
    function filtratipo($file){
        $pattern = "/.svg/i";
        if (preg_match($pattern, $file)==1){
            return true;
        }else{
            return false;
        }

    }

    function callhead(){
        $head = "<head>
                <base href='http://192.168.19.19/calendario/'>
                <link href='https://fonts.googleapis.com/css?family=Silkscreen' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='icon' href='./img/bootstrap-icons/person-check-fill.svg'>
                <title>Calendario</title>
                <link href='./css/calendario.css' rel='stylesheet'>
            </head>";        
        echo $head;
    }

    function style() {
        ?>
        <style>
            .divImage{
                width: 20vw;
                background-color: #ccc;
                height: 30px;
                margin: 2px 2px;
                align-items: center;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
                float: left;
            }
                .divImage div{
                    float: left;
                }
                .imagem{
                    height: 100%;
                    margin: 10px 10px;
                    float: right;
                }
        </style>
        <?php
    }
}
?>