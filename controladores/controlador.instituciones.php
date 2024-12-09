<?php

class ControladorInstituciones{
    // ==============================================================
    // Mostrar Instituciones
    // ==============================================================
    static public function ctrMostrarInstituciones($id_institucion, $valor){
        $respuesta = ModeloInstituciones::mdlMostrarInstituciones($id_institucion, $valor);
        return $respuesta;
    }

    // ==============================================================
    // Mostrar Tipos
    // ==============================================================
    static public function ctrMostrarTipos(){
        $respuesta = ModeloInstituciones::mdlMostrarTipos();
        return $respuesta;
    }

    // ==============================================================
    // Agregar Instituciones
    // ==============================================================
    public function ctrAgregarInstitucion()
    {
        if (isset($_POST["cue"])) {
            $id_dire = htmlspecialchars($_POST["director_id"]) == "" ? NULL : htmlspecialchars($_POST["director_id"]);
            $id_Zona = htmlspecialchars($_POST["zona"])  == "" ? NULL : htmlspecialchars($_POST["zona"]) ;

            $datos = array(
                "id_Tipo" => htmlspecialchars($_POST["tipo"]),
                "cue" => htmlspecialchars($_POST["cue"]),
                "numero" => htmlspecialchars($_POST["numero"]),
                "nombre" => htmlspecialchars($_POST["nombre"]),
                "id_Director" => $id_dire,
                "id_ZonaSupervision" => $id_Zona                
            );
            
            //print_r($datos);

             //return;

            //podemos volver a la página de datos

            $url = ControladorPlantilla::url() . "instituciones";
            $respuesta = ModeloInstituciones::mdlAgregarInstitucion($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "La institución ' . htmlspecialchars($_POST["nombre"]) . '- CUE: ' . intval($_POST["cue"]) . ' se agregó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron agregar los datos de la institución.',
                    icon: 'error'
                });
                </script>";
            }
        } else{ /*print_r("not post");*/ }
    }

    // ==============================================================
    // Editar Institucion
    // ==============================================================
    public function ctrEditarInstitucion()
    {
        if (isset($_POST["id_Institucion"])) {
            $id_dire = htmlspecialchars($_POST["director_id"]) == "" ? NULL : htmlspecialchars($_POST["director_id"]);
            $id_Zona = htmlspecialchars($_POST["zona"])  == "" ? NULL : htmlspecialchars($_POST["zona"]) ;

            $datos = array(
                "id_Institucion" => htmlspecialchars($_POST["id_Institucion"]),
                "id_Tipo" => htmlspecialchars($_POST["tipo"]),
                "cue" => htmlspecialchars($_POST["cue"]),
                "numero" => htmlspecialchars($_POST["numero"]),
                "nombre" => htmlspecialchars($_POST["nombre"]),
                "id_Director" => $id_dire,
                "id_ZonaSupervision" => $id_Zona   
                
            );
            //print_r($datos);

            //return;

            $url = ControladorPlantilla::url() . "instituciones";
            $respuesta = ModeloInstituciones::mdlEditarInstitucion($datos);
            
            if ($respuesta == "ok") {                
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "La institución ' . htmlspecialchars($_POST["nombre"]) . '- CUE: ' . htmlspecialchars($_POST["cue"]) . ' se actualizó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            }
            else{
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron actualizar los datos de la institución.',
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
     
        if (isset($_GET["id_eliminar"])) {

            $url = ControladorPlantilla::url() . "instituciones";
            $dato = $_GET["id_eliminar"];

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

    public static function ctrObtenerNombreInstitucion($idInstitucion) {
        $institucion = self::ctrMostrarInstituciones("id_institucion", $idInstitucion);
        if (!empty($institucion)) {
            return $institucion["tipo"] . ' N°' . $institucion["numero"] . ' ' . $institucion["institucion"] . ' CUE: ' . $institucion["cue"];
        }
        return '';
    }

    
}