<?php

require_once 'conexion.php';

class ModeloSolSuplente{

    static public function mdlMostrarSolSuplente()
    {
        try {
            $SolSuplente = Conexion::conectar()->prepare("SELECT 
            c.id_Cargo, 
            nc.nombreCargo,
            c.hsCatedra, 
            g.grado, 
            d.division,
            t.turno, 
            CONCAT(c.apellidoDocente, ', ' ,c.nombreDocente,' (', c.dniDocente, ') ') 
            as docente,tipo.tipo, GROUP_CONCAT(CONCAT(i.nombre, ' N°', i.numero, ' (CUE: ', i.cue, ')'
            ) ORDER BY p.sede DESC) AS instituciones ,ss.fechaInicio,ss.fechaFin,ms.motivo
            FROM cargos AS c 
            INNER JOIN plazas AS p ON p.id_Cargo = c.id_Cargo
            INNER JOIN instituciones AS i ON p.id_Institucion = i.id_Institucion
            LEFT JOIN grados AS g ON g.id_Grado = c.id_Grado 
            LEFT JOIN divisiones AS d ON d.id_Division = c.id_Division
            LEFT JOIN turnos AS t ON t.id_Turno = c.id_Turno
            LEFT JOIN nombres_cargos AS nc ON nc.id_NombreCargo = c.id_NombreCargo
            LEFT JOIN tipo_institucion AS tipo ON tipo.id_Tipo = i.id_Tipo
            LEFT JOIN solicitudes_suplente AS ss ON ss.id_Cargo  = c.id_Cargo
            LEFT JOIN motivos_suplencia AS ms on ms.id_MotivoSuplencia= ss.id_MotivoSuplencia
            WHERE c.eliminado = 0 GROUP BY c.id_Cargo;");
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
            $motivoSol = Conexion::conectar()->prepare("SELECT * FROM `motivos_suplencia` ");
            $motivoSol->execute();
            return $motivoSol->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}