<?php

class ControladorCargos{
    static public function ctrMostrarCargos($id_cargo, $valor){
        $respuesta = ModeloCargos::mdlMostrarCargos($id_cargo,$valor);
        return $respuesta;
    }

    public function ctrAgregarCargo()
    {
        if (isset($_POST["id_NombreCargo"])) {

           
            $datos = array(
                
                "id_NombreCargo"=> intval($_POST["id_NombreCargo"]),
                "id_Grado"=> intval($_POST["id_Grado"]),
                "id_Division"=> intval($_POST["id_Division"]),
                "id_Turno" => intval($_POST["id_Turno"]),
                "hsCatedra"=> intval($_POST["hsCatedra"]),
                "apellidoDocente" => htmlspecialchars($_POST["apellidoDocente"]),
                "nombreDocente"=> htmlspecialchars($_POST["nombreDocente"]),
                "dniDocente"=> intval($_POST["dniDocente"])
                            

            );
            //podemos volver a la página de datos

            $url = ControladorPlantilla::url() . "cargos";
            $respuesta = ModeloCargos::mdlAgregarCargos($datos);

            if ($respuesta[1] == "ok") {
                 
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "El cargo para ' . htmlspecialchars($_POST["apellidoDocente"]) . ', ' . htmlspecialchars($_POST["nombreDocente"]) . ' se agregó correctamente",
                    "' . $url . '"
                    );
                    </script>';
                    
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron agregar los datos del cargo.',
                    icon: 'error'
                });
                </script>";
            }
        } else { /*print_r("not post");*/
        }
    }

    public function ctrAgregarNumPla()
    {
        if (isset($_POST["numeroPlaza"])) {

            
           

            $datos = array(

                "numeroPlaza" => intval($_POST["numeroPlaza"]),
                "id_Cargo" => intval($_POST["id_Cargo"]),
                "id_Institucion" => intval($_POST["id_Institucion"]),
                "Sede" => intval($_POST["Sede"]),
                


            );
            //podemos volver a la página de datos

            $url = ControladorPlantilla::url() . "cargos";
            $respuesta = ModeloCargos::mdlAgregarNumPla($datos);

            if ($respuesta == "ok") {
                echo '<script>
                    fncSweetAlert(
                    "success",
                    "se agregó correctamente",
                    "' . $url . '"
                    );
                    </script>';
            } else {
                echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudieron agregar ',
                    icon: 'error'
                });
                </script>";
            }
        } else { /*print_r("not post");*/
        }
    }
}