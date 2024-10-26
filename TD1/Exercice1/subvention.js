

function modifCoul(){
    var coul=document.forms["form"].favcolor.value;
    alert(coul);
    document.body.style.backgroundColor=coul;
}

function affiche()
{


var nbMbr = document.forms["form"].nombreMbr.value;
var prix = document.forms["form"].prix.value;
var max = nbMbr*100;    
document.forms["form"].ttc.value = max;




if(prix > max)
alert("Les subventions accordées dépendent du nombre de membres de l'association, vous ne pouvez pas demandez une subvention supérieure à :" + nbMbr*100+" Euros");

}

