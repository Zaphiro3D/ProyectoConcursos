<?php

class ControladorAgentes{

static public function ctrMostrarAgentes(){

    $tabla = "Agentes";
    $respuesta = ModeloAgentes::mdlMostrarAgentes($tabla);
    return $respuesta;
    }
}