<?php

class ControladorCargos{
    static public function ctrMostrarCargos(){
        $respuesta = ModeloCargos::mdlMostrarCargos();
        return $respuesta;
    }
}