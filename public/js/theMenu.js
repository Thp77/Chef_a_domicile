/* on récupère les titres et les div liées sous forme de variable */
/* les titres */

var titreAperitif = document.querySelector('#titre_aperitif');
var titreEntree = document.querySelector('#titre_entree');
var titrePlat = document.querySelector('#titre_plat');
var titreDessert = document.querySelector('#titre_dessert');

/* les arbesques liées */

var arabesqueEntree = document.querySelector('#arabesque_entree');
var arabesquePlat = document.querySelector('#arabesque_plat');
var arabesqueDessert = document.querySelector('#arabesque_dessert');

/* les div */

var divAperitif = document.querySelector('#div_aperitifs');
var divEntree = document.querySelector('#div_entrees');
var divPlat = document.querySelector('#div_plats');
var divDessert = document.querySelector('#div_desserts');

/* On fait disparaitre les div relatives aux titres si le contenu est vide */

if (divAperitif.innerText == "") {
    titreAperitif.classList.add('d-none');
}
if (divEntree.innerText == "") {
    titreEntree.classList.add('d-none');
    arabesqueEntree.classList.add('d-none');
}
if (divPlat.innerText == "") {
    titrePlat.classList.add('d-none');
    arabesquePlat.classList.add('d-none');
}
if (divDessert.innerText == "") {
    titreDessert.classList.add('d-none');
    arabesqueDessert.classList.add('d-none');
}