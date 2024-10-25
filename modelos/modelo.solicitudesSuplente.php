<?php

require_once 'conexion.php';

class ModeloSolSuplente{

    static public function mdlMostrarSolSuplente()
    {
        try {
            $SolSuplente = Conexion::conectar()->prepare("SELECT * FROM `instituciones`, `agentes`, `zonassupervision` WHERE instituciones.id_Director = agentes.Id_Agente and instituciones.id_ZonaSupervison = zonassupervision.id_ZonaSupervision;");
            $SolSuplente->execute();
            return $SolSuplente->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}