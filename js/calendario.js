var datas = document.getElementById("dates");
var blocoEventos = document.getElementById("blocoEventos");
var exibeMes = document.getElementById("mes");
var inputText = document.getElementById("inputText");;
var meses = ["Janeiro", "Fevereiro", "Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
const d = new Date();
var anoExibido = d.getFullYear();
var mesExibido = d.getMonth()+1;
var diaAtual = d.getDate();
var listaEventos = [];
var diaSelecionado = [anoExibido,mesExibido,0];

function geracalendario(mes){
    var text = "";
    exibeMes.innerHTML = `${meses[mesExibido-1]} ${anoExibido}`;
    for (x in mes) {
        var data_x= converteData([anoExibido,mesExibido,mes[x]]);
        if (parseInt(mes[x])==0){
            text +=`<div class = 'date'"></div>`;
        }else{
            if (mes[x]==diaAtual && mesExibido == d.getMonth()+1 && anoExibido == d.getFullYear() ){
                text +=`<div class = 'date' id = 'day${data_x}' onclick='selecionaDia(${mes[x]})' style='border: 1px solid blue;'">${mes[x]}</div>`;
            }else{
                text +=`<div class = 'date' id = 'day${data_x}' onclick='selecionaDia(${mes[x]})' ">${mes[x]}</div>`;
            }
        }
    }
    datas.innerHTML = text; 
}

function addEnventos(){
    var saida = converteData(diaSelecionado);
    listaEventos.push({dataInicio: saida,detalhe:inputText.value});
    salvaEventos(inputText.value);
    listarEventos();
}

function delEventos(a,alvo){
    listaEventos.splice(a,1);
    removeEventos(alvo);
    listarEventos();
}

function selecionaDia(dia){
    var data_x = converteData([anoExibido,mesExibido,diaSelecionado[2]]);
    if (diaSelecionado[2]!=0){
        document.getElementById(`day${data_x}`).style.backgroundColor = "";
    }
    diaSelecionado[2] = dia;
    data_x = converteData([anoExibido,mesExibido,dia]);
    document.getElementById(`day${data_x}`).style.backgroundColor = "#ccc";
    carregaEventos(converteData(diaSelecionado));
}

function listarEventos(){
    var dataPadrao;
    var dia_evento = null;
    var saida = "";
    for (eventos in listaEventos){
        dataPadrao = listaEventos[eventos]["dataInicio"].slice(6,8)+"-"+listaEventos[eventos]["dataInicio"].slice(4,6)+"-"+listaEventos[eventos]["dataInicio"].slice(0,4);
        saida += `<div class="evento" id="evento${eventos}">${dataPadrao} ${listaEventos[eventos]["detalhe"]}<img src="./img/bootstrap-icons/trash-fill.svg" onclick="delEventos(${eventos},${listaEventos[eventos]["id"]})"></div>`;
        var dia_evento = document.getElementById(`day${listaEventos[eventos]["dataInicio"]}`);
        if (dia_evento != null){
            dia_evento.style.color = "red";
        }
    }
    blocoEventos.innerHTML = saida;
}

function carregaEventos(dia){
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var saida = [];
        saida = JSON.parse(xhttp.responseText);
        listaEventos = saida;
        listarEventos();
    }
    xhttp.open("GET", `http://localhost/calendario/listareventos/listareventos/${dia}`, true);
    xhttp.send();
}

function carregaDias(mod){
    mesExibido = mesExibido + mod;
    if (mesExibido == 13){
        mesExibido = 1;
        anoExibido = anoExibido + 1;
    }
    if (mesExibido == 0){
        mesExibido = 12;
        anoExibido = anoExibido - 1;
    }
    diaSelecionado = [anoExibido,mesExibido,0];
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var saida = JSON.parse(xhttp.responseText);
        geracalendario(saida);
        carregaEventos(converteData(diaSelecionado));
    }
    xhttp.open("GET", `http://localhost/calendario/home/geraDias/${mesExibido}/${anoExibido}`, true);
    xhttp.send();
} 

function converteData(data){
    var saida = data[0]+"";
    for (i = 1;i<3;i++){
        if (data[i]<10){
            saida += "0"+data[i];
        }else{
            saida += data[i];
        }
    }
    return saida;
}

function salvaEventos(text){
    if (text!=""){
    var data = new FormData();
    data.append('data', converteData(diaSelecionado));
    data.append('evento', text);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'http://localhost/calendario/salvaeventos/', true);
    xhr.onload = function () {
        console.log(this.responseText);
    };
    xhr.send(data);
    }
}

function removeEventos(text){
    if (text!=""){
        var data = new FormData();
        data.append('id', text);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'http://localhost/calendario/remeventos/', true);
        xhr.onload = function () {
            console.log(this.responseText);
        };
        xhr.send(data);
        }
}

carregaDias(0);