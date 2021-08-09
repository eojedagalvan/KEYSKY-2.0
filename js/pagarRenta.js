const nombre = document.querySelector('#nombre');
const apellido = document.querySelector('#apellido');
const correo = document.querySelector('#correo');
const numTarjeta = document.querySelector('#numTarjeta');
const ccv = document.querySelector('#ccv');
const expiracion = document.querySelector('#expiracion');

window.addEventListener("load", function() {
nombre.addEventListener("keypress", soloLetras, false);
apellido.addEventListener("keypress", soloLetras, false);
numTarjeta.addEventListener("keypress", soloNumeros, false);
ccv.addEventListener("keypress", soloNumeros, false);
});

//Solo permite introducir numeros.
function soloNumeros(e){
var key = window.event ? e.which : e.keyCode;
if (key < 48 || key > 57) {
  e.preventDefault();
}
}

function soloLetras(e){
var key = window.event ? e.which : e.keyCode;
if (!(key < 48 || key > 57)) {
  e.preventDefault();
}
}
