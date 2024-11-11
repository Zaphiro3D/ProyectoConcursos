<?php

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
        if (isset($_POST["dni"])) {

            if(isset($_POST["dlInstituciones"])){
                $id = "";
            } else{
                if(isset($_POST["dlZonas"])){
                    $id = "";
                } else{
                    if (htmlspecialchars($_POST["id_Rol"]) == ""){
                        $id = "";
                    }
                }
            }
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

            //podemos volver a la página de datos

            $url = ControladorPlantilla::url() . "agentes";
            $respuesta = ModeloAgentes::mdlAgregarAgente($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se agregó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron agregar los datos del agente.',
                    icon: 'error'
                });
                </script>";
            }
        } else{ /*print_r("not post");*/ }
    }

    // ==============================================================
    // Editar Agentes
    // ==============================================================
    public function ctrEditarAgente()
    {
        if (isset($_POST["id_Agente"])) {
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

            $url = ControladorPlantilla::url() . "agentes";
            $respuesta = ModeloAgentes::mdlEditarAgente($datos);
            
            if ($respuesta == "ok") {                
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se actualizó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron actualizar los datos del agente.',
                    icon: 'error'
                });
                </script>";
            }
        } 
    }

    // ==============================================================
    // Eliminar Agentes
    // ==============================================================
    static public function ctrEliminarAgente()
    {
     
        if (isset($_GET["id_Agente_Eliminar"])) {

            $url = ControladorPlantilla::url() . "agentes";
            $dato = $_GET["id_Agente_Eliminar"];

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
        
            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][azA-Z0-9_]+)*[.][a-zAZ]{2,4}$/', $_POST["email"])) {                  

                $encriptar = crypt(trim($_POST["password"]), '$2a$07$tawfdgyaufiusdgopfhgjxerctyuniexrcvrdtfyg$');           
                // print_r($encriptar);
                // return;
                $item = "email";

                $valor = $_POST["email"];
                $respuesta = ModeloAgentes::mdlBuscarAgentes($item,$valor);
                foreach ($respuesta as $key => $value) {
                    if (is_array($value) && ($value["email"] ==
                        $_POST["email"] && $value["password"] == $encriptar)) {
                        
                        echo '<script>
                            fncSweetAlert("loading", "Ingresando..", "")
                            </script>';
                        
                        $_SESSION["iniciarSesion"] = "ok";
                        $_SESSION["id_agente"] = $value["id_agente"];
                        $_SESSION["nombre"] = $value["nombre"];

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
    }

    static public function ctrMostrorRolAgentes(){
        $respuesta = ModeloAgentes::mdlMostrarRolAgentes();
        return $respuesta;
    }
}

