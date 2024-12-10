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

                // Llamar al modelo para actualizar la zona
                $respuestaEditar = ModeloZonas::mdlEditarZonas($datos);

                // Manejar la respuesta del modelo
                if ($respuestaEditar === "ok") {
                    // Eliminar asociaciones antiguas
                    $respuestaEliminar = ModeloZonas::mdlEliminarZonaSupervision($datos["id_ZonaSupervision"]);

                    if ($respuestaEliminar === "ok") {
                        $instituciones = explode(",", $_POST["institucionesSeleccionadas"]);

                        if (!empty($instituciones)) {
                            // Actualizar nuevas asociaciones
                            $respuestaActualizar = ModeloZonas::mdlActualizarZonaSupervision(
                                $datos["id_ZonaSupervision"],
                                $instituciones,
                                $datos["nombre"]
                            );

                            if ($respuestaActualizar === "ok") {
                                $url = ControladorPlantilla::url() . "zonasSupervision";
                                echo '<script>
                            fncSweetAlert(
                                "success",
                                "La Zona ' . htmlspecialchars($_POST["nombre"]) . ' se actualizó correctamente.",
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
                } elseif ($respuestaEditar === "no_changes") {
                    echo "<script>
                Swal.fire({
                    title: 'Atención',
                    text: 'No se realizaron cambios en la zona.',
                    icon: 'info'
                });
            </script>";
                } else {
                    echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo actualizar la zona.',
                    icon: 'error'
                });
            </script>";
                }
            } else {
                echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'No se encontró la zona especificada.',
                icon: 'error'
            });
        </script>";
            }
        /*if (isset($_POST["id_ZonaSupervision"])) {
            
            
            
            $datos = array(
                "nombre" => htmlspecialchars($_POST["nombre"]),
                "id_Supervisor" => htmlspecialchars($_POST["id_Supervisor"]),
                "id_ZonaSupervision"=>htmlspecialchars($_POST["id_ZonaSupervision"]),
                "institucionesSeleccionadas" => $_POST["institucionesSeleccionadas"]
            );
            //print_r($datos);

            //return;

           
            $idZona = ModeloZonas::mdlEditarZonas($datos);
            
            $instituciones = explode(",", $_POST["institucionesSeleccionadas"]);
            $respuestaEliminar= ModeloZonas::mdlEliminarZonaSupervision($idZona);
        
            if ($respuestaEliminar == "ok") {

                if(!empty($instituciones)){
                $respuestaNuevaZonas = ModeloZonas::mdlActualizarZonaSupervision($idZona, $instituciones);
                    if($respuestaNuevaZonas=="ok"){
                        $url = ControladorPlantilla::url() . "zonasSupervision";
                        echo '<script>
                            fncSweetAlert(
                            "success",
                            "La Zona ' . htmlspecialchars($_POST["nombre"]) .' se actualizó correctamente",
                            "' . $url . '"
                            );
                            </script>';
                    }else {
                        echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudieron actualizar los datos de la institución.',
                            icon: 'error'
                        });
                        </script>";
                    }
                }
            } else {
                echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'No se pudieron eliminar las zonas antiguas.',
                            icon: 'error'
                        });
                        </script>";
            } 
        
        } else {
                echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'No se encontro la zona.',
                        icon: 'error'
                    });
                    </script>";
            }
        */
    }
}