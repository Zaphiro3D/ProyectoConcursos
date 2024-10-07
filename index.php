<?php
//  -- controladores --
require_once 'controladores/controlador.plantilla.php';
require_once 'controladores/controlador.agentes.php';

//  -- modelos --
require_once 'modelos/modelo.agentes.php';

//  -- plantilla --
$plantilla = new ControladorPlantilla();
$plantilla -> ctrMostrarPlantilla();