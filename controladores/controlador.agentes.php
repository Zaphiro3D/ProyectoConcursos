<?php

class ControladorAgentes{
    // ==============================================================
    // Mostrar Agentes
    // ==============================================================
    static public function ctrMostrarAgentes($agente, $valor){
        $respuesta = ModeloAgentes::mdlMostrarAgentes($agente, $valor);
        return $respuesta;
    }
    static public function ctrMostrarDirectores(){
        $respuesta = ModeloAgentes::mdlMostrarDirectores();
        return $respuesta;
    }
    static public function ctrMostrarSupervisores(){
        $respuesta = ModeloAgentes::mdlMostrarSupervisores();
        return $respuesta;
    }

    static public function ctrMostrarAgentes_noS(){
        $respuesta = ModeloAgentes::mdlMostrarAgentes_noS();
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
                print_r("error");
            }
        } else{ print_r("not post"); }
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
                print_r("error");
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
                "El agente ' . htmlspecialchars($_POST["apellido"]) . ', ' . htmlspecialchars($_POST["nombre"]) . ' se eliminó correctamente",
                "' . $url . '");
                </script>';
            }
        }
    }
}

