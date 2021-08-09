const loginForm = document.querySelector("#login-form");
const loginError = document.querySelector(".login-error");

loginForm.addEventListener("submit", function (evento) {
  evento.preventDefault();
  const correo = document.querySelector("#correo").value;
  const clave = document.querySelector("#clave").value;

  if (!validarUsuarioExistente(correo, clave)) return;

  const formData = new FormData();
  formData.append("correo", correo);
  formData.append("clave", clave);

  axios
    .post("php/validarUsuario.php", formData)
    .then(function (respuesta) {
      // alert(respuesta.data);
      document.location.href= '../php/inicio.php';
    })
    .catch(function () {
      loginError.classList.remove("hide");
      loginForm.classList.add("login-box-error");
      loginError.innerText = "Usuario o contraseña incorrectos";
    });
});

function validarUsuarioExistente(correo, clave) {
  var expresion;
  expresion = /\w+@\w+\.+[a-z]/;

  if (correo === "" || clave === "") {
    loginError.classList.remove("hide");
    loginError.innerText = "Todos los campos son obligatorios";
    return false;
  } else if (correo.length > 50) {
    loginError.classList.remove("hide");
    loginError.innerText = "El correo es muy largo";
    return false;
  } else if (!expresion.test(correo)) {
    loginError.classList.remove("hide");
    loginError.innerText = "El correo no es válido";
    return false;
  } else if (clave.length < 8 || clave.length > 16) {
    loginError.classList.remove("hide");
    loginError.innerText = "La contraseña debe de ser entre 8 - 16 caracteres";
    return false;
  }
  return true;
}

function denegarUsuario() {
  alert("Usuario no registrado");
}
