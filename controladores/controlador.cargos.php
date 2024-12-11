<?php

class ControladorCargos{
    // ==============================================================
    // Mostrar Cargos
    // ==============================================================
    static public function ctrMostrarCargos($id_cargo, $valor){
        $respuesta = ModeloCargos::mdlMostrarCargos($id_cargo,$valor);
        return $respuesta;
    }

    // ==============================================================
    // Agregar Cargo
    // ==============================================================
    public function ctrAgregarCargo()
    {   
        $errores = []; // Inicializar arreglo de errores
        $validado = ""; // Inicializar clase de validación

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validador = new validador();

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

                // Verificar que el ID de la institución sea mayor a 0
                if ($idInstitucion > 0) {
                    $inst[$key] =  $idInstitucion;
                }
            }
            
            $erroresInstituciones = $validador->instituciones($inst, ModeloInstituciones::class);
            // Merge de errores de instituciones con el resto de los errores
            $errores = array_merge($errores, $erroresInstituciones);

            // Obtener el valor de "Comparte con"
            $comparte = $_POST['gridRadiosComparte'] ?? 'noComparte';
            $instituciones = $_POST['instituciones'] ?? [];

            // Validar las instituciones según el número que comparte
            $erroresInstituciones = $validador->validarInstitucionesPorComparte($comparte, $instituciones);
            
            $errores = array_merge($errores, $erroresInstituciones);
            
            // Valida las plazas
            $errorPlaza = Validador::validarHastaSeisDigitos(intval($_POST["numeroPlaza"]));
            if ($errorPlaza) {
                $errores['numeroPlaza'] = $errorPlaza;
            }
            if (!$validador->esUnico(new ModeloCargos, 'mdlPlazaUnica', intval($_POST['numeroPlaza']))) {
                $errores['numeroPlaza'] = "La plaza ya existe.";
            }


            // Valida las horas cátedra (deben ser enteros positivos)
            $errorHorasCatedra = Validador::validarEnteroPositivo($_POST["hsCatedra"]);
            if ($errorHorasCatedra) {
                $errores['hsCatedra'] = $errorHorasCatedra;
            }

            // Validar DNI
            if ($_POST['dniDocente'] != ""){
                if (!$validador->dni($_POST['dniDocente'] ?? '')) {
                    $errores['dniDocente'] = "El número de dni ingresado no es válido.";
                }
            }

