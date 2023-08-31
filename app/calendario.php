<?php
class calendario{

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

    function geracelndario($mes,$ano){
        $nomeMes=array("Janeiro", "Fevereiro", "Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");
        ?>
        <div class="calendar">
            <div class="header"><?php echo $nomeMes[$mes-1]." $ano"; ?></div>
            <div class="days">
            <div class="day">S</div>
            <div class="day">M</div>
            <div class="day">T</div>
            <div class="day">W</div>
            <div class="day">T</div>
            <div class="day">F</div>
            <div class="day">S</div>
        </div>
        <div class="dates">
            <?php
                

                // Get the current month and year

                // Get the total number of days in the current month
                $totalDays = cal_days_in_month(CAL_GREGORIAN, $mes, $ano);

                // Get the first day of the month
                $firstDay = date("N", strtotime($ano . '-' . $mes . '-01'));

                // Display empty cells for the days before the first day of the month
                for ($i = 1; $i < $firstDay; $i++) {
                echo '<div class="date"></div>';
                }

                // Display the calendar dates
                for ($day = 1; $day <= $totalDays; $day++) {
                echo '<div class="date">' . $day . '</div>';
                }
            ?>
            </div>
        </div>
        <?php
        
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
                <img src="./img/bootstrap-icons/arrow-left-square-fill.svg">
                <div id = "mes">Gerado por JS</div>
                <img src="./img/bootstrap-icons/arrow-right-square-fill.svg">
            </div>
            <div class="days">
            <div class="day">S</div>
            <div class="day">M</div>
            <div class="day">T</div>
            <div class="day">W</div>
            <div class="day">T</div>
            <div class="day">F</div>
            <div class="day">S</div>
            </div>
            <div class="dates" id="dates"></div>
        </div>
        <div class = "eventos">
            <div>Lista de Eventos</div>
        </div>
        <script src="./js/calendario.js"></script><?php
        //$this->geracelndario(9,2023);
    }
}
?>