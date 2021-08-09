const login_form = document.getElementById('form-modificar');
const campos = document.getElementsByClassName('campos');
const boton2 = document.getElementById('modificar');
const confirmar = document.querySelector('#confirmar');
const cancelar = document.getElementById('cancelar');
const error = document.querySelector('.error');
const nombre = document.getElementById('nombre');
const ubicacion = document.getElementById('ubicacion');
const costo = document.getElementById('costo');

window.addEventListener("load", function() {
  nombre.addEventListener("keypress", soloLetras, false);
  ubicacion.addEventListener("keypress", soloLetras, false);
  costo.addEventListener("keypress", soloNumeros, false);
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

boton2.addEventListener("click", function (evento) {
  evento.preventDefault();
  for (i = 0; i < campos.length; i++) {
    if (i == 0){
      continue;
    }
    campos[i].disabled = false;
  }
  boton2.classList.add('hide');
  confirmar.classList.remove('hide');
  cancelar.classList.remove('hide');
});

confirmar.addEventListener("click", function (evento) {
  evento.preventDefault();
  const nombre = document.querySelector("#nombre").value;
  const ubicacion = document.querySelector("#ubicacion").value;
  const costo = document.querySelector("#costo").value;
  const descripcion = document.querySelector("#descripcion").value;

  if (!validarInformacion(nombre, ubicacion, costo, descripcion)) return;

  const formData = new FormData();
  formData.append("nombre", nombre);
  formData.append("ubicacion", ubicacion);
  formData.append("costo", costo);
  formData.append("descripcion", descripcion);

  axios
  .post("../php/actualizarDatosAlojamiento.php", formData)
  .then(function () {
    document.location.href= '../php/misAlojamientos.php';
    alert("Datos guardados correctamente");
  })
  .catch(function () {
    error.classList.remove("hide");
    error.innerText = "Error al guardar datos";
  });
});

function validarInformacion(nombre, ubicacion, costo, descripcion) {

  if (nombre === "" || ubicacion === "" || costo === "" || descripcion === "") {
      error.classList.remove("hide");
      error.innerText = "Todos los campos son obligatorios";
      return false;
    } else if (nombre.length > 50) {
      loginError.classList.remove("hide");
      loginError.innerText = "El nombre es muy largo";
      return false;
    } else if (ubicacion.length > 50) {
      loginError.classList.remove("hide");
      loginError.innerText = "La ubicación es muy larga";
      return false;
    } else if (costo < 300 || costo > 500000 ) {
      loginError.classList.remove("hide");
      loginError.innerText = "El costo mínimo válido es de $300 y el máximo de $500,000";
      return false;
    } else if (descripcion.length > 1000) {
      loginError.classList.remove("hide");
      loginError.innerText = "La descripción es demasiado larga";
      return false;
    }
  return true;
}
