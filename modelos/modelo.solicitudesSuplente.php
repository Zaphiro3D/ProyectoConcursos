<?php

require_once 'conexion.php';

class ModeloSolSuplente{

    // ==============================================================
    // Mostrar Solicitudes
    // ==============================================================
    static public function mdlMostrarSolSuplente($id_solic,$valor)
    {
        // var_dump($valor); die();
        if ($valor != null) {
            try {
                $SolSuplente = Conexion::conectar()->prepare("SELECT 
                    c.id_Cargo, 
                    nc.id_NombreCargo, 
                    nc.nombreCargo,
                    c.hsCatedra, 
                    c.id_Grado,
                    c.id_Turno,
                    c.id_Division,
                    g.grado, 
                    d.division,
                    t.turno,
                    es.estado,
                    c.nombreDocente,
                    c.apellidoDocente,
                    c.dniDocente,
                    tipo.tipo, 
                    GROUP_CONCAT(
                        DISTINCT CONCAT(
                            i.nombre, ' N°', i.numero, ' (CUE: ', i.cue, ')'
                        ) ORDER BY p.sede DESC
                    ) AS instituciones,
                    GROUP_CONCAT(
                        DISTINCT i.id_Institucion
                    ) AS id_instituciones,
                    ss.fechaInicio,
                    ss.fechaFin,
                    ss.observaciones,
                    ss.id_SolSuplente,
                    ss.numeroTramite, 
                    ss.id_EstadoSol,
                    ss.id_MotivoSuplencia,
                    ms.motivo,
                    p.numeroPlaza,
                    (
                        SELECT GROUP_CONCAT(
                            CONCAT(
                                dias.nombre, ' de ', 
                                TIME_FORMAT(j.horaInicio, '%H:%i'), ' a ', 
                                TIME_FORMAT(j.horaFin, '%H:%i')
                            ) ORDER BY j.id_Dia ASC, j.horaInicio ASC
                            SEPARATOR ', '
                        )
                        FROM hs_semanal AS hs
                        INNER JOIN jornadas AS j ON j.id_Jornada = hs.id_Jornada
                        INNER JOIN dias ON j.id_Dia = dias.id_Dia
                        WHERE hs.numeroPlaza = p.numeroPlaza
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
                AND ss.id_EstadoSol <> 8 
                AND ss.id_SolSuplente =:valor
                GROUP BY c.id_Cargo;
                ");
                
                $SolSuplente->bindParam(":valor",  $valor, PDO::PARAM_INT);
                $SolSuplente->execute();
                return $SolSuplente->fetch(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
                return "Error: " .$e ->getMessage();
            }
        } else {
            try {
                $SolSuplente = Conexion::conectar()->prepare("SELECT 
                    c.id_Cargo, 
                    nc.nombreCargo,
                    c.hsCatedra, 
                    g.grado, 
                    d.division,
                    t.turno,ss.numeroTramite, 
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
                    ss.id_SolSuplente,
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
                WHERE c.eliminado = 0 and ss.id_EstadoSol <> 8
                GROUP BY c.id_Cargo;
                ");
                
                $SolSuplente->execute();
                return $SolSuplente->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
                return "Error: " .$e ->getMessage();
            }
        }

    }

    // ==================================================================
    // Mostrar datos necesarios para los select de solicitud de suplente
    // ==================================================================
    static public function mdlMostrarDatosSol($tabla, $columnas = "*", $condicion = "")
    {
        try {
            $conexion = Conexion::conectar();
            $query = "SELECT $columnas FROM `$tabla` $condicion";
            $stmt = $conexion->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // ==============================================================
    // Agregar Solicitud de Suplente
    // ==============================================================
    public static function mdlAgregarSolicitud($datos)
    {
        // var_dump($datos); die();

        $conexion = Conexion::conectar();
        try {
            
            $conexion->beginTransaction();

            // 1. Verificar si el id_Cargo existe en la tabla plazas
            $sqlCheckCargo = "SELECT id_Cargo FROM plazas WHERE numeroPlaza = :numeroPlaza";
            $stmtCheckCargo = $conexion->prepare($sqlCheckCargo);
            $stmtCheckCargo->bindParam(":numeroPlaza", $datos["numeroPlaza"], PDO::PARAM_INT);
            $stmtCheckCargo->execute();
            $numeroPlaza = $datos["numeroPlaza"];
            $observacionesExtra = "";

            if ($stmtCheckCargo->rowCount() > 0) {
                $resultado = $stmtCheckCargo->fetchAll(PDO::FETCH_ASSOC);
                // Si existe, actualizar el registro en la tabla cargos
                $id_Cargo = $resultado[0]["id_Cargo"];
                // var_dump($id_Cargo); die();

                $sqlUpdateCargo = "UPDATE cargos SET 
                    nombreDocente = :nombreDocente, 
                    apellidoDocente = :apellidoDocente, 
                    dniDocente = :dniDocente 
                WHERE id_Cargo = :id_Cargo";

                $stmtUpdateCargo = $conexion->prepare($sqlUpdateCargo);
                $stmtUpdateCargo->bindParam(":nombreDocente", $datos["nombreDocente"], PDO::PARAM_STR);
                $stmtUpdateCargo->bindParam(":apellidoDocente", $datos["apellidoDocente"], PDO::PARAM_STR);
                $stmtUpdateCargo->bindParam(":dniDocente", $datos["dniDocente"], PDO::PARAM_INT);
                $stmtUpdateCargo->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);
                
                if (!$stmtUpdateCargo->execute()) {
                    throw new Exception("Error al actualizar el cargo existente.");
                }
            } else {
                // Si no existe, insertar en la tabla cargos
                $sqlInsertCargo = "INSERT INTO cargos (
                    id_NombreCargo, id_Grado, id_Division, id_Turno, hsCatedra, 
                    apellidoDocente, nombreDocente, dniDocente, eliminado
                ) VALUES (
                    :id_NombreCargo, :id_Grado, :id_Division, :id_Turno, :hsCatedra, 
                    :apellidoDocente, :nombreDocente, :dniDocente, 0
                )";

                $observacionesExtra = "Pendiente de aprobación: Cargo inexistente.";
                $stmtInsertCargo = $conexion->prepare($sqlInsertCargo);
                $stmtInsertCargo->bindParam(":id_NombreCargo", $datos["id_NombreCargo"], PDO::PARAM_INT);
                $stmtInsertCargo->bindParam(":id_Grado", $datos["id_Grado"], PDO::PARAM_INT);
                $stmtInsertCargo->bindParam(":id_Division", $datos["id_Division"], PDO::PARAM_INT);
                $stmtInsertCargo->bindParam(":id_Turno", $datos["id_Turno"], PDO::PARAM_INT);
                $stmtInsertCargo->bindParam(":hsCatedra", $datos["hsCatedra"], PDO::PARAM_INT);
                $stmtInsertCargo->bindParam(":nombreDocente", $datos["nombreDocente"], PDO::PARAM_STR);
                $stmtInsertCargo->bindParam(":apellidoDocente", $datos["apellidoDocente"], PDO::PARAM_STR);
                $stmtInsertCargo->bindParam(":dniDocente", $datos["dniDocente"], PDO::PARAM_INT);

                if (!$stmtInsertCargo->execute()) {
                    throw new Exception("Error al insertar el nuevo cargo.");
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
                    $numeroPlaza = $datos["numeroPlaza"] + $index;
                    
                    $stmtPlazas->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);
                    $stmtPlazas->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);
                    $stmtPlazas->bindParam(":id_Institucion", $institucion["id_Institucion"], PDO::PARAM_INT);
                    $stmtPlazas->bindParam(":sede", $institucion["sede"], PDO::PARAM_BOOL);
                    
                    if (!$stmtPlazas->execute()) {
                        throw new Exception("Error al insertar en la tabla plazas.");
                    }
                    
                }
            }

            // 2. Insertar en la tabla jornadas
            foreach ($datos["instituciones"] as $index => $institucion) {
                
                $sqlJornadas = "INSERT INTO jornadas (
                    id_Dia, horaInicio, horaFin
                ) VALUES (
                    :id_Dia, :horaInicio, :horaFin
                )";

                $stmtJornadas = $conexion->prepare($sqlJornadas);

                foreach ($institucion["dias"] as $k => $jornada) {
                    
                    if($k > 0){  
                        $stmtJornadas->bindParam(":id_Dia", $jornada["dia"], PDO::PARAM_INT);
                        $stmtJornadas->bindParam(":horaInicio", $jornada["horaInicio"], PDO::PARAM_STR);
                        $stmtJornadas->bindParam(":horaFin", $jornada["horaFin"], PDO::PARAM_STR);

                        if (!$stmtJornadas->execute()) {
                            throw new Exception("Error al insertar en la tabla jornadas.");
                        }

                        // Obtener el ID de la jornada recién insertada
                        $id_Jornada = $conexion->lastInsertId();

                        // Insertar en la tabla hs_semanal
                        $sqlHsSemanal = "INSERT INTO hs_semanal (
                            id_Jornada, numeroPlaza
                        ) VALUES (
                            :id_Jornada, :numeroPlaza
                        )";

                        $stmtHsSemanal = $conexion->prepare($sqlHsSemanal);
                        $stmtHsSemanal->bindParam(":id_Jornada", $id_Jornada, PDO::PARAM_INT);
                        $stmtHsSemanal->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);

                        if (!$stmtHsSemanal->execute()) {
                            throw new Exception("Error al insertar en la tabla hs_semanal.");
                        }
                    }
                }
                
            }
            

            // 3. Insertar en la tabla solicitudes
            $estado = $datos["estado"];

            $sqlSolicitud = "INSERT INTO solicitudes_suplente (
                numeroTramite, fechaInicio, fechaFin, id_MotivoSuplencia,
                observaciones, id_Cargo, id_EstadoSol
            ) VALUES (
                :numeroTramite, :fechaInicio, :fechaFin, :id_MotivoSuplencia, 
                :observaciones, :id_Cargo, :id_EstadoSol
            )";
            
