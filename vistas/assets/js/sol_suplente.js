// ===================================================================
// Funciones específicas para hacer dinámico los formularios de solicitudes de suplentes
// ===================================================================

// document.getElementById("divhsEst2").style.display = institucion2.style.display;
// document.getElementById("hsEst2").style.display = institucion2.style.display;

// Selecciona los radio buttons
const radios = document.getElementsByName("gridRadiosComparte");
// Selecciona los contenedores de instituciones usando querySelector
const institucion2 = document.getElementById("Est2");
const institucion3 = document.getElementById("Est3");
const institucion4 = document.getElementById("Est4");

// Función para mostrar u ocultar campos según la opción seleccionada
function toggleInstituciones() {
    // Institucion 2
    institucion2.style.display = radios[1].checked || radios[2].checked || radios[3].checked ? "block" : "none";
    lblinstitucion2.style.display = institucion2.style.display;
    document.getElementById("divhsEst1").style.display = institucion2.style.display;
    
    // Institucion 3
    institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
    lblinstitucion3.style.display = institucion3.style.display;
    document.getElementById("divhsEst2").style.display = institucion3.style.display;
    
    // Institucion 4
    institucion4.style.display = radios[3].checked ? "block" : "none";
    lblinstitucion4.style.display = institucion4.style.display;
    document.getElementById("divhsEst3").style.display = institucion4.style.display;
    
}

// Función para sincronizar el valor de la institucion sede en horario
function syncFields(source, target) {
    target.value = source.value;
}

// Obtener los elementos de los campos
const institucionSede = document.getElementById("institucionSede");
const institucion1 = document.getElementById("institucion1");

// Agregar event listeners para sincronizar los valores en ambos sentidos
institucionSede.addEventListener("input", function() {
    syncFields(institucionSede, institucion1);
});

institucion1.addEventListener("input", function() {
    syncFields(institucion1, institucionSede);
});
//----- Fin sincronizar el valor de la institucion sede en horario -------


// Borrar Horario
function borrarHorario(dia, inst) {
    const horaInicio = document.getElementById(`horaIni${dia}E${inst}`);
    const horaFin = document.getElementById(`horaFin${dia}E${inst}`);
    const dias = document.getElementById(`dia${dia}E${inst}`);

    if (horaInicio) horaInicio.value = "";
    if (horaFin) horaFin.value = "";
    if (dias) dias.value = "";
}

// Cargo Abierto
const checkbox = document.getElementById('checkAbierto');
const fechaFinInput = document.getElementById('fechaFin');

// Función para manejar el cambio en el checkbox
checkbox.addEventListener('change', () => {
    if (checkbox.checked) {
        // Si el checkbox está seleccionado, deshabilitar el campo de fecha
        fechaFinInput.setAttribute('readonly', true);
        fechaFinInput.value = 'Abierto';
    } else {
        // Si el checkbox no está seleccionado, habilitar el campo de fecha
        fechaFinInput.removeAttribute('readonly');
        fechaFinInput.value = '';
    }
});

// Añade el evento de cambio a cada radio button para ejecutar la función cuando cambie la selección
radios.forEach(radio => {
    radio.addEventListener("change", toggleInstituciones);
});

// Oculta inicialmente todos los campos extra
toggleInstituciones();

// autoSelectBestMatch('motivo', 'opcionesMotivo', 'idMotivo');
autoSelectBestMatch('institucionSede', 'OpcionesInstitucion', 'idInstitucion1');
autoSelectBestMatch('institucion1', 'OpcionesInstitucion', 'idInstitucion1');
autoSelectBestMatch('institucion2', 'OpcionesInstitucion', 'idInstitucion2');
autoSelectBestMatch('institucion3', 'OpcionesInstitucion', 'idInstitucion3');
autoSelectBestMatch('institucion4', 'OpcionesInstitucion', 'idInstitucion4');
