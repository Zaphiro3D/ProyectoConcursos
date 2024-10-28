<?php

require_once 'conexion.php';

class ModeloCargos{

    static public function mdlMostrarCargos()
    {
        try {
            $cargos = Conexion::conectar()->prepare("SELECT c.id_Cargo, nc.nombreCargo, c.hsCatedra,g.grado, d.division, t.turno, 
                c.apellidoDocente, c.nombreDocente, c.dniDocente, tipo.tipo, i.numero, i.nombre as nombreInsti, i.cue 
                FROM 
                `cargos` as c 
                INNER JOIN `plazas` as p
                ON p.id_Cargo = c.id_Cargo
                INNER JOIN `instituciones` as i
                ON p.id_Institucion = i.id_Institucion
                LEFT JOIN `grados` as g
                ON g.id_Grado = c.id_Grado 
                LEFT JOIN `divisiones` as d 
                ON d.id_Division = c.id_Division
                LEFT JOIN `turnos` as t
                ON t.id_Turno = c.id_Turno
                LEFT JOIN `nombres_cargos` as nc 
                ON nc.id_NombreCargo = c.id_NombreCargo
                LEFT JOIN `tipo_institucion` as tipo 
                ON tipo.id_Tipo = i.id_Tipo
                Where c.id_Cargo = p.id_Cargo and c.eliminado = 0;
                ");
            $cargos->execute();
            return $cargos->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}