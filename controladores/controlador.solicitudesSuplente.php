<?php

class ControladorSolSuplente{

    static public function ctrMostrarSolSuplente($id_cargo, $valor){
        $respuesta = ModeloSolSuplente::mdlMostrarSolSuplente($id_cargo,$valor);
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
            $campos = ['id_Turno', 'motivo', 'id_NombreCargo'];
            if ($validador->requiereGradoDivision($cargo)) {
                $campos = array_merge($campos, ['id_Grado', 'id_Division']);
            }

            if (!$validador->esUnico(new ModeloSolSuplente, 'mdlSolicUnica', intval($_POST['id_Cargo']), ' and id_EstadoSol < 7')) {
                $errores['numeroPlaza'] = "Ya existe una solicitud para este cargo";
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
                    foreach ($dias as $d => $dia) {                    
                        // Verificar si $dia es un array válido y contiene la clave "dia"
                        if (is_array($dia) && isset($dia["dia"]) && strlen($dia["dia"]) > 0) { 
                            // Excluir días vacíos
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
                    "dniDocente" => $dniDocente,
                    "estado" => intval($_POST["estado"])
                ]);

                // print_r($respuesta); 
                $url = ControladorPlantilla::url() . "solicitudesSuplente";
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
                // var_dump($errores);
                $validado = "was-validated";
            }
        }

        // Retornar los resultados para el formulario HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }

    // ==============================================================
    // Editar Solicitud de Suplente
    // ==============================================================
    public function ctrEditarSolicitud()
    {
        $errores = []; // Inicializar arreglo de errores
        $validado = ""; // Inicializar clase de validación

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // var_dump($_POST); die();

            $validador = new Validador();
            
            // Obtener y validar campos requeridos
            $campos = [ 'fechaInicio', 'fechaFin', 'motivo'];
            foreach ($campos as $campo) {
                if ($validador->validarSelect($_POST[$campo] ?? '')) {
                    $errores[$campo] = "Por favor, seleccione $campo correctamente.";
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
                    $iDia = 0;
                    foreach ($dias as $d => $dia) {                        
                        // Verificar si $dia es un array válido y contiene la clave "dia"
                        if (is_array($dias[$d]) && isset($dias[$d]["dia"]) && strlen($dias[$d]["dia"]) > 0) { 
                            // Excluir días vacíos
                            if (!$validador->validarDiaHorario($dias[$d])) {
                                $errores["instituciones_$key"] = "Días u horarios inválidos para la institución $idInstitucion.";
                            } else {
                                $diasValidos[$idInstitucion][] = $dias[$d]; // Agregar solo días válidos
                            }
                        }
                    }
                    $instituciones[] = [
                        "id_Institucion" => $idInstitucion,
                        "sede" => $key === 0 ? 1 : 0, // La primera institución es la sede
                        "dias" => $diasValidos[$idInstitucion] // Usar solo los días válidos
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
                $dniDocente = intval($_POST["dniDocente"]);

                $respuesta = ModeloSolSuplente::mdlEditarSolicitud([   
                    "observaciones" => htmlspecialchars($_POST["observaciones"] ?? ''),
                    "fechaInicio" => $fechas["fechaInicio"],
                    "fechaFin" => $fechas["fechaFin"],
                    "id_Motivo" => intval($_POST["idMotivo"] ?? NULL),
                    "numeroPlaza" => $numeroPlaza,
                    "instituciones" => $instituciones,
                    "nombreDocente" => htmlspecialchars($_POST["nombreDocente"]),
                    "apellidoDocente" => htmlspecialchars($_POST["apellidoDocente"]),
                    "dniDocente" => $dniDocente,
                    "estado" => intval($_POST["estado"]),
                    "id_sol" => intval($_POST["id_sol"])
                ]);

                $url = ControladorPlantilla::url() . "solicitudesSuplente";
                if ($respuesta["status"] === "ok") {
                    echo '<script>
                        fncSweetAlert(
                            "success",
                            "La solicitud se actualizó correctamente",
                            "' . $url . '"
                        );
                        </script>';
                } else {
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo actualizar la solicitud. " . $respuesta["message"] . "',
                        icon: 'error'
                    });
                    </script>";
                }
            } else {
                // Si hay errores, marcar el formulario como validado
                $validado = "was-validated";
            }
        }

