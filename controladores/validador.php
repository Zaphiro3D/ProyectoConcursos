<?php

class validador
{   
    //Validación de espacios vacíos
    public function string ($value)
    {
        return strlen(trim($value)) === 0;
    }

    //Validación de cantidad max de caracteres
    public function long($value, $max = 100)
    {
        return strlen(trim($value)) >= $max;
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

    //Validación de Instituciones
    public static function instituciones($instituciones, $modelInstituciones)
    {
        $errores = [];

        // Array para verificar duplicados
        $idsInstituciones = [];

        foreach ($instituciones as $key => $institucion) {
            $idInstitucion = $institucion ?? '';

            // Validar que no esté vacío el campo de sede
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
    
    //Validación para no duplicar valores en base de datos. Ej: DNI, CUE, numPlaza
    public function esUnico($modelo, $metodo, $valor, $condicConsulta = '')
    {
        // Llama al modelo y método específico
        return $modelo->$metodo($valor, $condicConsulta);
    }

    public static function validarFechaRango($fechaInicio, $fechaFin, $checkAbierto)
    {
        // Validar formato de entrada DD-MM-YYYY
        $patronFecha = '/^\d{2}-\d{2}-\d{4}$/';

        if ($checkAbierto != 'on'){

            if (!preg_match($patronFecha, $fechaInicio) || !preg_match($patronFecha, $fechaFin)) {
                return false; // Formato de fecha ingresado inválido
            }

            // Convertir fechas de DD-MM-YYYY a YYYY-MM-DD
            $inicioConvertida = DateTime::createFromFormat('d-m-Y', $fechaInicio);
            $finConvertida = DateTime::createFromFormat('d-m-Y', $fechaFin);

            // Verificar que las fechas se hayan convertido correctamente
            if (!$inicioConvertida || !$finConvertida) {
                return false; // Error en la conversión de fechas
            }

            // Convertir a formato de base de datos (YYYY-MM-DD)
            $inicio = $inicioConvertida->format('Y-m-d');
            $fin = $finConvertida->format('Y-m-d');

            // Comparar las fechas
            if ($inicio > $fin) {
                return false; // La fecha de inicio no puede ser posterior a la fecha de fin
            }

            return [
                'fechaInicio' => $inicio,
                'fechaFin' => $fin
            ]; // Retornar las fechas en formato YYYY-MM-DD para la base de datos
        } else{
            if (!preg_match($patronFecha, $fechaInicio)) {
                return false; // Formato de fecha ingresado inválido
            }

            // Convertir fechas de DD-MM-YYYY a YYYY-MM-DD
            $inicioConvertida = DateTime::createFromFormat('d-m-Y', $fechaInicio);

            // Verificar que las fechas se hayan convertido correctamente
            if (!$inicioConvertida) {
                return false; // Error en la conversión de fechas
            }

            // Convertir a formato de base de datos (YYYY-MM-DD)
            $inicio = $inicioConvertida->format('Y-m-d');

            return [
                'fechaInicio' => $inicio,
                'fechaFin' => $fechaFin
            ]; // Retornar las fechas en formato YYYY-MM-DD para la base de datos
        }
    }

    public static function validarDiaHorario($dia)
    {
        // Verificar que el día tenga las claves necesarias
        if (!isset($dia['horaInicio'], $dia['horaFin'])) {
            return false;
        }

        // Validar formato de hora (HH:MM)
        $patronHora = '/^(?:[01]\d|2[0-3]):[0-5]\d$/';

        if (!preg_match($patronHora, $dia['horaInicio']) || !preg_match($patronHora, $dia['horaFin'])) {
            return false; // Formato de hora inválido
        }

        // Convertir las horas a formato de tiempo
        $horaInicio = strtotime($dia['horaInicio']);
        $horaFin = strtotime($dia['horaFin']);

        // Verificar que la hora de inicio sea anterior a la hora de fin
        if ($horaInicio >= $horaFin) {
            return false; // Hora de inicio no puede ser igual o posterior a la hora de fin
        }

        return true; // El día y horario son válidos
    }
    

}