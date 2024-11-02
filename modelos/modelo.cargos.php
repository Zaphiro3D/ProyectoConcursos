<?php

require_once 'conexion.php';

class ModeloCargos{

    static public function mdlMostrarCargos()
    {
        try {
            $cargos = Conexion::conectar()->prepare(
            "SELECT 
                c.id_Cargo, 
                nc.nombreCargo, 
                c.hsCatedra,
                g.grado, 
                d.division, 
                t.turno, 
                CONCAT(c.apellidoDocente, ', ' ,c.nombreDocente,' (', c.dniDocente, ') ') as docente,
                tipo.tipo, 
                GROUP_CONCAT(
                    CONCAT(
                        i.nombre, ' N°', i.numero, ' (CUE: ', i.cue, ')'
                    ) ORDER BY p.sede DESC
                ) AS instituciones
            FROM 
                `cargos` AS c 
                INNER JOIN `plazas` AS p ON p.id_Cargo = c.id_Cargo
                INNER JOIN `instituciones` AS i ON p.id_Institucion = i.id_Institucion
                LEFT JOIN `grados` AS g ON g.id_Grado = c.id_Grado 
                LEFT JOIN `divisiones` AS d ON d.id_Division = c.id_Division
                LEFT JOIN `turnos` AS t ON t.id_Turno = c.id_Turno
                LEFT JOIN `nombres_cargos` AS nc ON nc.id_NombreCargo = c.id_NombreCargo
                LEFT JOIN `tipo_institucion` AS tipo ON tipo.id_Tipo = i.id_Tipo
            WHERE 
                c.eliminado = 0
            GROUP BY 
                c.id_Cargo;"
            );

            $cargos->execute();
            return $cargos->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    
    
}