<?php

class ControladorZonas{

    static public function ctrMostrarZonas(){
        $tabla = " 'Agentes', 'Roles' WHERE agentes.id_Rol = roles.id_Rol;";
        $respuesta = ModeloZonas::mdlMostrarZonas($tabla);
        return $respuesta;
    }
}