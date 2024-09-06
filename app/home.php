<?php
class home{
    function callhead(){
        $head = "<head>
                <base href='http://192.168.19.19/calendario/'>
                <link href='https://fonts.googleapis.com/css?family=Silkscreen' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css?family=Audiowide' rel='stylesheet'>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='icon' href='./img/bootstrap-icons/calendar-date-fill.svg'>
                <title>Calendario</title>
                <link href='./css/calendario.css' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css?family=Tac One' rel='stylesheet'>
                </head>";        
        echo $head;
    }

    function geraDias($mes,$ano){
        $dias;
        $i = 0;
        $totalDays = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);
        $firstDay = date("N", strtotime($ano . '-' . $mes . '-01'));
        for ($i ;$i < $firstDay; ) {
            $dias[$i]=0;
            $i++;
            }
            if($i==7){
                $i = 0;
            }
        for ($day = 1; $day <= $totalDays; $day++) {
                $dias[$i]= $day;
                $i++;
        }
        echo json_encode($dias);
    }

    function index(){
        $this->callhead();
        ?>
        <div class = "topo" >Calendario</div>
        
        <div class = "calendar">
            <div class="header">
                <img src="./img/bootstrap-icons/arrow-left-square-fill.svg" onclick="carregaDias(-1)">
                <div id = "mes">Gerado por JS</div>
                <img src="./img/bootstrap-icons/arrow-right-square-fill.svg" onclick="carregaDias(1)">
            </div>
            <div class="days">
            <div class="day">Domingo</div>
            <div class="day">Segunda</div>
            <div class="day">Terça</div>
            <div class="day">Quarta</div>
            <div class="day">Quinta</div>
            <div class="day">Sexta</div>
            <div class="day">Sabado</div>
            </div>
            <div class="dates" id="dates"></div>
        </div>
        <div class = "eventos">
            <div class="headerEvents">Lista de Eventos <input id='inputText' type="text" name="evento"> <img src="./img/bootstrap-icons/calendar-plus.svg" onclick="addEnventos()"></div>
            <div class = "blocoEventos" id="blocoEventos"></div>
        </div>
        <script src="./js/calendario.js"></script><?php
    }
}
?>