        // Retornar los resultados para el formulario HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }


    public function ctrBuscarDatosPorPlaza($numeroPlaza)
    {

    $datosCargo = []; // Inicializar la variable para evitar errores

        if (!empty($numeroPlaza)) {
            if ($numeroPlaza > 0) {
                // Llamar al modelo para buscar los datos
                $datosCargo = ModeloSolSuplente::mdlObtenerDatosPorPlaza($numeroPlaza);

                if (!$datosCargo) {
                    // echo "<script>
                    //     Swal.fire('Error', 'No se encontraron datos para la plaza ingresada.', 'error');
                    // </script>";
                }else{
                    //redirigir
                    //redirectToPlaza();
                    
                }
            } else {
                echo "<script>
                    Swal.fire('Error', 'Número de plaza inválido.', 'error');
                </script>";
            }
        } else {
            // echo "Error: No se recibió el número de plaza.";    
        }

        return $datosCargo; // Devolver los datos al formulario
    }

    // ==============================================================
    // Eliminar Solicitud
    // ==============================================================
    static public function ctrEliminarSolicitud()
    {
     
        if (isset($_GET["id_eliminar"])) {

            $url = ControladorPlantilla::url() . "solicitudesSuplente";
            $dato = $_GET["id_eliminar"];

            $respuesta = ModeloSolSuplente::mdlEliminarSolicitud($dato);

            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success", 
                "El cargo se eliminó correctamente",
                "' . $url . '");
                </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo eliminar el cargo.',
                    icon: 'error'
                });
                </script>";
            }
        }
    }

    // ==============================================================
    // Mostrar Horarios Solicitud
    // ==============================================================
    public static function ctrMostrarHorariosSol($valor) {
        $horarios = ModeloSolSuplente::mdlMostrarHorariosSol($valor);
        return $horarios;
    }
    
    // ==============================================================
    // Rechazar Solicitud
    // ==============================================================
    static public function ctrRechazarSolicitud()
    {
        switch ($_SESSION["autorizacion"]) {
            case 1: //Jefe
                # code...
                break;

            case 2: //Supervisor
                # code...
                break;
            
            case 3: //Director
                # code...
                break;

            case 4: //Administrativo
                # code...
                break;

            default:
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Permimsos Insuficientes',
                    icon: 'error'
                });
                </script>";
                break;
        }


        if (isset($_GET["id_rechazar"])) {

            $url = ControladorPlantilla::url() . "solicitudesSuplente";
            $id = $_GET["id_rechazar"];
            $estado = $_GET["id_estado"];
            $estadoNuevo = NULL;

            switch ($estado) {
                case 1: //Borrador
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se puede rechazar una solicitud en borrador',
                        icon: 'error'
                    });
                    </script>";
                    break;
                    
                case 2: //Pendiente en Supervisión
                    //cambiar estado a 4. Vuelve a verlo la escuela
                    $estadoNuevo = 4;
                    $mensaje = "Se enviará a la escuela para su corrección.";
                    break;

                case 3: //Pendiente en Administración
                    //cambiar estado a 5. Vuelve a verlo el supervisor
                    $estadoNuevo = 5;
                    $mensaje = "Se enviará a la supervisión para su corrección.";
                    break;

                case 4: //Rechazado por Supervisión
                    //Escuela intenta rechazar
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se puede rechazar esta solicitud',
                        icon: 'error'
                    });
                    </script>";
                    break;

                case 5: //Rechazado por Administración
                    //supervisor rechaza, vuelve a la escuela
                    $estadoNuevo = 4;
                    $mensaje = "Se enviará a la escuela para su corrección.";
                    break;

                case 6: //A Concursar
                    //vuelve a 3 pendiente en administracion
                    $estadoNuevo = 3;
                    $mensaje = "Vuelve a estar pendiente en administración";
                    break;

                case 7: //Ya Concursado
                    //vuelve a 6 a concursar
                    $estadoNuevo = 6;
                    $mensaje = "Vuelve a estar para concursar";
                    break;  
                default: // 8 Eliminado // otro
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se puede rechazar esta solicitud',
                        icon: 'error'
                    });
                    </script>";
                    break;
            }

            if ($estadoNuevo){
                $respuesta = ModeloSolSuplente::mdlRechazarSolicitud($estadoNuevo, $id);

                if ($respuesta == "ok") {


                    echo '<script>

                    Swal.fire({
                        title: "Solicitud Rechazada",
                        text: "La solicitud ha sido rechazada. ' . $mensaje . '",
                        icon: "error",
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
                    </script>';
                }
                else{
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo rechazar la solicitud.',
                        icon: 'error'
                    });
                    </script>";
                }
            }
        }

    }


    // ==============================================================
    // Aprobar Solicitud
    // ==============================================================
    static public function ctrAprobarSolicitud()
    {
        switch ($_SESSION["autorizacion"]) {
            case 1: //Jefe
                # code...
                break;

            case 2: //Supervisor
                # code...
                break;
            
            case 3: //Director
                # code...
                break;

            case 4: //Administrativo
                # code...
                break;

            default:
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Permimsos Insuficientes',
                    icon: 'error'
                });
                </script>";
                exit();
                break;
        }


        if (isset($_GET["id_aprobar"])) {

            $url = ControladorPlantilla::url() . "solicitudesSuplente";
            $id = $_GET["id_aprobar"];
            $estado = $_GET["id_estado"];
            $estadoNuevo = NULL;
            switch ($estado) {
                case 1: //Borrador
                    $estadoNuevo = 2;
                    $mensaje = "La solicitud ha sido enviada a la Supervisión correspondiente.";
                    break;
                    
                case 2: //Pendiente en Supervisión
                    $estadoNuevo = 3;
                    $mensaje = "La solicitud ha sido enviada a la administración para su corrección.";
                    break;

                case 3: //Pendiente en Administración
                    $estadoNuevo = 6;
                    $mensaje = "La solicitud ha sido aprobada. Se agregará al listado de cargos a concursar.";
                    break;

                case 4: //Rechazado por Supervisión
                    $estadoNuevo = 2;
                    $mensaje = "La solicitud ha sido enviada a la Supervisión correspondiente.";
                    
                    break;

                case 5: //Rechazado por Administración
                    $estadoNuevo = 3;
                    $mensaje = "La solicitud ha sido enviada a la escuela para su corrección.";
                    break;

                case 6: //A Concursar
                    $estadoNuevo = 7;
                    $mensaje = "La solicitud ha sido marcada como ya concursada.";
                    break;

                case 7: //Ya Concursado
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se puede aprobar una solicitud que ya se ha concursado',
                        icon: 'error'
                    });
                    </script>";
                default: // 8 Eliminado // otro
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se puede aprobar esta solicitud',
                        icon: 'error'
                    });
                    </script>";
                    break;
            }

            if ($estadoNuevo){
                $respuesta = ModeloSolSuplente::mdlAprobarSolicitud($estadoNuevo, $id);

                if ($respuesta == "ok") {
                    echo '<script>

                    Swal.fire({
                        title: "Solicitud Aprobada",
                        text: "' . $mensaje . '",
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
                    </script>';
                }
                else{
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo aprobar la solicitud.',
                        icon: 'error'
                    });
                    </script>";
                }
            }
        }



    }

}

