<?php

class ControladorSolSuplente{

    static public function ctrMostrarSolSuplente(){
        $respuesta = ModeloSolSuplente::mdlMostrarSolSuplente();
        return $respuesta;
    }
    
    static public function ctrMostrarDiasSol(){
        $respuesta = ModeloSolSuplente::mdlMostrarDiasSol();
        return $respuesta;
    }

    static public function ctrMostrarMotivoSol(){
        $respuesta = ModeloSolSuplente::mdlMostrarMotivoSol();
        return $respuesta;
    }

    static public function ctrMostrarGradoSol(){
        $respuesta = ModeloSolSuplente::mdlMostrarGradoSol();
        return $respuesta;
    }

    static public function ctrMostrarTurnosSol(){
        $respuesta = ModeloSolSuplente::mdlMostrarTurnoSol();
        return $respuesta;
    }

    static public function ctrMostrarDivisionSol(){
        $respuesta = ModeloSolSuplente::mdlMostrarDivisionSol();
        return $respuesta;
    }
}