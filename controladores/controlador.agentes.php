<?php

class ControladorAgentes{
    // ==============================================================
    // Mostrar Agentes
    // ==============================================================
    static public function ctrMostrarAgentes(){
        $respuesta = ModeloAgentes::mdlMostrarAgentes();
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

            $url = ControladorPlantilla::url() . "agente";
            $respuesta = ModeloAgentes::mdlAgregarAgente($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "El agente ${apellido}, ${nombre} se agregó correctamente",
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
        if (isset($_POST["id_agente"])) {
            $datos = array(
                "nombre" => $_POST["nombre"],
                "stock" => $_POST["stock"],
                "precio" => $_POST["precio"],
                "id_categoria" => $_POST["categoria"],
                "id_agente" => $_POST["id_agente"]
            );
            $url = ControladorPlantilla::url() . "agentes";

            $respuesta = ModeloAgentes::mdlEditarAgente($datos);
            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success",
                "El agente ${apellido}, ${nombre} se actualizó correctamente",
                "' . $url . '"
                );
                </script>';
            }
        }
    }

    // ==============================================================
    // Eliminar Agentes
    // ==============================================================
    static public function ctrEliminarAgente()
    {
     
        if (isset($_GET["id_agente_eliminar"])) {

            $url = ControladorPlantilla::url() . "agentes";
            $dato = $_GET["id_agente_eliminar"];

            $respuesta = ModeloAgentes::mdlEliminarAgente($dato);

            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert("success", "El agente ${apellido}, ${nombre} se eliminó correctamente", "' . $url . '");
                </script>';
                        }
                    }
    }
}

