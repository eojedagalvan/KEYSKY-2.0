const formulario = document.querySelector("#buscar");
const stringFechaDesde = document.querySelector('#fechaInicio');
const stringFechaHasta = document.querySelector('#fechaTermino');

function ValidarFiltroDeFechas() {

    if (stringFechaDesde.value == "") {
        alert("Debe ingresar una fecha de llegada.");
        return false;
    }else if(stringFechaHasta.value == "") {
        alert("Debe ingresar una fecha de salida.");
        return false;
    }else if(stringFechaDesde.value > stringFechaHasta.value) {
        alert("La fecha de salida no puede ser menor a la de llegada");
        return false;
    }
    return true;
}

formulario.addEventListener("submit", function (evento) {
    if(!ValidarFiltroDeFechas()) {
      evento.preventDefault();
      return;
    }

});
