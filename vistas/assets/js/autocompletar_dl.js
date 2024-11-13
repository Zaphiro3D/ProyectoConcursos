function autoSelectBestMatch(inputId, datalistId, hiddenInputId) {
    const input = document.getElementById(inputId);
    const datalist = document.getElementById(datalistId);
    const hiddenInput = document.getElementById(hiddenInputId);

    // Actualizar el ID al escribir en el campo (si hay coincidencia exacta)
    input.addEventListener("input", function() {
        const inputValue = this.value;
        hiddenInput.value = ""; // Limpia el valor por defecto

        for (const option of datalist.options) {
            if (option.value === inputValue) {
                hiddenInput.value = option.getAttribute("data-id");
                break;
            }
        }
    });

    // Seleccionar la mejor coincidencia al salir del campo
    input.addEventListener("blur", function() {
        const inputValue = this.value.toLowerCase();

        let bestMatch = null;
        let bestMatchID = null;
        let highestScore = 0;

        for (const option of datalist.options) {
            const optionValue = option.value.toLowerCase();

            // Calcula el puntaje de coincidencia
            let score = 0;
            if (optionValue === inputValue) {
                score = 3; // coincidencia exacta
            } else if (optionValue.startsWith(inputValue)) {
                score = 2; // coincide el inicio
            } else if (optionValue.includes(inputValue)) {
                score = 1; // contiene la búsqueda
            }

            // Actualiza si se encuentra un puntaje más alto
            if (score > highestScore) {
                highestScore = score;
                bestMatch = option.value;
                bestMatchID = option.getAttribute("data-id");
            }
        }

        // Actualiza los campos si hay una coincidencia
        if (bestMatch) {
            input.value = bestMatch;
            hiddenInput.value = bestMatchID;
        } else {
            // Limpia si no hay coincidencia
            hiddenInput.value = "";
        }
    });
}
