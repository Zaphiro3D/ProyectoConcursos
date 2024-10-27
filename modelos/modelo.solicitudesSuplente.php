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
    static public function mdlMostrarDiasSol()
    {
        try {
            $diasSOli = Conexion::conectar()->prepare("SELECT `nombre` FROM `dias` ");
            $diasSOli->execute();
            return $diasSOli->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    static public function mdlMostrarMotivoSol()
    {
        try {
            $motivoSol = Conexion::conectar()->prepare("SELECT * FROM `motivossuplencia` ");
            $motivoSol->execute();
            return $motivoSol->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}