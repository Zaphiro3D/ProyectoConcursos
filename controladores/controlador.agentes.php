<?php

class ControladorAgentes{
    static public function ctrMostrarAgentes(){
        $respuesta = ModeloAgentes::mdlMostrarAgentes();
        return $respuesta;
    }
    static public function ctrMostrarDirectores(){
        $respuesta = ModeloAgentes::mdlMostrarDirectores();
        return $respuesta;
    }
    static public function ctrMostrarSupervisores(){
        $respuesta = ModeloAgentes::mdlMostrarSupervisores();
        return $respuesta;
    }

    static public function ctrMostrarAgentes_noS(){
        $respuesta = ModeloAgentes::mdlMostrarAgentes_noS();
        return $respuesta;
    }
}

