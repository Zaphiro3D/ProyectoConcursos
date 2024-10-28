<?php
//  -- controladores --
require_once 'controladores/controlador.plantilla.php';

require_once 'controladores/controlador.agentes.php';
require_once 'controladores/controlador.cargos.php';
require_once 'controladores/controlador.instituciones.php';
require_once 'controladores/controlador.solicitudesSuplente.php';
require_once 'controladores/controlador.zonasSupervision.php';

//  -- modelos --
require_once 'modelos/modelo.agentes.php';
require_once 'modelos/modelo.cargos.php';
require_once 'modelos/modelo.instituciones.php';
require_once 'modelos/modelo.solicitudesSuplente.php';
require_once 'modelos/modelo.zonasSupervision.php';

//  -- plantilla --
$plantilla = new ControladorPlantilla();
$plantilla -> ctrMostrarPlantilla();