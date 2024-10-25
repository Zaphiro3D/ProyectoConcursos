<?php

class ControladorInstituciones{
    static public function ctrMostrarInstituciones(){
        $respuesta = ModeloInstituciones::mdlMostrarInstituciones();
        return $respuesta;
    }
}