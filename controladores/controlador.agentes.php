<?php

require 'validador.php';

class ControladorAgentes{
    // ==============================================================
    // Mostrar Agentes
    // ==============================================================
    static public function ctrMostrarAgentes($agente, $valor){
        $respuesta = ModeloAgentes::mdlMostrarAgentes($agente, $valor);
        return $respuesta;
    }

    // ==============================================================
    // Agregar Agentes
    // ==============================================================
    public function ctrAgregarAgente()
    {
        $errores = []; // Inicializar arreglo de errores
        $validado = ""; // Inicializar clase de validación

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $validador = new validador();

            // Array con los nombres de los campos a validar
            $campos = ['apellido', 'dni', 'nombre', 'email', 'contrasena'];

            
            foreach ($campos as $campo) {
                // Validar campos vacíos
                if ($validador->string($_POST[$campo] ?? '')) {   
                    $errores[$campo] = "Por favor, complete este campo.";
                }

                // Validar max de caracteres
                if ($validador->long($_POST[$campo] ?? '')) {   
                    $errores[$campo] = "Debe ingresar menos de 100 caracteres.";
                }
            }

            // Validar teléfono
            if ($_POST['telefono'] != ""){
                if (!$validador->telefono($_POST['telefono'] ?? '')) {
                    $errores['telefono'] = "El número de teléfono ingresado no es válido.";
                }
            }

            // Validar DNI
            if ($_POST['dni'] != ""){
                if (!$validador->dni($_POST['dni'] ?? '')) {
                    $errores['dni'] = "El número de dni ingresado no es válido.";
                }
            }
            if (!$validador->esUnico(new ModeloAgentes, 'mdlDniUnico', $_POST['dni'])) {
                $errores['dni'] = "El DNI ya está registrado.";
            }

            // Validar Rol
            if (empty($_POST['rol']) || $_POST['rol'] == "") {
                $errores['rol'] = "Por favor, seleccione un rol válido.";
            }

            if (empty($errores)) {
                
                $datos = array(
                    "apellido" => htmlspecialchars($_POST["apellido"]),
                    "nombre" => htmlspecialchars($_POST["nombre"]),
                    "dni" => htmlspecialchars($_POST["dni"]),
                    "telefono" => htmlspecialchars($_POST["telefono"]),
                    "direccion" => htmlspecialchars($_POST["direccion"]),
                    "email" => htmlspecialchars($_POST["email"]),
                    "usuario" => htmlspecialchars($_POST["email"]),
                    "password" => htmlspecialchars($_POST["contrasena"]),
                    "id_Rol" => htmlspecialchars($_POST["rol"])
                    
                    
                );

                // print_r($datos);

                // return;
                
                
                $idAgente = ModeloAgentes::mdlAgregarAgente($datos);
                //print_r($idAgente);
                //return;
                if (is_numeric($idAgente)){
                    if(!empty($_POST["dlInstituciones"])){

                        $idinsti = $_POST["id_autocompletar"];
                        $respuestaDirector = ModeloAgentes::mdlAgregarDirector($idAgente,$idinsti);

                        if($respuestaDirector == "ok"){
                            $url = ControladorPlantilla::url() . "agentes";
                                echo '<script>
                                    fncSweetAlert(
                                    "success",
                                    "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se agregó correctamente",
                                    "' . $url . '"
                                    );
                                    </script>';
                        } else{
                                echo "<script>
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No se pudieron agregar los datos del agente.',
                                    icon: 'error'
                                });
                                </script>";
                        }
                       
                    } elseif (!empty($_POST["dlZonas"])){
                        
                        $idZona = $_POST["id_autocompletar"];
                        $respuestaSupervisor = ModeloAgentes::mdlCambiarSupervisor($idZona,$idAgente);

                        if ($respuestaSupervisor == "ok") {
                            $url = ControladorPlantilla::url() . "agentes";
                            echo '<script>
                                fncSweetAlert(
                                "success",
                                "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se agregó correctamente",
                                "' . $url . '"
                                );
                                </script>';
                        } else {
                            echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudieron agregar los datos del agente.',
                                icon: 'error'
                            });
                            </script>";
                        }
                        
                    }
                }else{
                    if ($idAgente == "error") {
                        echo "<script>
                                Swal.fire({
                                    title: 'Error',
                                    text: 'No se pudieron agregar los datos del agente.',
                                    icon: 'error'
                                });
                                </script>";
                    } else {
                        $url = ControladorPlantilla::url() . "agentes";
                        echo '<script>
                                fncSweetAlert(
                                "success",
                                "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se agregó correctamente",
                                "' . $url . '"
                                );
                            </script>';
                    }
                }

                
            }
            else{
                $validado = "was-validated";
            }
        }

        // Retornar resultados para usarlos en el HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }

    // ==============================================================
    // Editar Agentes
    // ==============================================================
    public function ctrEditarAgente()
    {

        $errores = []; // Inicializar arreglo de errores
        $validado = ""; // Inicializar clase de validación
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $validador = new validador();

            // Array con los nombres de los campos a validar
            $campos = ['apellido', 'dni', 'nombre', 'email', 'contrasena', 'rol'];

            
            foreach ($campos as $campo) {
                // Validar campos vacíos
                if ($validador->string($_POST[$campo] ?? '')) {   
                    $errores[$campo] = "Por favor, complete este campo.";
                }
                
                // Validar max de caracteres
                if ($validador->long($_POST[$campo] ?? '')) {   
                    $errores[$campo] = "Debe ingresar menos de 100 caracteres.";
                }
            }

            // Validar teléfono
            if ($_POST['telefono'] != ""){
                if (!$validador->telefono($_POST['telefono'] ?? '')) {
                    $errores['telefono'] = "El número de teléfono ingresado no es válido.";
                }
            }
            
            // Validar DNI
            if (!$validador->dni($_POST['dni'] ?? '')) {
                $errores['dni'] = "El DNI ingresado no es válido. Debe contener 7 u 8 dígitos.";
            }
            if (!$validador->esUnico(new ModeloAgentes, 'mdlDniUnico', intval($_POST['dni']), ' and id_Agente <> '. intval($_POST['id_Agente']))) {
                $errores['dni'] = "El DNI ya está registrado.";
            }

            // Validar Rol
            if (empty($_POST['rol']) || $_POST['rol'] == "") {
                $errores['rol'] = "Por favor, seleccione un rol válido.";
            }
        
            if (empty($errores)) {
                $datos = array(
                    "apellido" => htmlspecialchars($_POST["apellido"]),
                    "nombre" => htmlspecialchars($_POST["nombre"]),
                    "dni" => htmlspecialchars($_POST["dni"]),
                    "telefono" => htmlspecialchars($_POST["telefono"]),
                    "direccion" => htmlspecialchars($_POST["direccion"]),
                    "email" => htmlspecialchars($_POST["email"]),
                    "usuario" => htmlspecialchars($_POST["email"]),
                    "password" => htmlspecialchars($_POST["contrasena"]),
                    "id_Rol" => htmlspecialchars($_POST["rol"]),
                    "id_Agente" => htmlspecialchars($_POST["id_Agente"])
                );
                
                //$url = ControladorPlantilla::url() . "agentes";
                $respuesta = ModeloAgentes::mdlEditarAgente($datos);
                if ($respuesta == "ok") {

                    if (!empty($_POST["dlInstituciones"]) && ($datos["id_Rol"] == 3)) {
                        $idAgente= $datos["id_Agente"];
                        
                        $idinsti = $_POST["id_autocompletar"];
                        
                        $respuestaDirector = ModeloAgentes::mdlAgregarDirector($idAgente, $idinsti);

                        if ($respuestaDirector == "ok") {
                            $url = ControladorPlantilla::url() . "agentes";
                            echo '<script>
                            fncSweetAlert(
                            "success",
                            "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se actualizó correctamente",
                            "' . $url . '"
                            );
                            </script>';
                        }else{
                            echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudieron actualizar los datos del agente.',
                                icon: 'error'
                            });
                            </script>";
                        }
                    } elseif (!empty($_POST["dlZonas"]) && ($datos["id_Rol"] == 2)) {
                        $idAgente = $datos["id_Agente"];
                        $idZona = $_POST["id_autocompletar"];
                        $respuestaSupervisor = ModeloAgentes::mdlCambiarSupervisor($idZona, $idAgente);

                        if ($respuestaSupervisor == "ok") {
                            $url = ControladorPlantilla::url() . "agentes";
                            echo '<script>
                            fncSweetAlert(
                            "success",
                            "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se actualizó correctamente",
                            "' . $url . '"
                            );
                            </script>';
                        } else {
                            echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudieron actualizar los datos del agente.',
                                icon: 'error'
                            });
                            </script>";
                        }
                    }else{
                        $url = ControladorPlantilla::url() . "agentes";
                        echo '<script>
                            fncSweetAlert(
                            "success",
                            "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se actualizó correctamente",
                            "' . $url . '"
                            );
                            </script>';
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudieron actualizar los datos del agente.',
                            icon: 'error'
                        });
                        </script>";
                }
                
            }
            else{
                $validado = "was-validated";
            }
        } 

        // Retornar resultados para usarlos en el HTML
        return [
            'errores' => $errores,
            'validado' => $validado
        ];
    }

    // ==============================================================
    // Eliminar Agente
    // ==============================================================
    static public function ctrEliminarAgente()
    {
     
        if (isset($_GET["id_eliminar"])) {

            $url = ControladorPlantilla::url() . "agentes";
            $dato = $_GET["id_eliminar"];

            $respuesta = ModeloAgentes::mdlEliminarAgente($dato);

            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success", 
                "El agente se eliminó correctamente",
                "' . $url . '");
                </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo eliminar el agente.',
                    icon: 'error'
                });
                </script>";
            }
        }
    }

    /*=============================================
    INGRESO DE USUARIO
    =============================================*/
    static public function ctrIngresoAgente()
    {
        if (isset($_POST["email"])) {
            if(filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
            //if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][azA-Z0-9_]+)*[.][a-zAZ]{2,4}$/', $_POST["email"])) {                  

                $encriptar = crypt(trim($_POST["password"]), '$2a$07$tawfdgyaufiusdgopfhgjxerctyuniexrcvrdtfyg$');           

                $valor = $_POST["email"];
                $respuesta = ModeloAgentes::mdlBuscarAgentes($valor);

                if (is_array($respuesta) && ($respuesta["email"] ==
                    $_POST["email"] && $respuesta["password"] == $encriptar)) {
                    
                    echo '<script>
                        fncSweetAlert("loading", "Ingresando..", "")
                        </script>';
                    
                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id_agente"] = $respuesta["id_Agente"];
                    $_SESSION["nombre"] = $respuesta["nombre"] . ' ' . $respuesta["apellido"];
                    $_SESSION["autorizacion"] = $respuesta["id_Rol"];


                    switch ($respuesta["id_Rol"]) {
                        case 1:
                            $_SESSION["titulo"] = 'Director Departamental';
                            break;
                        case 2:
                            $_SESSION["titulo"] = 'Supervisor';
                            break;   
                        case 3:
                            $_SESSION["titulo"] = 'Director';
                            break;
                        case 4:
                            $_SESSION["titulo"] = 'Administrativo';
                            break;
                    }

                    echo '<script>
                    window.location = "inicio";
                    </script>';
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'Error de credenciales. Intente nuevamente',
                            icon: 'error'
                        });
                        </script>";
                }

            }
        }
    }

    static public function ctrMostrarRolAgentes(){
        $respuesta = ModeloAgentes::mdlMostrarRolAgentes();
        return $respuesta;
    }
}

