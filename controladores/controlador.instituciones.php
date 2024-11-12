<?php

class ControladorInstituciones{
    // ==============================================================
    // Mostrar Instituciones
    // ==============================================================
    static public function ctrMostrarInstituciones(){
        $respuesta = ModeloInstituciones::mdlMostrarInstituciones();
        return $respuesta;
    }

    // ==============================================================
    // Agregar Instituciones
    // ==============================================================
    public function ctrAgregarInstitucion()
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

            $url = ControladorPlantilla::url() . "instituciones";
            $respuesta = ModeloInstituciones::mdlAgregarInstitucion($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "La institución ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se agregó correctamente",
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
    // Eliminar Institucion
    // ==============================================================
    static public function ctrEliminarInstitucion()
    {
     
        if (isset($_GET["id_Institucion_Eliminar"])) {

            $url = ControladorPlantilla::url() . "instituciones";
            $dato = $_GET["id_Institucion_Eliminar"];

            $respuesta = ModeloInstituciones::mdlEliminarInstitucion($dato);

            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success", 
                "La institución se eliminó correctamente",
                "' . $url . '");
                </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo eliminar la institución.',
                    icon: 'error'
                });
                </script>";
            }
        }
    }

    
}