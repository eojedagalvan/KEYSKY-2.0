const boton = document.querySelector("#eliminar");
const id = document.querySelector("#id").value;

boton.addEventListener("click", function (evento) {
  evento.preventDefault();
  var opcion = confirm("¿Seguro que quieres eliminar este alojamiento?");
  if (opcion == true){
    const formData = new FormData();
    formData.append("id", id);

  axios
    .post("../php/eliminarAlojamiento.php", formData)
    .then(function (evento) {
      document.location.href = "../php/misAlojamientos.php";
    })
    .catch(function () {
      alert("Error al eliminar el alojamiento");
    })
  }
});
