// ===================================================================
// Funciones específicas para hacer dinámico los formulario de agentes
// ===================================================================

// ===================================================================
// Script para habilitar las opciones según el rol seleccionado
// ===================================================================

/**
 * Muestra u oculta cards según el rol seleccionado.
 * @param {HTMLElement} rolSelect - Elemento select del rol.
 * @param {HTMLElement} cardZonaRol - Card correspondiente al rol Supervisor.
 * @param {HTMLElement} cardInstiRol - Card correspondiente al rol Director.
 */
function configurarRol(rolSelect, cardZonaRol, cardInstiRol) {
    function toggleCards() {
        const selectedRole = rolSelect.value;

        if (selectedRole === "2") { // Supervisor
            cardZonaRol.style.display = "block";
            cardInstiRol.style.display = "none";
        } else if (selectedRole === "3") { // Director
            cardInstiRol.style.display = "block";
            cardZonaRol.style.display = "none";
        } else {
            cardZonaRol.style.display = "none";
            cardInstiRol.style.display = "none";
        }
    }

    // Añade el evento de cambio al select para ejecutar la función al cambiar el rol
    rolSelect.addEventListener("change", toggleCards);

    // Oculta inicialmente ambas cards
    toggleCards();
}

// ===================================================================
// Sincronización de valores entre dos campos
// ===================================================================

/**
 * Sincroniza los valores entre dos campos de entrada en ambos sentidos.
 * @param {HTMLElement} source - Campo de entrada original.
 * @param {HTMLElement} target - Campo de entrada a sincronizar.
 */
function sincronizarCampos(source, target) {
    function syncFields(source, target) {
        target.value = source.value;
    }

    source.addEventListener("input", function () {
        syncFields(source, target);
    });

    target.addEventListener("input", function () {
        syncFields(target, source);
    });
}

// ===================================================================
// Función para inicializar los scripts
// ===================================================================

/**
 * Inicializa los scripts de configuración de rol y sincronización de campos.
 */
function inicializarScripts() {
    const rolSelect = document.getElementById("rol");
    const cardZonaRol = document.getElementById("cardZonaRol");
    const cardInstiRol = document.getElementById("cardInstiRol");
    const usuario = document.getElementById("usuario");
    const email = document.getElementById("email");

    if (rolSelect && cardZonaRol && cardInstiRol) {
        configurarRol(rolSelect, cardZonaRol, cardInstiRol);
    }

    if (usuario && email) {
        sincronizarCampos(usuario, email);
    }
}

// Ejecuta la inicialización al cargar la página
document.addEventListener("DOMContentLoaded", inicializarScripts);

// Función para guardar el id en el campo oculto y 
// seleccionar automaticamente la mejor coincidencia en datalist

//                  input         opciones      campo oculto
autoSelectBestMatch("dlInstituciones", "OpcInstituciones", "id_autocompletar");
autoSelectBestMatch("dlZonas", "OpcZonas", "id_autocompletar");
