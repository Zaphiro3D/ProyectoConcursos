<?php

require_once 'conexion.php';

class ModeloCargos{

    static public function mdlMostrarCargos($id_cargo, $valor)
    {
        //Si se manda un agente por parametro hace la consulta para un solo registro, sino trae todos. 
        if ($id_cargo != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT 
                c.id_Cargo, 
                nc.nombreCargo, 
                p.numeroPlaza,
                c.hsCatedra,
                g.grado, 
                d.division, 
                t.turno,
                c.nombreDocente,
                c.apellidoDocente,
                c.dniDocente,
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
                c.eliminado = 0 and c.id_cargo =:valor
            GROUP BY 
                c.id_Cargo ");
                $stmt->bindParam(":valor",  $valor, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {
            try {
                $instituciones = Conexion::conectar()->prepare("SELECT 
                c.id_Cargo, 
                nc.nombreCargo, 
                p.numeroPlaza,
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
                c.id_Cargo;");

                $instituciones->execute();
                return $instituciones->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }

    public static function mdlAgregarCargo($datos)
    {
        $conexion = Conexion::conectar();
        try {
            
            $conexion->beginTransaction();

            // Insertar en la tabla cargos
            $sqlCargos = "INSERT INTO cargos (
                id_NombreCargo, id_Grado, id_Division, id_Turno, hsCatedra, 
                apellidoDocente, nombreDocente, dniDocente, eliminado
            ) VALUES (
                :id_NombreCargo, :id_Grado, :id_Division, :id_Turno, :hsCatedra, 
                :apellidoDocente, :nombreDocente, :dniDocente, 0
            )";
                
            $stmtCargos = $conexion->prepare($sqlCargos);

            $stmtCargos->bindParam(":id_NombreCargo", $datos["id_NombreCargo"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Grado", $datos["id_Grado"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Division", $datos["id_Division"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Turno", $datos["id_Turno"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":hsCatedra", $datos["hsCatedra"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":apellidoDocente", $datos["apellidoDocente"], PDO::PARAM_STR);
            $stmtCargos->bindParam(":nombreDocente", $datos["nombreDocente"], PDO::PARAM_STR);
            $stmtCargos->bindParam(":dniDocente", $datos["dniDocente"], PDO::PARAM_INT);

            if (!$stmtCargos->execute()) {
                throw new Exception("Error al insertar en la tabla cargos.");
            }

            // Obtener el ID del cargo recién insertado
            $id_Cargo = $conexion->lastInsertId(); 

            // Insertar en la tabla plazas
            $sqlPlazas = "INSERT INTO plazas (
                numeroPlaza, id_Cargo, id_Institucion, sede
            ) VALUES (
                :numeroPlaza, :id_Cargo, :id_Institucion, :sede
            )";

            $stmtPlazas = $conexion->prepare($sqlPlazas);

            foreach ($datos["instituciones"] as $index => $institucion) {
                $numeroPlaza = $datos["numeroPlaza"] + $index; // Variable intermedia
                $stmtPlazas->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);
                $stmtPlazas->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);
                $stmtPlazas->bindParam(":id_Institucion", $institucion["id_Institucion"], PDO::PARAM_INT);
                $stmtPlazas->bindParam(":sede", $institucion["sede"], PDO::PARAM_BOOL);

                if (!$stmtPlazas->execute()) {
                    throw new Exception("Error al insertar en la tabla plazas.");
                }
            }

            $conexion->commit();
            return ["status" => "ok"];
        } catch (Exception $e) {
            $conexion->rollBack();
            return ["status" => "error", "message" => $e->getMessage()];
        } finally {
            $stmtCargos = null;
            $stmtPlazas = null;
            $conexion = null;
        }
    }

}

