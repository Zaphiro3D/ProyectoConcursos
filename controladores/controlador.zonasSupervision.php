<?php

class ControladorZonas{

    static public function ctrMostrarZonas(){
        $respuesta = ModeloZonas::mdlMostrarZonas();
        return $respuesta;
    }
}