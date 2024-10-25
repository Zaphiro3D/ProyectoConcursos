<?php

require_once 'conexion.php';

class ModeloZonas{

    static public function mdlMostrarZonas()
    {
        try {
            $Zonas = Conexion::conectar()->prepare("SELECT z.nombre as zona, a.apellido, a.nombre, a.dni, a.telefono FROM `agentes` as a inner join `zonassupervision` as z ON z.id_Supervisor = a.id_Agente;");
            $Zonas->execute();
            return $Zonas->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}