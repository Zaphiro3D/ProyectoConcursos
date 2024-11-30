<?php

class ControladorSolSuplente{

    static public function ctrMostrarSolSuplente(){
        $respuesta = ModeloSolSuplente::mdlMostrarSolSuplente();
        return $respuesta;
    }
    
    static public function ctrMostrarDatosSol($tabla, $columnas, $condicion){
        $respuesta = ModeloSolSuplente::mdlMostrarDatosSol($tabla,$columnas,$condicion);
        return $respuesta;
    }
}