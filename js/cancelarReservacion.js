const boton = document.querySelector(".submit");
const llegada = document.querySelector("#llegada").value;
const id = document.querySelector("#Id_Alojamiento").value;

boton.addEventListener("click", function (evento) {
  evento.preventDefault();
  var opcion = confirm("¿Seguro que quieres cancelar esta reservación?");
  if (opcion == true){
    const formData = new FormData();
    formData.append("Id_Alojamiento", id);
    formData.append("Llegada", llegada);

    axios
    .post("../php/eliminarRenta.php", formData)
    .then(function () {
      document.location.href= '../php/misReservaciones.php';
    })
    .catch(function () {
      alert("Error al eliminar la reservación");
    })
  }
});
