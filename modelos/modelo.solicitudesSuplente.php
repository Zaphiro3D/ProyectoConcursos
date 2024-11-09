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
                ss.id_EstadoSol,
                es.estado,
                CONCAT(c.apellidoDocente, ', ' ,c.nombreDocente,' (', c.dniDocente, ') ') AS docente,
                tipo.tipo, 
                GROUP_CONCAT(
                    DISTINCT CONCAT(
                        i.nombre, ' N°', i.numero, ' (CUE: ', i.cue, ')'
                    ) ORDER BY p.sede DESC
                ) AS instituciones,
                ss.fechaInicio,
                ss.fechaFin,
                ss.observaciones,
                ms.motivo,
                GROUP_CONCAT(
                    CONCAT('Esc. N°', i.numero, ': ',
                        (SELECT 
                            GROUP_CONCAT(
                                CONCAT(dias.nombre, ' de ', TIME_FORMAT(j.horaInicio, '%H:%i'), ' a ', TIME_FORMAT(j.horaFin, '%H:%i'))
                                ORDER BY dias.id_Dia ASC
                                SEPARATOR ', '
                            )
                        FROM jornadas AS j
                        INNER JOIN hs_semanal AS hs ON j.id_Jornada = hs.id_Jornada
                        INNER JOIN dias ON dias.id_Dia = j.id_Dia
                        WHERE hs.numeroPlaza = p.numeroPlaza
                        order by id_hs_semanal desc
                        )
                    ) ORDER BY p.sede DESC, i.numero ASC
                    SEPARATOR ' | '
                ) AS horarios
            FROM cargos AS c 
            INNER JOIN plazas AS p ON p.id_Cargo = c.id_Cargo
            INNER JOIN instituciones AS i ON p.id_Institucion = i.id_Institucion
            LEFT JOIN grados AS g ON g.id_Grado = c.id_Grado 
            LEFT JOIN divisiones AS d ON d.id_Division = c.id_Division
            LEFT JOIN turnos AS t ON t.id_Turno = c.id_Turno
            LEFT JOIN nombres_cargos AS nc ON nc.id_NombreCargo = c.id_NombreCargo
            LEFT JOIN tipo_institucion AS tipo ON tipo.id_Tipo = i.id_Tipo
            LEFT JOIN solicitudes_suplente AS ss ON ss.id_Cargo = c.id_Cargo
            LEFT JOIN motivos_suplencia AS ms ON ms.id_MotivoSuplencia = ss.id_MotivoSuplencia
            LEFT JOIN estados_solicitud AS es ON es.id_EstadoSol = ss.id_EstadoSol
            WHERE c.eliminado = 0 
            GROUP BY c.id_Cargo;
            ");
            
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

    static public function mdlMostrarGradoSol()
    {
        try {
            $gradoSol = Conexion::conectar()->prepare("SELECT * FROM grados as g  ;");
            $gradoSol->execute();
            return $gradoSol->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
    static public function mdlMostrarTurnoSol()
    {
        try {
            $TurnoSol = Conexion::conectar()->prepare("SELECT * FROM Turnos as t  ;");
            $TurnoSol->execute();
            return $TurnoSol->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    static public function mdlMostrarDivisionSol()
    {
        try {
            $DivisionSol = Conexion::conectar()->prepare("SELECT * FROM Divisiones as d  ;");
            $DivisionSol->execute();
            return $DivisionSol->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
}

