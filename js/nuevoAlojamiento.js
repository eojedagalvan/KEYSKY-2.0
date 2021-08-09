const loginForm = document.querySelector("#uno");
const loginError = document.querySelector(".login-error");
const validarNombre = document.querySelector("#nom");
const validarUbicacion = document.querySelector("#ubicacion");
const validarDescripcion = document.querySelector("#descripcion");
const validarCosto = document.querySelector("#costo");

window.addEventListener("load", function() {
validarNombre.addEventListener("keypress", soloLetras, false);
validarUbicacion.addEventListener("keypress", soloLetras, false);
validarCosto.addEventListener("keypress", soloNumeros, false);
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
loginForm.addEventListener("submit", function (evento) {
  evento.preventDefault();
  const nombre = document.querySelector("#nom").value;
  const ubicacion = document.querySelector("#ubicacion").value;
  const costo = parseFloat(document.querySelector("#costo").value);
  const descripcion = document.querySelector("#descripcion").value;
  const fotos = document.querySelector("#fot").files;

  if (!validarAlojamientoExistente(nombre, ubicacion, costo, descripcion, fotos)) return;

  const formData = new FormData();
  formData.append("nombre", nombre);
  formData.append("ubicacion", ubicacion);
  formData.append("costo", costo);
  formData.append("descripcion", descripcion);
  formData.append("fotos0", fotos[0]);
  formData.append("fotos1", fotos[1]);
  formData.append("fotos2", fotos[2]);
  formData.append("fotos3", fotos[3]);
  formData.append("fotos4", fotos[4]);
  formData.append("fotos5", fotos[5]);

  axios
    .post("../php/validarNuevoAlojamiento.php", formData)
    .then(function (respuesta) {
      document.location.href= '../php/misAlojamientos.php';
    })
    .catch(function () {
      loginError.classList.remove("hide");
      loginError.innerText = "Error al guardar los datos";
    });
});

function validarAlojamientoExistente(nombre, ubicacion, costo, descripcion, fotos) {

  if (nombre === "" || ubicacion === "" || costo === "" || descripcion === "" || fotos === "" ) {
    loginError.classList.remove("hide");
    loginError.innerText = "Todos los campos son obligatorios";
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
  } else if (fotos.length != 6 ) {
    loginError.classList.remove("hide");
    loginError.innerText = "Es necesario subir 6 imágenes";
    return false;
  } else if (fotos.length == 6 ) {
      for (var i = 0; i < fotos.length; i++) {
        if (fotos[i].type != "image/png" && fotos[i].type != "image/jpg" && fotos[i].type != "image/jpeg") {
          loginError.classList.remove("hide");
          loginError.innerText = "El tipo de archivo no está permitido";
          return false;
        } else {
          loginError.classList.remove("hide");
          loginError.innerText = "Imágenes cargadas correctamente";
          return true;
        }
      }
  }
  return true;
}
