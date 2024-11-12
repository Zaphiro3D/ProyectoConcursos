$(document).on("click", ".btnEliminarAgente", function () {
  let id_agente = $(this).attr("id_Agente");
  let nombre_completo = $(this).attr("nombre_completo");

  Swal.fire({
    title: "¿Está seguro de eliminar el agente?",
    text: nombre_completo,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, eliminar",
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
        window.location = 'index.php?pagina='+pag;
      }
  });
});

$(document).on("click", ".btnPermisos", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Error",
      text: "Permisos Insuficientes.",
      icon: "error",
      showCancelButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "index.php?pagina=login";
      }
  });
});

$(document).on("click", ".btnAprobarSolicSuperv", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Solicitud Aprobada",
      text: "La solicitud ha sido aprobada. Se enviará al administrativo.",
      icon: "success",
      showCancelButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "index.php?pagina=solicitudesSuplente";
      }
  });
});

$(document).on("click", ".btnAprobarSolic", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Solicitud Aprobada",
      text: "La solicitud ha sido aprobada. Se agregará al listado de cargos a concursar.",
      icon: "success",
      showCancelButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "index.php?pagina=solicitudesSuplente";
      }
  });
});


$(document).on("click", ".btnEnviarSolic", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Solicitud Enviada",
      text: "La solicitud ha sido enviada a la Supervisión correspondiente.",
      icon: "success",
      showCancelButton: false,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "index.php?pagina=solicitudesSuplente";
      }
  });
});

$(document).on("click", ".btnEliminarZona", function () {
   
  let id_agente = $(this).attr("id_Agente"); 
  let apellido = $(this).attr("apellido"); 
  let nombre = $(this).attr("nombre"); 

  Swal.fire({
    title: "¿Está seguro de eliminar la zona de supervisión?",
    text: "Supervisión Escolar de Zona E",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?pagina=zonasSupervision";
    }
  });
});

$(document).on("click", ".btnEliminar", function () {
   
  let id_agente = $(this).attr("id_Agente"); 
  let apellido = $(this).attr("apellido"); 
  let nombre = $(this).attr("nombre"); 

  Swal.fire({
    title: "¿Está seguro de eliminar el cargo?",
    text: "Plaza: 324567",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?pagina=cargos";
    }
  });
});

$(document).on("click", ".btnEliminarInst", function () {
   
  let id_institucion = $(this).attr("id_Institucion"); 
  let institucion = $(this).attr("institucion"); 

  Swal.fire({
    title: "¿Está seguro de eliminar la institución?",
    text: institucion,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "index.php?pagina=instituciones&id_Institucion_Eliminar=" + id_institucion;
    }
  });
});