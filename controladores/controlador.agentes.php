<?php

class ControladorAgentes{

static public function ctrMostrarAgentes(){

    $tabla = " 'Agentes', 'Roles' WHERE agentes.id_Rol = roles.id_Rol;";
    $respuesta = ModeloAgentes::mdlMostrarAgentes($tabla);
    return $respuesta;
    }
}