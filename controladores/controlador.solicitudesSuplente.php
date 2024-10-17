<?php

class ControladorSolSuplente{

    static public function ctrMostrarSolSuplente(){
        $tabla = " 'Agentes', 'Roles' WHERE agentes.id_Rol = roles.id_Rol;";
        $respuesta = ModeloSolSuplente::mdlMostrarSolSuplente($tabla);
        return $respuesta;
    }
}