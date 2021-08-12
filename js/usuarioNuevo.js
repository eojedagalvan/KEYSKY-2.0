const loginForm = document.querySelector("#uno");
const loginError = document.querySelector(".login-error");
const validarTelefono = document.querySelector("#telefono");
const validarNombre = document.querySelector("#nom");
const validarApellido = document.querySelector("#ape");

window.addEventListener("load", function() {
validarTelefono.addEventListener("keypress", soloNumeros, false);
validarNombre.addEventListener("keypress", soloLetras, false);
validarApellido.addEventListener("keypress", soloLetras, false);
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
  const apellido = document.querySelector("#ape").value;
  const telefono = document.querySelector("#telefono").value;
  const correo = document.querySelector("#correo").value;
  const contra = document.querySelector("#contra").value;
  const contra2 = document.querySelector("#contra2").value;

  if (!validarUsuarioExistente(nombre, apellido, telefono, correo, contra, contra2)) return;

  const formData = new FormData();
  formData.append("nombre", nombre);
  formData.append("apellido", apellido);
  formData.append("telefono", telefono);
  formData.append("correo", correo);
  formData.append("contra", contra);

  axios
    .post("../php/validarUsuarioNuevo.php", formData)
    .then(function (respuesta) {
      // alert(respuesta.data);
      document.location.href= '../php/enviarCorreo.php';
      document.location.href= '../php/inicio.php';
    })
    .catch(function () {
      loginError.classList.remove("hide");
      loginError.innerText = "El usuario ya existe";
    });
});

function validarUsuarioExistente(nombre, apellido, telefono, correo, contra, contra2) {
  var expresion;
  expresion = /\w+@\w+\.+[a-z]/;

  if (nombre === "" || apellido === "" || telefono === "" || correo === "" || contra === "" || contra2 === "") {
    loginError.classList.remove("hide");
    loginError.innerText = "Todos los campos son obligatorios";
    return false;
  } else if (nombre.length > 50) {
    loginError.classList.remove("hide");
    loginError.innerText = "El nombre es muy largo";
    return false;
  } else if (apellido.length > 50) {
    loginError.classList.remove("hide");
    loginError.innerText = "El apellido es muy largo";
    return false;
  } else if (telefono.length > 20) {
    loginError.classList.remove("hide");
    loginError.innerText = "El telefono no es válido";
    return false;
  } else if (!expresion.test(correo)) {
    loginError.classList.remove("hide");
    loginError.innerText = "El correo no es válido";
    return false;
  } else if (contra.length < 8 || contra.length > 16) {
    loginError.classList.remove("hide");
    loginError.innerText = "La contraseña debe de ser entre 8 - 16 caracteres";
    return false;
  } else if (contra2 != contra) {
    loginError.classList.remove("hide");
    loginError.innerText = "Las contraseñas no coinciden";
    return false;
  }
  return true;
}
