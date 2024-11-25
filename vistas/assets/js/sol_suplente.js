// ===================================================================
// Funciones específicas para hacer dinámico los formularios de solicitudes de suplentes
// ===================================================================

// Selecciona los radio buttons y los contenedores de cada institución
const radios = document.getElementsByName("gridRadiosComparte");
const institucion2 = document.getElementById("institucion2");
const institucion3 = document.getElementById("institucion3");
const institucion4 = document.getElementById("institucion4");

// Función para mostrar u ocultar campos según la opción seleccionada
function toggleInstituciones() {
    institucion2.style.display = radios[1].checked || radios[2].checked || radios[3].checked ? "block" : "none";
    lblinstitucion2.style.display = institucion2.style.display;
    document.getElementById("divhsEst2").style.display = institucion2.style.display;
    document.getElementById("hsEst2").style.display = institucion2.style.display;

    institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
    lblinstitucion3.style.display = institucion3.style.display;
    document.getElementById("divhsEst3").style.display = institucion3.style.display;
    document.getElementById("hsEst3").style.display = institucion3.style.display;

    institucion4.style.display = radios[3].checked ? "block" : "none";
    lblinstitucion4.style.display = institucion4.style.display;
    document.getElementById("divhsEst4").style.display = institucion4.style.display;
    document.getElementById("hsEst4").style.display = institucion4.style.display;
}

document.getElementById("checkAbierto").addEventListener("change", function() {
    var fechaFinInput = document.getElementById("fechaFin");
    fechaFinInput.value = this.checked ? "Abierto" : "";
});

function syncFields(source, target) {
    target.value = source.value;
}

const institucionSede = document.getElementById("institucionSede");
const institucion1 = document.getElementById("institucion1");

institucionSede.addEventListener("input", function() {
    syncFields(institucionSede, institucion1);
});

institucion1.addEventListener("input", function() {
    syncFields(institucion1, institucionSede);
});

function borrarHorario(dia, inst) {
    const horaInicio = document.getElementById(`horaIni${dia}E${inst}`);
    const horaFin = document.getElementById(`horaFin${dia}E${inst}`);
    if (horaInicio) horaInicio.value = "";
    if (horaFin) horaFin.value = "";
}

radios.forEach(radio => {
    radio.addEventListener("change", toggleInstituciones);
});

toggleInstituciones();
