<?php

require_once 'conexion.php';

class ModeloInstituciones{

    static public function mdlMostrarInstituciones($tabla)
    {
        try {
            $instituciones = Conexion::conectar()->prepare("SELECT * FROM `instituciones`, `agentes`, `zonassupervision` WHERE instituciones.id_Director = agentes.Id_Agente and instituciones.id_ZonaSupervison = zonassupervision.id_ZonaSupervision;");
            $instituciones->execute();
            return $instituciones->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}