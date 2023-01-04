window.onload=functon(){
    var valeur=3.99
    const btn = document.getElementById('express');
    btn.onclick = function(){
        valeur = 9.99;
    }
    var valeur2 = 50;
    var prixht = valeur+valeur2
    var prixtotal = prixht*1.2
    prixtotal = Math.round(prixtotal*100)/100;
}