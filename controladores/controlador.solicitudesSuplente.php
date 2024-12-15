<?php

class ControladorSolSuplente{

    static public function ctrMostrarSolSuplente(){
        $respuesta = ModeloSolSuplente::mdlMostrarSolSuplente();
        return $respuesta;
    }
    
    static public function ctrMostrarDatosSol($tabla, $columnas = "*", $condicion = ""){
        $respuesta = ModeloSolSuplente::mdlMostrarDatosSol($tabla,$columnas,$condicion);
        return $respuesta;
    }

    // ==============================================================
    // Agregar Solicitud de Suplente
    // ==============================================================
    public function ctrAgregarSolicitud()
    {
        
        $errores = []; // Inicializar arreglo de errores
        $validado = ""; // Inicializar clase de validación

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validador = new Validador();
            // Obtener y validar campos requeridos
            $campos = ['id_NombreCargo', 'id_Turno', 'fechaInicio', 'fechaFin', 'hsCatedra', 'motivo'];
            foreach ($campos as $campo) {
                if ($validador->validarSelect($_POST[$campo] ?? '')) {
                    $errores[$campo] = "Por favor, seleccione $campo correctamente.";
                }
            }
            
            // Obtener el cargo seleccionado
            $cargo = $_POST['id_NombreCargo'] ?? '';

            // Decidir qué campos validar según el cargo
            $campos = ['id_Turno', 'id_NombreCargo'];
            if ($validador->requiereGradoDivision($cargo)) {
                $campos = array_merge($campos, ['id_Grado', 'id_Division']);
            }

            // Validar los selects necesarios en el formulario.
            foreach ($campos as $campo) {
                if ($validador->validarSelect($_POST[$campo] ?? '')) {
                    $errores[$campo] = "Por favor, seleccione una opción válida.";
                }
            }

            // Validar instituciones asociadas al cargo
            $inst = [];
            foreach ($_POST["instituciones"] as $key => $institucion) {
                $idInstitucion = intval($institucion["id_Institucion"]);
                $diasValidos[] = '';
                // Verificar que el ID de la institución sea mayor a 0
                if ($idInstitucion > 0) {
                    $dias = $institucion["dias"] ?? [];
                    
                    foreach ($dias as $dia) {
                        if (strlen($dia["dia"]) > 0) { // Excluir días vacíos
                            if (!$validador->validarDiaHorario($dia)) {
                                $errores["instituciones_$key"] = "Días u horarios inválidos para la institución $idInstitucion.";
                            } else {
                                $diasValidos[] = $dia; // Agregar solo días válidos
                            }
                        }
                    }
                    

                    $instituciones[] = [
                        "id_Institucion" => $idInstitucion,
                        "sede" => $key === 0 ? 1 : 0, // La primera institución es la sede
                        "dias" => $diasValidos // Usar solo los días válidos
                    ];
                    $inst[$key] =  $idInstitucion;
                }
            }

            $erroresInstituciones = $validador->instituciones($inst, ModeloInstituciones::class);
            // Merge de errores de instituciones con el resto de los errores
            $errores = array_merge($errores, $erroresInstituciones);

            // Obtener el valor de "Comparte con"
            $comparte = $_POST['gridRadiosComparte'] ?? 'noComparte';

            // Validar las instituciones según el número que comparte
            $erroresInstituciones = $validador->validarInstitucionesPorComparte($comparte, $instituciones);

            $errores = array_merge($errores, $erroresInstituciones);

            // Validar las horas cátedra (enteros positivos)
            $errorHorasCatedra = Validador::validarEnteroPositivo($_POST["hsCatedra"] ?? 0);
            if ($errorHorasCatedra) {
                $errores['hsCatedra'] = $errorHorasCatedra;
            }

            // Validar fechas
            $fechas = $validador->validarFechaRango($_POST["fechaInicio"], $_POST["fechaFin"], isset($_POST['checkAbierto']) ?? '');
            if (!$fechas) {
                $errores['fecha'] = "La fecha de inicio debe ser menor o igual a la fecha de fin.";
            }
            // Validar número de plaza
            $numeroPlaza = intval($_POST["numeroPlaza"] ?? 0);
            $errorPlaza = Validador::validarHastaSeisDigitos($numeroPlaza);
            if ($errorPlaza) {
                $errores['numeroPlaza'] = $errorPlaza;
            }

            // Si no hay errores, procesar el formulario
            if (empty($errores)) {
                $id_Grado = intval($_POST["id_Grado"]);
                $id_Division = intval($_POST["id_Division"]);
                $dniDocente = intval($_POST["dniDocente"]);
                
                if ($id_Grado == '' || $id_Grado == 0) {
                    $id_Grado = NULL;
                }
                if ($id_Division == '' || $id_Division == 0) {
                    $id_Division = NULL;
                }
                if ($dniDocente == '' || $dniDocente == 0) {
                    $dniDocente = NULL;
                }
                
                $respuesta = ModeloSolSuplente::mdlAgregarSolicitud([
                    "id_NombreCargo" => intval($_POST["id_NombreCargo"]),
                    "id_Grado" => $id_Grado,
                    "id_Division" => $id_Division,
                    "id_Turno" => intval($_POST["id_Turno"]),
                    "hsCatedra" => intval($_POST["hsCatedra"]),
                    "observaciones" => htmlspecialchars($_POST["observaciones"] ?? ''),
                    "fechaInicio" => $fechas["fechaInicio"],
                    "fechaFin" => $fechas["fechaFin"],
                    "id_Motivo" => intval($_POST["idMotivo"] ?? NULL),
                    "numeroPlaza" => $numeroPlaza,
                    "instituciones" => $instituciones,
                    "nombreDocente" => htmlspecialchars($_POST["nombreDocente"]),
                    "apellidoDocente" => htmlspecialchars($_POST["apellidoDocente"]),
                    "dniDocente" => $dniDocente
                ]);

                $url = ControladorPlantilla::url() . "solicitudes";
                if ($respuesta["status"] === "ok") {
                    echo '<script>
                        fncSweetAlert(
                            "success",
                            "La solicitud con plaza N°' . $numeroPlaza . ' se agregó correctamente",
                            "' . $url . '"
                        );
                        </script>';
                } else {
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo agregar la solicitud. " . $respuesta["message"] . "',
                        icon: 'error'
                    });
                    </script>";
                }
            } else {
                $validado = "was-validated";
            }
        }

        // Retornar los resultados para el formulario HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }

    public function ctrObtenerDatosPlaza()
    {
        var_dump($_POST); die;
        print_r("Controlador flag");
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            http_response_code(405);
            echo json_encode(["error" => "Método no permitido"]);
            return;
        }

        if (!isset($_POST["numeroPlaza"])) {
            http_response_code(400);
            echo json_encode(["error" => "Número de plaza requerido"]);
            return;
        }

        $numeroPlaza = intval($_POST["numeroPlaza"]);
        var_dump($numeroPlaza); die;

        $datosCargo = ModeloSolSuplente::mdlObtenerDatosPorPlaza($numeroPlaza);

        if (!$datosCargo) {
            echo json_encode(["error" => "No se encontraron datos para la plaza ingresada"]);
        } else {
            echo json_encode($datosCargo);
        }
    }



    
}