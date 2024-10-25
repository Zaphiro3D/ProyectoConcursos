<?php

class ControladorSolSuplente{

    static public function ctrMostrarSolSuplente(){
        $respuesta = ModeloSolSuplente::mdlMostrarSolSuplente();
        return $respuesta;
    }
}