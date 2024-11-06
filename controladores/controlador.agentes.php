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
    public function ctrAgregarProductos()
    {
        if (isset($_POST["nombre"])) {

            $datos = array(
                "nombre" => $_POST["nombre"],
                "stock" => $_POST["stock"],
                "precio" => $_POST["precio"],
                "id_categoria" => $_POST["categoria"]
            );

            //print_r($datos);

            //return;

            //podemos volver a la página de datos

            $url = ControladorPlantilla::url() . "productos";
            $respuesta = ModeloAgentes::mdlAgregarAgente($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "El producto se agregó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            }
        }
    }

    // ==============================================================
    // Editar Agentes
    // ==============================================================
    public function ctrEditarProducto()
    {
        if (isset($_POST["id_producto"])) {
            $datos = array(
                "nombre" => $_POST["nombre"],
                "stock" => $_POST["stock"],
                "precio" => $_POST["precio"],
                "id_categoria" => $_POST["categoria"],
                "id_producto" => $_POST["id_producto"]
            );
            $url = ControladorPlantilla::url() . "productos";

            $respuesta = ModeloAgentes::mdlEditarAgente($datos);
            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success",
                "El producto se actualizó correctamente",
                "' . $url . '"
                );
                </script>';
            }
        }
    }

    // ==============================================================
    // Eliminar Agentes
    // ==============================================================
    static public function ctrEliminarProducto()
    {
     
        if (isset($_GET["id_producto_eliminar"])) {

            $url = ControladorPlantilla::url() . "productos";
            $dato = $_GET["id_producto_eliminar"];

            $respuesta = ModeloAgentes::mdlEliminarAgente($dato);

            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert("success", "El producto se eliminó correctamente", "' . $url . '");
                </script>';
                        }
                    }
    }
}

