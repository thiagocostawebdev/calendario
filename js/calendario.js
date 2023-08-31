var datas = document.getElementById("dates");
var divEventos = document.getElementById("listaEventos");
var exibeMes = document.getElementById("mes");
var meses = ["Janeiro", "Fevereiro", "Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
var dias = [0,0,0,0,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]
const d = new Date();
var anoExibido = d.getFullYear();
var mesExibido = d.getMonth()+1;
var listaEventos = [];

function geracalendario(mes){
    var text = "";
    exibeMes.innerHTML = `${meses[mesExibido-1]} ${anoExibido}`;
    for (x in mes) {
        if (parseInt(mes[x])==0){
            text +=`<div class = 'date'"></div>`;
        }else{
            text +=`<div class = 'date' onclick='listarEventos(${mes[x]})' ">${mes[x]}</div>`;
        }
    }
    datas.innerHTML = text; 
}

function listarEventos(a){
    listaEventos.push(a);
    divEventos.innerHTML = listaEventos.toString();
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
    const xhttp = new XMLHttpRequest();
    xhttp.onload = function() {
        var saida = JSON.parse(xhttp.responseText);
        geracalendario(saida);
      }
    xhttp.open("GET", `http://localhost/calendario/calendario/geraDias/${mesExibido}/${anoExibido}`, true);
    xhttp.send();
} 

geracalendario(dias);