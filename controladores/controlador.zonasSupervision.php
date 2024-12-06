<?php

class ControladorZonas{
    static public function ctrMostrarZonas($zona,$valor){
        $respuesta = ModeloZonas::mdlMostrarZonas($zona,$valor);
        return $respuesta;
    }

    public function ctrAgregarZona()
    {
        if (!empty($_POST["nombre"]) && !empty($_POST["id_Supervisor"])) {

        $datos = array(
            "nombre" => htmlspecialchars($_POST["nombre"]),
            "id_Supervisor" => intval($_POST["id_Supervisor"]),
            
        );
       

        $url = ControladorPlantilla::url() . "zonasSupervision";
        $respuesta = ModeloZonas::mdlAgregarZonas($datos);
        
        if ($respuesta == "ok") {

            // Obtener el último id_Profesor registrado
            $idZona = Conexion::conectar()->query("SELECT MAX(id_ZonaSupervision) AS id FROM zonas_supervision")->fetch(PDO::FETCH_ASSOC)['id'];
            

            // Insertar las especialidades seleccionadas
            $instituciones = explode(",", $_POST["institucionesSeleccionadas"]);
            foreach ($instituciones as $idIsnti) {
                print_r("Id zona: " . $idZona);
                print_r("Id insti: " . $idIsnti);
            }

            if (!empty($instituciones)) {
                $respuestaInti = ModeloZonas::mdlActualizarZonaSupervision($idZona,$instituciones);

                if ($respuestaInti == "ok") {
                    echo '<script>
                        fncSweetAlert(
                        "success",
                        "La Zona ' .  htmlspecialchars($_POST["nombre"]) . ' y sus instituciones se agregaron correctamente",
                        "' . $url . '"
                        );
                        </script>';
                } else {
                    echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudo agregar la zona.',
                            icon: 'error'
                        });
                        </script>";
                }
            }
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron agregar los datos del profesor.',
                    icon: 'error'
                });
                </script>";
            }


            
        } else { //print_r("not post");
        }
    }

    public function ctrEditarZonas()
    {
        if (isset($_POST["id_ZonaSupervision"])) {
            
            $datos = array(
                "nombre" => htmlspecialchars($_POST["nombre"]),
                "id_Supervisor" => htmlspecialchars($_POST["id_Supervisor"]),
                "id_ZonaSupervision"=>htmlspecialchars($_POST["id_ZonaSupervision"])
            );
            //print_r($datos);

            //return;

            $url = ControladorPlantilla::url() . "zonasSupervision";
            $respuesta = ModeloZonas::mdlEditarZonas($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "La Zona ' . htmlspecialchars($_POST["nombre"]) .' se actualizó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            } else {
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
}