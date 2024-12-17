<?php

require_once 'conexion.php';

class ModeloCargos{

    // ==============================================================
    // Mostrar Cargo/s
    // ==============================================================
    static public function mdlMostrarCargos($id_cargo, $valor)
    {
        //Si se manda un id de cargo por parametro hace la consulta para un solo registro, sino trae todos. 
        if ($id_cargo != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT 
                c.id_Cargo,
                nc.id_NombreCargo, 
                nc.nombreCargo, 
                p.numeroPlaza,
                c.hsCatedra,
                c.id_Grado,
                c.id_Turno,
                c.id_Division,
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
                    ) ORDER BY p.sede DESC, p.numeroPlaza ASC
                ) AS instituciones,
                GROUP_CONCAT(
                        i.id_Institucion
                ) AS id_instituciones
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
                    ) ORDER BY p.sede DESC, p.numeroPlaza ASC
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

    // ==============================================================
    // Agregar Cargo
    // ==============================================================
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

    // ==============================================================
    // Editar Cargo
    // ==============================================================

    public static function mdlEditarCargo($datos)
    {
        $conexion = Conexion::conectar();
        try {
            $conexion->beginTransaction();

            // Actualizar en la tabla cargos
            $sqlCargos = "UPDATE cargos SET 
                id_NombreCargo = :id_NombreCargo,
                id_Grado = :id_Grado,
                id_Division = :id_Division,
                id_Turno = :id_Turno,
                hsCatedra = :hsCatedra,
                apellidoDocente = :apellidoDocente,
                nombreDocente = :nombreDocente,
                dniDocente = :dniDocente
            WHERE id_Cargo = :id_Cargo";

            $stmtCargos = $conexion->prepare($sqlCargos);
            $stmtCargos->bindParam(":id_NombreCargo", $datos["id_NombreCargo"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Grado", $datos["id_Grado"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Division", $datos["id_Division"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Turno", $datos["id_Turno"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":hsCatedra", $datos["hsCatedra"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":apellidoDocente", $datos["apellidoDocente"], PDO::PARAM_STR);
            $stmtCargos->bindParam(":nombreDocente", $datos["nombreDocente"], PDO::PARAM_STR);
            $stmtCargos->bindParam(":dniDocente", $datos["dniDocente"], PDO::PARAM_INT);
            $stmtCargos->bindParam(":id_Cargo", $datos["id_Cargo"], PDO::PARAM_INT);

            if (!$stmtCargos->execute()) {
                throw new Exception("Error al actualizar la tabla cargos.");
            }

            // Obtener plazas existentes en la base de datos
            $sqlPlazasExistentes = "SELECT numeroPlaza, id_Institucion FROM plazas WHERE id_Cargo = :id_Cargo";
            $stmtPlazasExistentes = $conexion->prepare($sqlPlazasExistentes);
            $stmtPlazasExistentes->bindParam(":id_Cargo", $datos["id_Cargo"], PDO::PARAM_INT);
            $stmtPlazasExistentes->execute();
            $plazasExistentes = $stmtPlazasExistentes->fetchAll(PDO::FETCH_ASSOC);

            // Convertir las plazas existentes en un formato fácil de comparar
            $plazasExistentesMap = [];
            foreach ($plazasExistentes as $plaza) {
                $plazasExistentesMap[$plaza["numeroPlaza"]] = $plaza["id_Institucion"];
            }

            // Preparar para insertar nuevas plazas
            $sqlInsertPlaza = "INSERT INTO plazas (numeroPlaza, id_Cargo, id_Institucion, sede) 
                            VALUES (:numeroPlaza, :id_Cargo, :id_Institucion, :sede)";
            $stmtInsertPlaza = $conexion->prepare($sqlInsertPlaza);

            // Preparar para eliminar plazas
            $sqlDeletePlaza = "DELETE FROM plazas WHERE numeroPlaza = :numeroPlaza AND id_Cargo = :id_Cargo";
            $stmtDeletePlaza = $conexion->prepare($sqlDeletePlaza);

            // Procesar las plazas nuevas
            foreach ($datos["instituciones"] as $index => $institucion) {
                $numeroPlaza = $datos["numeroPlaza"] + $index;

                if (isset($plazasExistentesMap[$numeroPlaza])) {
                    if ($plazasExistentesMap[$numeroPlaza] === $institucion["id_Institucion"]) {
                        // No hay cambios, continuamos
                        unset($plazasExistentesMap[$numeroPlaza]);
                        continue;
                    } else {
                        // Actualizar la plaza si solo cambió la institución
                        $sqlUpdatePlaza = "UPDATE plazas SET id_Institucion = :id_Institucion, sede = :sede 
                                        WHERE numeroPlaza = :numeroPlaza AND id_Cargo = :id_Cargo";
                        $stmtUpdatePlaza = $conexion->prepare($sqlUpdatePlaza);
                        $stmtUpdatePlaza->bindParam(":id_Institucion", $institucion["id_Institucion"], PDO::PARAM_INT);
                        $stmtUpdatePlaza->bindParam(":sede", $institucion["sede"], PDO::PARAM_BOOL);
                        $stmtUpdatePlaza->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);
                        $stmtUpdatePlaza->bindParam(":id_Cargo", $datos["id_Cargo"], PDO::PARAM_INT);

                        if (!$stmtUpdatePlaza->execute()) {
                            throw new Exception("Error al actualizar la plaza con número $numeroPlaza.");
                        }
                        unset($plazasExistentesMap[$numeroPlaza]);
                        continue;
                    }
                }

                // Insertar nueva plaza
                $stmtInsertPlaza->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);
                $stmtInsertPlaza->bindParam(":id_Cargo", $datos["id_Cargo"], PDO::PARAM_INT);
                $stmtInsertPlaza->bindParam(":id_Institucion", $institucion["id_Institucion"], PDO::PARAM_INT);
                $stmtInsertPlaza->bindParam(":sede", $institucion["sede"], PDO::PARAM_BOOL);

                if (!$stmtInsertPlaza->execute()) {
                    throw new Exception("Error al insertar la plaza con número $numeroPlaza.");
                }
            }

            // Eliminar plazas restantes
            foreach (array_keys($plazasExistentesMap) as $numeroPlaza) {
                $stmtDeletePlaza->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);
                $stmtDeletePlaza->bindParam(":id_Cargo", $datos["id_Cargo"], PDO::PARAM_INT);
                $stmtDeletePlaza->execute();
            }


            // Confirmamos los cambios
            $conexion->commit();
            return ["status" => "ok"];
        } catch (Exception $e) {
            $conexion->rollBack();
            echo "Error: " . $e->getMessage();
            return ["status" => "error", "message" => $e->getMessage()];
        } finally {
            $stmtCargos = null;
            $stmtPlazasExistentes = null;
            $stmtInsertPlaza = null;
            $stmtDeletePlaza = null;
            $conexion = null;
        }
    }

    // ==============================================================
    // Eliminar Cargo
    // ==============================================================
    static public function mdlEliminarCargo($datos)
    {
        try {
            $elim = 1;
            $stmt = Conexion::conectar()->prepare("UPDATE cargos 
            SET eliminado = :eliminado where id_Cargo = :id_Cargo");
            
            $stmt->bindParam(":id_Cargo", $datos, PDO::PARAM_INT);
            $stmt->bindParam(":eliminado", $elim , PDO::PARAM_INT);
            
            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // ==============================================================
    // Para control de plaza única
    // ==============================================================
    public function mdlPlazaUnica($plaza, $condicConsulta)
    {
        try{
            $stmt= Conexion::conectar()->prepare("SELECT COUNT(*) as total FROM plazas WHERE numeroPlaza = :numeroPlaza ". $condicConsulta);
            $stmt->bindParam(':numeroPlaza', $plaza, PDO::PARAM_STR);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

            return $resultado['total'] == 0;
        }catch(Exception $e){
            return "Error:" . $e ->getMessage();
        }
    }



}