            // var_dump($datos); die;
            $observaciones = $datos["observaciones"] . $observacionesExtra;
            $stmtSolicitud = $conexion->prepare($sqlSolicitud);
            $stmtSolicitud->bindParam(":numeroTramite", $datos["numeroTramite"], PDO::PARAM_INT);
            $stmtSolicitud->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
            $stmtSolicitud->bindParam(":fechaFin", $datos["fechaFin"], PDO::PARAM_STR);
            $stmtSolicitud->bindParam(":id_MotivoSuplencia", $datos["id_Motivo"], PDO::PARAM_INT);
            $stmtSolicitud->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);
            $stmtSolicitud->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);
            $stmtSolicitud->bindParam(":id_EstadoSol", $estado, PDO::PARAM_INT);
            

            if (!$stmtSolicitud->execute()) {
                throw new Exception("Error al insertar en la tabla solicitudes.");
            }

            $conexion->commit();
            return ["status" => "ok"];
        } catch (Exception $e) {
            $conexion->rollBack();
            return ["status" => "error", "message" => $e->getMessage()];
        } finally {
            $stmtCheckCargo = null;
            $stmtUpdateCargo = null;
            $stmtInsertCargo = null;
            $stmtJornadas = null;
            $stmtPlazas = null;
            $stmtSolicitud = null;
            $conexion = null;
        }
    }

    // ==============================================================
    // Editar Solicitud de Suplente
    // ==============================================================
    public static function mdlEditarSolicitud($datos)
    {
        $conexion = Conexion::conectar();
        try {
            $conexion->beginTransaction();
            // var_dump($datos);
            // var_dump($datos ['instituciones']); die();

            // 1. Verificar si el id_Cargo existe en la tabla plazas
            $sqlCheckCargo = "SELECT id_Cargo FROM plazas WHERE numeroPlaza = :numeroPlaza";
            $stmtCheckCargo = $conexion->prepare($sqlCheckCargo);
            $stmtCheckCargo->bindParam(":numeroPlaza", $datos["numeroPlaza"], PDO::PARAM_INT);
            $stmtCheckCargo->execute();
            $numeroPlaza = $datos["numeroPlaza"];
            $observacionesExtra = "";

            if ($stmtCheckCargo->rowCount() > 0) {
                $resultado = $stmtCheckCargo->fetchAll(PDO::FETCH_ASSOC);
                // Si existe, actualizar el registro en la tabla cargos
                $id_Cargo = $resultado[0]["id_Cargo"];

                $sqlUpdateCargo = "UPDATE cargos SET 
                    nombreDocente = :nombreDocente, 
                    apellidoDocente = :apellidoDocente, 
                    dniDocente = :dniDocente 
                WHERE id_Cargo = :id_Cargo";

                $stmtUpdateCargo = $conexion->prepare($sqlUpdateCargo);
                $stmtUpdateCargo->bindParam(":nombreDocente", $datos["nombreDocente"], PDO::PARAM_STR);
                $stmtUpdateCargo->bindParam(":apellidoDocente", $datos["apellidoDocente"], PDO::PARAM_STR);
                $stmtUpdateCargo->bindParam(":dniDocente", $datos["dniDocente"], PDO::PARAM_INT);
                $stmtUpdateCargo->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);

                if (!$stmtUpdateCargo->execute()) {
                    throw new Exception("Error al actualizar el cargo existente.");
                }
            }

            // 2. Obtener las jornadas existentes
            $sqlJornadasExistentes = "SELECT id_Jornada, id_Dia, horaInicio, horaFin 
                                    FROM jornadas 
                                    WHERE id_Jornada IN (
                                        SELECT id_Jornada FROM hs_semanal WHERE numeroPlaza = :numeroPlaza
                                    )";
            $stmtJornadasExistentes = $conexion->prepare($sqlJornadasExistentes);
            $stmtJornadasExistentes->bindParam(":numeroPlaza", $datos["numeroPlaza"], PDO::PARAM_INT);
            $stmtJornadasExistentes->execute();
            $jornadasExistentes = $stmtJornadasExistentes->fetchAll(PDO::FETCH_ASSOC);

            // Mapear jornadas existentes
            $jornadasExistentesMap = [];
            foreach ($jornadasExistentes as $jornada) {
                $jornadasExistentesMap[$jornada["id_Jornada"]] = $jornada;
            }

            // Preparar consultas
            $sqlInsertJornada = "INSERT INTO jornadas (id_Dia, horaInicio, horaFin) 
                                VALUES (:id_Dia, :horaInicio, :horaFin)";
            $stmtInsertJornada = $conexion->prepare($sqlInsertJornada);

            $sqlUpdateJornada = "UPDATE jornadas SET id_Dia = :id_Dia, horaInicio = :horaInicio, horaFin = :horaFin 
                                WHERE id_Jornada = :id_Jornada";
            $stmtUpdateJornada = $conexion->prepare($sqlUpdateJornada);

            $sqlDeleteJornada = "DELETE FROM jornadas WHERE id_Jornada = :id_Jornada";
            $stmtDeleteJornada = $conexion->prepare($sqlDeleteJornada);

            // var_dump($datos["instituciones"]); die();
            
            // Procesar las nuevas jornadas
            foreach ($datos["instituciones"] as $institucion) {

                foreach ($institucion["dias"] as $k => $dia) {  
                    var_dump($institucion["dias"][1]); 
                    die();

                    if (isset($dia["dia"])) {
                        // Jornada existente: actualizar si hay cambios
                        if (isset($jornadasExistentesMap[$dia["id_Jornada"]])) {
                            $jornadaExistente = $jornadasExistentesMap[$dia["id_Jornada"]];
                            if ($jornadaExistente["id_Dia"] != $dia["dia"] ||
                                $jornadaExistente["horaInicio"] != $dia["horaInicio"] ||
                                $jornadaExistente["horaFin"] != $dia["horaFin"]
                            ) {
                                // Actualizar jornada
                                $stmtUpdateJornada->bindParam(":id_Jornada", $dia["id_Jornada"], PDO::PARAM_INT);
                                $stmtUpdateJornada->bindParam(":id_Dia", $dia["dia"], PDO::PARAM_INT);
                                $stmtUpdateJornada->bindParam(":horaInicio", $dia["horaInicio"], PDO::PARAM_STR);
                                $stmtUpdateJornada->bindParam(":horaFin", $dia["horaFin"], PDO::PARAM_STR);
                                $stmtUpdateJornada->execute();
                            }
                            unset($jornadasExistentesMap[$dia["id_Jornada"]]);
                        }
                    } else {
                        // Nueva jornada: insertar
                        $stmtInsertJornada->bindParam(":id_Dia", $dia["dia"], PDO::PARAM_INT);
                        $stmtInsertJornada->bindParam(":horaInicio", $dia["horaInicio"], PDO::PARAM_STR);
                        $stmtInsertJornada->bindParam(":horaFin", $dia["horaFin"], PDO::PARAM_STR);
                        $stmtInsertJornada->execute();

                        $id_Jornada = $conexion->lastInsertId();

                        // Asociar con hs_semanal
                        $sqlInsertHsSemanal = "INSERT INTO hs_semanal (id_Jornada, numeroPlaza) 
                                            VALUES (:id_Jornada, :numeroPlaza)";
                        $stmtInsertHsSemanal = $conexion->prepare($sqlInsertHsSemanal);
                        $stmtInsertHsSemanal->bindParam(":id_Jornada", $id_Jornada, PDO::PARAM_INT);
                        $stmtInsertHsSemanal->bindParam(":numeroPlaza", $datos["numeroPlaza"], PDO::PARAM_INT);
                        $stmtInsertHsSemanal->execute();
                    }
                }
            }

            // Eliminar las jornadas restantes
            foreach ($jornadasExistentesMap as $id_Jornada => $jornada) {
                $stmtDeleteJornada->bindParam(":id_Jornada", $id_Jornada, PDO::PARAM_INT);
                $stmtDeleteJornada->execute();

                // Eliminar también de hs_semanal
                $sqlDeleteHsSemanal = "DELETE FROM hs_semanal WHERE id_Jornada = :id_Jornada";
                $stmtDeleteHsSemanal = $conexion->prepare($sqlDeleteHsSemanal);
                $stmtDeleteHsSemanal->bindParam(":id_Jornada", $id_Jornada, PDO::PARAM_INT);
                $stmtDeleteHsSemanal->execute();
            }


            // 3. Actualizar en la tabla solicitudes_suplente
            $sqlSolicitud = "UPDATE solicitudes_suplente SET 
                fechaInicio = :fechaInicio, 
                fechaFin = :fechaFin, 
                id_MotivoSuplencia = :id_MotivoSuplencia, 
                observaciones = :observaciones, 
                id_Cargo = :id_Cargo, 
                id_EstadoSol = :id_EstadoSol
                WHERE numeroTramite = :numeroTramite";

            $observaciones = $datos["observaciones"] . $observacionesExtra;
            $stmtSolicitud = $conexion->prepare($sqlSolicitud);
            $stmtSolicitud->bindParam(":numeroTramite", $datos["numeroTramite"], PDO::PARAM_INT);
            $stmtSolicitud->bindParam(":fechaInicio", $datos["fechaInicio"], PDO::PARAM_STR);
            $stmtSolicitud->bindParam(":fechaFin", $datos["fechaFin"], PDO::PARAM_STR);
            $stmtSolicitud->bindParam(":id_MotivoSuplencia", $datos["id_Motivo"], PDO::PARAM_INT);
            $stmtSolicitud->bindParam(":observaciones", $observaciones, PDO::PARAM_STR);
            $stmtSolicitud->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);
            $stmtSolicitud->bindParam(":id_EstadoSol", $datos["estado"], PDO::PARAM_INT);

            if (!$stmtSolicitud->execute()) {
                throw new Exception("Error al actualizar la solicitud.");
            }

            $conexion->commit();
            return ["status" => "ok"];
        } catch (Exception $e) {
            $conexion->rollBack();
            return ["status" => "error", "message" => $e->getMessage()];
        } finally {
            $stmtCheckCargo = null;
            $stmtUpdateCargo = null;
            $stmtSolicitud = null;
            $conexion = null;
        }
    }

    
    public static function mdlObtenerDatosPorPlaza($numeroPlaza)
    {
        try {
            $conexion = Conexion::conectar();

            // 1. Verificar si el id_Cargo existe en la tabla plazas
            $sqlCheckCargo = "SELECT id_Cargo FROM plazas WHERE numeroPlaza = :numeroPlaza";
            $stmtCheckCargo = $conexion->prepare($sqlCheckCargo);
            $stmtCheckCargo->bindParam(":numeroPlaza", $numeroPlaza, PDO::PARAM_INT);
            $stmtCheckCargo->execute();

            if ($stmtCheckCargo->rowCount() > 0) {
                $resultado = $stmtCheckCargo->fetchAll(PDO::FETCH_ASSOC);
                // Si existe, actualizar el registro en la tabla cargos
                $id_Cargo = $resultado[0]["id_Cargo"];

                $sql = "SELECT 
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
                    c.eliminado = 0 and p.id_Cargo = :id_Cargo
                GROUP BY 
                    c.id_Cargo ";

                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":id_Cargo", $id_Cargo, PDO::PARAM_INT);
                $stmt->execute();

                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                return $resultado ? $resultado : false;
            }
        } catch (Exception $e) {
            return false;
        } finally {
            $stmt = null;
            $conexion = null;
        }
    }

    // ==============================================================
    // Eliminar Cargo
    // ==============================================================
    static public function mdlEliminarSolicitud($datos)
    {
        try {
            $elim = 8;
            $stmt = Conexion::conectar()->prepare("UPDATE solicitudes_suplente 
            SET id_EstadoSol = :id_EstadoSol where id_SolSuplente = :id_SolSuplente");
            
            $stmt->bindParam(":id_SolSuplente", $datos, PDO::PARAM_INT);
            $stmt->bindParam(":id_EstadoSol", $elim , PDO::PARAM_INT);
            
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
    // Mostrar Horarios
    // ==============================================================
    public static function mdlMostrarHorariosSol($id_SolSuplente) {
        // Ejecuta la consulta SQL (simplificada)
        $stmt = Conexion::conectar()->prepare("SELECT 
            i.id_Institucion,
            j.id_Dia, 
            j.horaInicio, 
            j.horaFin
        FROM cargos AS c
        INNER JOIN plazas as p ON p.id_Cargo = c.id_Cargo
        INNER JOIN instituciones AS i ON i.id_Institucion = p.id_Institucion
        INNER JOIN hs_semanal AS hs ON hs.numeroPlaza = p.numeroPlaza
        INNER JOIN jornadas AS j ON j.id_Jornada = hs.id_Jornada
        INNER JOIN solicitudes_suplente AS ss ON c.id_Cargo = ss.id_Cargo
        WHERE c.eliminado = 0 AND ss.id_SolSuplente = :id_SolSuplente");
    
        $stmt->bindParam(":id_SolSuplente", $id_SolSuplente, PDO::PARAM_INT);
        $stmt->execute();
        
        // Procesar los resultados para organizar por cargo y día
        $horariosOrganizados = [];
        $i = 0;
        while ($row = $stmt->fetch()) {
            $id_Institucion = $row['id_Institucion'];
            $idDia = $row['id_Dia'];
            // $i ++;
    
            // Organiza por cargo y día
            $horariosOrganizados[$id_Institucion][$idDia][] = [ 
                'dia' => $row['id_Dia'],
                'horaInicio' => $row['horaInicio'],
                'horaFin' => $row['horaFin']
            ];
        }
    
        return $horariosOrganizados; // Devuelve el array organizado
    }
    
    
}

