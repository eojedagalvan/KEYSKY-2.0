const login_form = document.getElementById('form-modificar');
const campos = document.getElementsByClassName('campo');
const boton = document.getElementById('modificar');
const confirmar = document.querySelector('#confirmar');
const error = document.querySelector('.error');
const tel = document.getElementById('tel');
const nombre = document.getElementById('nombre');
const apellido = document.getElementById('apellido');
const cancelar = document.getElementById('cancelar');
const camara = document.getElementById('camara');

window.addEventListener("load", function() {
  tel.addEventListener("keypress", soloNumeros, false);
  nombre.addEventListener("keypress", soloLetras, false);
  apellido.addEventListener("keypress", soloLetras, false);
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

boton.addEventListener("click", function (evento) {
  evento.preventDefault();
  for (i = 0; i < campos.length; i++) {
    if (i == 2 || i == 3){
      continue;
    }
    campos[i].disabled = false;
  }
  boton.classList.add('hide');
  confirmar.classList.remove('hide');
  cancelar.classList.remove('hide');
  camara.classList.remove('hide');
});

confirmar.addEventListener("click", function (evento) {
  evento.preventDefault();
  const nombre = document.querySelector("#nombre").value;
  const apellido = document.querySelector("#apellido").value;
  const correo = document.querySelector("#correo").value;
  /* const clave = document.querySelector("#clave").value; */
  const tel = document.querySelector("#tel").value;
  const foto = document.querySelector("#fot").files;

  /* if (!validarInformacion(nombre, apellido, correo, clave, tel, foto)) return; */
  if (!validarInformacion(nombre, apellido, correo, tel, foto)) return;

  const formData = new FormData();
  formData.append("correo", correo);
  /* formData.append("clave", clave); */
  formData.append("nombre", nombre);
  formData.append("apellido", apellido);
  formData.append("tel", tel);
  formData.append("foto", foto[0]);

  axios
  .post("../php/actualizarDatosPerfil.php", formData)
  .then(function (data){
    document.location.href= '../php/miPerfil.php';
  })
  .catch(function () {
    error.classList.remove("hide");
    error.innerText = "Usuario o contraseña incorrectos";
  });
});

/* function validarInformacion(nombre, apellido, correo, clave, tel, foto) { */
function validarInformacion(nombre, apellido, correo, tel, foto) {
  var expresion;
  expresion = /\w+@\w+\.+[a-z]/;

  if (correo === "" || clave === "" || nombre === "" || apellido === "" || tel === "") {
      error.classList.remove("hide");
      error.innerText = "Todos los campos son obligatorios";
      return false;
  } else if (correo.length > 50) {
      error.classList.remove("hide");
      error.innerText = "El correo es muy largo";
      return false;
  } else if (!expresion.test(correo)) {
      error.classList.remove("hide");
      error.innerText = "El correo no es válido";
      return false;
  } /* else if (clave.length < 8 || clave.length > 16) {
      error.classList.remove("hide");
      error.innerText = "La contraseña debe de ser entre 8 - 16 caracteres";
      return false;
  } */ else if (foto.length > 1 ) {
      error.classList.remove("hide");
      error.innerText = "Solo puedes subir una imagen";
    return false;
  } else if (foto.length == 1 ) {
    if (foto[0].type != "image/png" && foto[0].type != "image/JPG" && foto[0].type != "image/jpg" && foto[0].type != "image/jpeg") {
      error.classList.remove("hide");
      error.innerText = "El tipo de archivo no está permitido";
      return false;
    } else {
      error.classList.remove("hide");
      error.innerText = "Imagen cargada correctamente";
      return true;
    }
}
  return true;
}

var inputElement = document.getElementById('fot');
inputElement.addEventListener("change", handleFiles, false);
const preview = document.getElementById('imagenDefault');

function handleFiles() {
  var fileList = this.files;
  file = fileList[0];
  const reader = new FileReader();

  reader.addEventListener("load", function () {
    // convert image file to base64 string
    preview.src = reader.result;
  }, false);

  if (file) {
    reader.readAsDataURL(file);
    var fileToLoad = file;
    var fileReader = new FileReader();
    fileReader.onload = function(fileLoadedEvent) {
      var srcData = fileLoadedEvent.target.result; // <--- data: base64
      var newImage = document.createElement('img');
      newImage.src = srcData;
      var cssBG =  "url('"+srcData+"')";

    }
    fileReader.readAsDataURL(fileToLoad);
  }
}