            if (empty($errores)) {
                // Obtener datos del formulario
                $numeroPlaza = intval($_POST["numeroPlaza"]);
                $id_NombreCargo = intval($_POST["id_NombreCargo"]);
                $id_Turno = intval($_POST["id_Turno"]);
                $id_Grado = intval($_POST["id_Grado"]);
                $id_Division = intval($_POST["id_Division"]);
                $hsCatedra = intval($_POST["hsCatedra"]);
                $nombreDocente = htmlspecialchars($_POST["nombreDocente"]);
                $apellidoDocente = htmlspecialchars($_POST["apellidoDocente"]);
                $dniDocente = intval($_POST["dniDocente"]);
                
                // Procesar instituciones
                $instituciones = [];
                foreach ($_POST["instituciones"] as $key => $institucion) {
                    $idInstitucion = intval($institucion["id_Institucion"]);
                    // Verificar que el ID de la institución sea mayor a 0
                    if ($idInstitucion > 0) {
                        $instituciones[] = [
                            "id_Institucion" => $idInstitucion,
                            "sede" => $key === 0 ? 1 : 0, // La primera institución es la sede
                        ];
                    }
                }

                if ($id_Grado == '' || $id_Grado == 0) {
                    $id_Grado = NULL;
                }
                if ($id_Division == '' || $id_Division == 0) {
                    $id_Division = NULL;
                }
                if ($dniDocente == '' || $dniDocente == 0) {
                    $dniDocente = NULL;
                }
        
                // Enviar datos al modelo
                $respuesta = ModeloCargos::mdlAgregarCargo([
                    "numeroPlaza" => $numeroPlaza,
                    "id_NombreCargo" => $id_NombreCargo,
                    "id_Turno" => $id_Turno,
                    "id_Grado" => $id_Grado,
                    "id_Division" => $id_Division,
                    "hsCatedra" => $hsCatedra,
                    "nombreDocente" => $nombreDocente,
                    "apellidoDocente" => $apellidoDocente,
                    "dniDocente" => $dniDocente,
                    "instituciones" => $instituciones,
                ]);
        
                // Responder según resultado
                $url = ControladorPlantilla::url() . "cargos";
                if ($respuesta["status"] === "ok") {
                    echo '<script>
                        fncSweetAlert(
                            "success",
                            "El cargo con plaza N°' . $numeroPlaza . ' se agregó correctamente",
                            "' . $url . '"
                        );
                        </script>';
                } else {
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudieron agregar los datos del cargo. " . $respuesta["message"] . "',
                        icon: 'error'
                    });
                    </script>";
                }
            }else {
                $validado = "was-validated";
            }
        }

        // Retornar los resultados para usarlos en el formulario HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }

    // ==============================================================
    // Editar Cargo
    // ==============================================================
    public function ctrEditarCargo()
    {
        
        $errores = []; // Inicializar arreglo de errores
        $validado = ""; // Inicializar clase de validación

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $validador = new Validador();

            // Validar el ID del cargo
            $id_Cargo = intval($_POST['id_Cargo'] ?? 0);
            if ($id_Cargo <= 0) {
                $errores['id_Cargo'] = "El ID del cargo no es válido.";
            }

            // Obtener el cargo seleccionado
            $cargo = $_POST['id_NombreCargo'] ?? '';

            // Decidir qué campos validar según el cargo
            $campos = ['id_Turno', 'id_NombreCargo'];
            if ($validador->requiereGradoDivision($cargo)) {
                $campos = array_merge($campos, ['id_Grado', 'id_Division']);
            }

            // Validar los selects necesarios en el formulario
            foreach ($campos as $campo) {
                if ($validador->validarSelect($_POST[$campo] ?? '')) {
                    $errores[$campo] = "Por favor, seleccione una opción válida.";
                }
            }

            // Validar plazas
            $errorPlaza = Validador::validarHastaSeisDigitos(intval($_POST["numeroPlaza"]));
            if ($errorPlaza) {
                $errores['numeroPlaza'] = $errorPlaza;
            }
            if (!$validador->esUnico(new ModeloCargos, 'mdlPlazaUnica', intval($_POST['numeroPlaza']), ' and id_Cargo <> '. intval($_POST['id_Cargo']))) {
                $errores['numeroPlaza'] = "La plaza ya existe.";
            }

            // Validar horas cátedra
            $errorHorasCatedra = Validador::validarEnteroPositivo($_POST["hsCatedra"]);
            if ($errorHorasCatedra) {
                $errores['hsCatedra'] = $errorHorasCatedra;
            }

            // Validar DNI
            if ($_POST['dniDocente'] != "") {
                if (!$validador->dni($_POST['dniDocente'] ?? '')) {
                    $errores['dniDocente'] = "El número de DNI ingresado no es válido.";
                }
            }


            // Procesar instituciones
            $instituciones = [];
            foreach ($_POST["instituciones"] as $key => $institucion) {
                $idInstitucion = intval($institucion["id_Institucion"]);                
                // Verificar que el ID de la institución sea mayor a 0
                if ($idInstitucion > 0) {
                    $instituciones[] = [
                        "id_Institucion" => $idInstitucion,
                        "sede" => $key === 0 ? 1 : 0, // La primera institución es la sede
                    ];
                }
            }

            if (empty($errores)) {
                // Obtener datos del formulario
                $numeroPlaza = intval($_POST["numeroPlaza"]);
                $id_NombreCargo = intval($_POST["id_NombreCargo"]);
                $id_Turno = intval($_POST["id_Turno"]);
                $id_Grado = intval($_POST["id_Grado"]);
                $id_Division = intval($_POST["id_Division"]);
                $hsCatedra = intval($_POST["hsCatedra"]);
                $nombreDocente = htmlspecialchars($_POST["nombreDocente"]);
                $apellidoDocente = htmlspecialchars($_POST["apellidoDocente"]);
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
                
                // Enviar datos al modelo
                $respuesta = ModeloCargos::mdlEditarCargo([
                    "id_Cargo" => $id_Cargo,
                    "numeroPlaza" => $numeroPlaza,
                    "id_NombreCargo" => $id_NombreCargo,
                    "id_Turno" => $id_Turno,
                    "id_Grado" => $id_Grado,
                    "id_Division" => $id_Division,
                    "hsCatedra" => $hsCatedra,
                    "nombreDocente" => $nombreDocente,
                    "apellidoDocente" => $apellidoDocente,
                    "dniDocente" => $dniDocente,
                    "instituciones" => $instituciones,
                ]);



                // Responder según resultado
                $url = ControladorPlantilla::url() . "cargos";
                if ($respuesta["status"] === "ok") {
                    echo '<script>
                        fncSweetAlert(
                            "success",
                            "El cargo fue actualizado correctamente",
                            "' . $url . '"
                        );
                        </script>';
                } else {
                    echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudo actualizar el cargo. " . $respuesta["message"] . "',
                        icon: 'error'
                    });
                    </script>";
                }
            } else {
                $validado = "was-validated";
            }
        }

        // Retornar los resultados para usarlos en el formulario HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }

    // ==============================================================
    // Eliminar Cargo
    // ==============================================================
    static public function ctrEliminarCargo()
    {
     
        if (isset($_GET["id_eliminar"])) {

            $url = ControladorPlantilla::url() . "cargos";
            $dato = $_GET["id_eliminar"];

            $respuesta = ModeloCargos::mdlEliminarCargo($dato);

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

    
}