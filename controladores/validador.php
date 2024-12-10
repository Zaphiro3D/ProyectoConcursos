<?php

class validador
{   
    //Validación de espacios vacíos
    public function string ($value)
    {
        return strlen(trim($value)) === 0;
    }

    //Validación de teléfono
    public function telefono($telefono)
    {
        // Elimina espacios, guiones y paréntesis para normalizar
        $telefono = preg_replace('/[\s\-\(\)]/', '', $telefono);

        // Validar prefijo internacional opcional (+54) y número de 10-11 dígitos
        // ^ y $: Aseguran que la validación abarque todo el número.
        // (\+54)?: Permite que el número incluya o no el prefijo internacional +54.
        // [1-9]: El número no puede comenzar con 0.
        // \d{9}: Exige exactamente 9 dígitos adicionales después del código de área, totalizando 10 dígitos.
        
        if (preg_match('/^(\+54)?[1-9]\d{9}$/', $telefono)) {
            return true; // Es un número válido
        }

        return false; // Número inválido
    }

    //Validación de DNI
    public function dni($dni)
    {
        // Elimina puntos o espacios
        $dni = preg_replace('/[^\d]/', '', $dni);

        // Validar longitud y que sean solo números
        if (preg_match('/^\d{7,8}$/', $dni)) {
            return true; // DNI válido
        }

        return false; // DNI inválido
    }

    public static function instituciones($instituciones, $modelInstituciones)
    {
        $errores = [];

        // Array para verificar duplicados
        $idsInstituciones = [];

        foreach ($instituciones as $key => $institucion) {
            $idInstitucion = $institucion ?? '';

            // Validar que no esté vacío el caampo de sede
            if (empty($idInstitucion) and $key ==0) {
                $errores["insti" . ($key + 1)] = 'La institución no puede estar vacía.';
                continue;
            }

            // Validar que exista en la base de datos
            if (!$modelInstituciones::mdlExisteInstitucion($idInstitucion)) {
                $errores["insti" . ($key + 1)] = 'La institución seleccionada no es válida.';
                continue;
            }

            // Validar duplicados
            if (in_array($idInstitucion, $idsInstituciones)) {
                $errores["insti" . ($key + 1)] = 'La institución ya fue seleccionada anteriormente.';
            } else {
                $idsInstituciones[] = $idInstitucion;
            }
        }

        return $errores;
    }

    /**
     * Validar que un select tenga un valor seleccionado.
     * 
     * @param string $valor El valor seleccionado del select.
     * @param array $opcionesInvalidas (Opcional) Valores considerados inválidos (por defecto: ['0', 'seleccione']).
     * @return bool Retorna true si el valor es inválido, false si es válido.
     */
    public function validarSelect($valor, $opcionesInvalidas = ['0', 'seleccione']) {
        // Verifica si el valor está vacío o es parte de las opciones inválidas
        return empty($valor) || in_array($valor, $opcionesInvalidas, true);
    }

    /**
     * Verificar si un cargo requiere grado y división:
     * 33 Maestro de ciclo
     * 8 Maestro de Jóvenes y Adultos
     * 
     * @param string $cargo El nombre del cargo.
     * @param array $cargosQueRequieren Grupos de cargos que necesitan grado y división.
     * @return bool Retorna true si el cargo requiere grado y división, false de lo contrario.
     */
    public function requiereGradoDivision($cargo, $cargosQueRequieren = [33, 8]) {
        return in_array((int)$cargo, $cargosQueRequieren);
        // return in_array(strtolower(trim($cargo)), array_map('strtolower', $cargosQueRequieren));
    }

     
    /**
     * Validar instituciones según el número de instituciones que comparte.
     * 
     * @param string $comparte Valor del campo de "Comparte con" (comparte1, comparte2, etc.).
     * @param array $instituciones Array de instituciones enviadas en el formulario.
     * @return array Retorna un array con errores, vacío si no hay errores.
     */
    public function validarInstitucionesPorComparte($comparte, $instituciones) {
        $errores = [];
        
        // Determina cuántas instituciones se requieren según el valor de "comparte"
        $numeroInstituciones = 0;
        if (preg_match('/comparte(\d+)/', $comparte, $matches)) {
            $numeroInstituciones = (int)$matches[1];
        }
        $numeroInstituciones ++;
        // Valida las instituciones necesarias
        for ($i = 1; $i <= $numeroInstituciones; $i++) {
            if (empty($instituciones[$i-1]['id_Institucion'] ?? '')) {
                $errores["insti$i"] = "Debe completar la institución $i.";
            }
        }

        return $errores;
    }

    public static function validarEnteroPositivo($value) {
        // Verifica si el valor es un número entero positivo
        $value == '' ?? $value=0;
        if (filter_var($value, FILTER_VALIDATE_INT, ["options" => ["min_range" => 0]]) === false) {
            return "El valor debe ser un número entero positivo.";
        }
        return null; // Devuelve null si es válido
    }

    public static function validarHastaSeisDigitos($valor) {
        // Verifica si es numérico y tiene hasta 6 dígitos
        if (!preg_match('/^\d{1,6}$/', $valor)) {
            return "El valor debe ser un número con hasta 6 dígitos.";
        }
        return null; // Devuelve null si es válido
    }
    
    
    

}