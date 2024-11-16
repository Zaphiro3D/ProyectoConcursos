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
      window.location = id_agente;
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
        window.location = pag;
      }
  });
});

$(document).on("click", ".btnPermisos", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Error",
      text: "Permisos Insuficientes.",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location = "login";
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
        "solicitudesSuplente";
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
        "solicitudesSuplente";
      }
  });
});

$(document).on("click", ".btnYaConcursado", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Solicitud Ya Concursada",
      text: "La solicitud ha sido marcada como ya concursada.",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "solicitudesSuplente";
      }
  });
});

$(document).on("click", ".btnRechazarSolicSuperv", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Solicitud Rechazada",
      text: "La solicitud ha sido rechazada. Se enviará a la escuela para su corrección.",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "solicitudesSuplente";
      }
  });
});

$(document).on("click", ".btnRechazarSolic", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "Solicitud Rechazada",
      text: "La solicitud ha sido rechazada. Se enviará a la supervisión para su corrección.",
      icon: "error",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "solicitudesSuplente";
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
        "solicitudesSuplente";
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
        "zonasSupervision";
    }
  });
});

$(document).on("click", ".btnEliminarCargo", function () {
   
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
        "cargos";
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
        "instituciones&id_Institucion_Eliminar=" + id_institucion;
    }
  });
});

$(document).on("click", ".btnEliminarSolic", function () {
   
  let id_institucion = $(this).attr("id_Institucion"); 
  let institucion = $(this).attr("institucion"); 

  Swal.fire({
    title: "¿Está seguro de eliminar la solicitud de suplente?",
    text: "Maestro de Educación Física - Perez, Lucas (21245465)",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, eliminar",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "solicitudesSuplente";
    }
  });
});

$(document).on("click", ".btnConfRechazoSolic", function () {
   
  let id_institucion = $(this).attr("id_Institucion"); 
  let institucion = $(this).attr("institucion"); 

  Swal.fire({
    title: "¿Está seguro de rechazar la solicitud?",
    text: "Será devuelta para su corrección",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Sí, rechazar",
  }).then(function (result) {
    if (result.value) {
      window.location =
        "solicitudesSuplente";
    }
  });
});


$(document).on("click", ".btnZonaAgregada", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "La zona de supervisión: \"Supervisión Escolar de Zona A\" se agregó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "zonasSupervision";
      }
  });
});

$(document).on("click", ".btnZonaActualizada", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "La zona de supervisión: \"Supervisión Escolar de Zona A\" se actualizó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "zonasSupervision";
      }
  });
});

$(document).on("click", ".btnCargoEliminado", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "El cargo con plaza N° 324567 se eliminó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "cargos";
      }
  });
});

$(document).on("click", ".btnCargoAgregado", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "El cargo con plaza N° 324567 se agregó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "cargos";
      }
  });
});

$(document).on("click", ".btnCargoActualizado", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "El cargo con plaza N° 324567 se actualizó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "cargos";
      }
  });
});

$(document).on("click", ".btnSolicEliminada", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "La solicitud de Maestro de Educación Física - Perez, Lucas (21245465) se eliminó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "cargos";
      }
  });
});

$(document).on("click", ".btnSolicAgregada", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "La solicitud de Maestro de Educación Física - Perez, Lucas (21245465) se agregó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "cargos";
      }
  });
});

$(document).on("click", ".btnSolicActualizada", function () {
  let pag = $(this).attr("pag"); 
  Swal.fire({
      title: "OK",
      text: "La solicitud de Maestro de Educación Física - Perez, Lucas (21245465) se actualizó correctamente",
      icon: "success",
      confirmButtonColor: "#3085d6",
      confirmButtonText: "OK",
  }).then(function (result) {
      if (result.isConfirmed) {
        window.location =
        "cargos";
      }
  });
});