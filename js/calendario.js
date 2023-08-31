var datas = document.getElementById("dates");
var exibeMes = document.getElementById("mes");
var meses = ["Janeiro", "Fevereiro", "Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"];
var text = "";
var dias = [0,0,0,0,0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30]
const d = new Date();
var ano = d.getFullYear();
var texmes = d.getMonth();

function geracalendario(mes){
    exibeMes.innerHTML = `${meses[texmes]} ${ano}`;
    for (x in mes) {
        if (parseInt(mes[x])==0){
            text +=`<div class = 'date'"></div>`;
        }else{
            text +=`<div class = 'date'">${mes[x]}</div>`;
        }
    }
    datas.innerHTML = text; 
}

geracalendario(dias);