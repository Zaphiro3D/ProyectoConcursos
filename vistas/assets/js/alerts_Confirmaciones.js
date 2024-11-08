$(document).on("click", ".btnEliminarAgente", function () {
   
  let id_agente = $(this).attr("id_Agente"); 
  let apellido = $(this).attr("apellido"); 
  let nombre = $(this).attr("nombre"); 

  Swal.fire({
    title: "¿Está seguro de eliminar el agente: " + apellido + ", " + nombre + "?",
    text: "Si no lo está, puede cancelar la acción",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, eliminar agente",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?pagina=agentes&id_Agente_Eliminar=" + id_agente;
    }
  });
});

$(document).on("click", ".btnGuardar", function (e) {
  e.preventDefault(); // Previene el envío automático del formulario

  Swal.fire({
      title: "¿Está seguro que desea guardar?",
      text: "Confirme si desea guardar los cambios.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Sí, guardar",
  }).then(function (result) {
      if (result.isConfirmed) {
          // Enviar el formulario manualmente si se confirma
          $("form").submit();
      }
  });
});

$(document).on("click", ".btnVolver", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "¿Está seguro que desea salir sin guardar?",
      text: "Confirme si desea salir sin guardar los cambios.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Sí, salir",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "index.php?pagina=" + pag;
      }
  });
});