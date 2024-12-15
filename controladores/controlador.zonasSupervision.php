<?php

class ControladorZonas{
    static public function ctrMostrarZonas($zona,$valor){
        $respuesta = ModeloZonas::mdlMostrarZonas($zona,$valor);
        return $respuesta;
    }


    public function ctrAgregarZona()
    {
        if (isset($_POST["nombre"])) {
            
            $datos = array(
                "nombre" => htmlspecialchars($_POST["nombre"]),
                "id_Supervisor" => htmlspecialchars($_POST["id_Supervisor"]),
                "institucionesSeleccionadas" => $_POST["institucionesSeleccionadas"]
            );
            $idZona= ModeloZonas::mdlAgregarZonas($datos);

            $instituciones = explode(",", $_POST["institucionesSeleccionadas"]);

            $respuestaZonas = ModeloZonas::mdlActualizarZonaSupervision($idZona, $instituciones);

            if ($respuestaZonas == "ok") {
                $url = ControladorPlantilla::url() . "zonasSupervision";
                echo '<script>
                    fncSweetAlert(
                        "success",
                        "La zona se agregó correctamente y las instituciones fueron actualizadas.",
                        "' . $url . '"
                    );
                </script>';
            } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se pudieron asociar las instituciones a la zona.',
                        icon: 'error'
                    });
                </script>";
            }
            
        }
    }
    
    public function ctrEditarZonas()
    { 
        if (isset($_POST["id_ZonaSupervision"])) {
            $datos = array(
                "nombre" => htmlspecialchars($_POST["nombre"]),
                "id_Supervisor" => htmlspecialchars($_POST["id_Supervisor"]),
                "id_ZonaSupervision" => htmlspecialchars($_POST["id_ZonaSupervision"]),
                "institucionesSeleccionadas" => $_POST["institucionesSeleccionadas"]
            );


            
            $url = ControladorPlantilla::url() . "zonasSupervision";
            // Llamar al modelo para actualizar la zona
            $respuestaEditar = ModeloZonas::mdlEditarZonas($datos);

            // Manejar la respuesta del modelo
            if ($respuestaEditar == "ok") {
                
                $instituciones = explode(",", $_POST["institucionesSeleccionadas"]);
                // Eliminar asociaciones antiguas
                
                $respuestaEliminar = ModeloZonas::mdlEliminarZonaAsociada($datos["id_ZonaSupervision"]);

                if ($respuestaEliminar == "ok") {
                    

                    if (!empty($instituciones)) {
                        // Actualizar nuevas asociaciones
                        $respuestaActualizar = ModeloZonas::mdlActualizarZonaSupervision(
                            $datos["id_ZonaSupervision"],
                            $instituciones
                        );

                        if ($respuestaActualizar == "ok") {
                            
                            echo '<script>
                                fncSweetAlert(
                                "success",
                                "La Zona ' . htmlspecialchars($_POST["nombre"]) . ' se actualizó    correctamente.",
                                "' . $url . '"
                                );
                                </script>';
                        } else {
                            echo "<script>
                            Swal.fire({
                                title: 'Error',
                                text: 'No se pudieron actualizar las instituciones.',
                                icon: 'error'
                            });
                            </script>";
                        }
                    }
                } else {
                    echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron eliminar las asociaciones antiguas.',
                    icon: 'error'
                });
                </script>";
                }
            
            } else {
                echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'No se pudo actualizar la zona.',
                icon: 'error'
            });
                </script>";
            }
        
        }
        
    }

    public function ctrEliminarZona(){
        if (isset($_GET["id_ZonaSupervision"])){
            $url = ControladorPlantilla::url() . "zonasSupervision";
            $dato = $_GET["id_ZonaSupervision"];

            $respuesta = ModeloZonas::mdlEliminarZona($dato);
            
            if ($respuesta == "ok") {
                echo '<script>
                fncSweetAlert(
                "success", 
                "La zona se eliminó correctamente",
                "' . $url . '");
                </script>';
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo eliminar la zona.',
                    icon: 'error'
                });
                </script>";
            }
        }
    }

    public static function
    ctrObtenerInstitucionZona($idzona){
        $respuesta=ModeloZonas::mdlObtenerInstitucionZona($idzona);
        return $respuesta;
    }
}