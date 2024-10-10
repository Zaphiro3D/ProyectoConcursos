<?php
//  -- controladores --
require_once 'controladores/controlador.plantilla.php';
require_once 'controladores/controlador.agentes.php';
require_once 'controladores/controlador.instituciones.php';

//  -- modelos --
require_once 'modelos/modelo.agentes.php';
require_once 'modelos/modelo.instituciones.php';

//  -- plantilla --
$plantilla = new ControladorPlantilla();
$plantilla -> ctrMostrarPlantilla();