function autoSelectBestMatch(inputId, datalistId, hiddenInputId) {
    const input = document.getElementById(inputId);
    const datalist = document.getElementById(datalistId);
    const hiddenInput = document.getElementById(hiddenInputId);

    // Actualizar el ID al escribir en el campo
    input.addEventListener("input", function () {
        const inputValue = this.value.trim();
        hiddenInput.value = ""; // Limpia el valor por defecto

        // Buscar coincidencia exacta
        for (const option of datalist.options) {
            if (option.value.trim().toLowerCase() === inputValue.toLowerCase()) {
                hiddenInput.value = option.getAttribute("data-id");
                break;
            }
        }

        console.log(`Input: ${inputValue}, Hidden: ${hiddenInput.value}`);
    });

    // Seleccionar la mejor coincidencia al salir del campo
    input.addEventListener("blur", function () {
        const inputValue = this.value.trim().toLowerCase();

        // Si el campo está vacío, no realizar ninguna acción
        if (!inputValue) {
            hiddenInput.value = "";
            return;
        }

        let bestMatch = null;
        let bestMatchID = null;
        let highestScore = 0;

        for (const option of datalist.options) {
            const optionValue = option.value.trim().toLowerCase();

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
        
        if (bestMatch) {
            input.value = bestMatch;
            hiddenInput.value = bestMatchID;
        
            // Dispara un evento "input" en el campo actualizado
            input.dispatchEvent(new Event('input'));
        } else {
            hiddenInput.value = "";
        }

        console.log(`Blur Input: ${inputValue}, Best Match: ${bestMatch}, Hidden: ${hiddenInput.value}`);
    });
    
    //Agrega validación al evento blur para forzar un valor válido
    input.addEventListener("blur", function () {
        const inputValue = this.value.trim().toLowerCase();
        if (!hiddenInput.value && inputValue) {
            // Si no hay hiddenInput válido, limpiar el input principal
            this.value = "";
            console.error(`No hay coincidencia para: ${inputValue}`);
        }
        
    });
}
