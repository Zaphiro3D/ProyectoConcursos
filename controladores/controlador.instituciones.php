<?php

class ControladorInstituciones{

static public function ctrMostrarInstituciones(){

    $tabla = " 'Agentes', 'Roles' WHERE agentes.id_Rol = roles.id_Rol;";
    $respuesta = ModeloInstituciones::mdlMostrarInstituciones($tabla);
    return $respuesta;
    }
}