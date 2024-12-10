<?php

require_once 'conexion.php';

class ModeloZonas{

    static public function mdlMostrarZonas($zona, $valor)
    {
        //Si se manda un agente por parametro hace la consulta para un solo registro, sino trae todos. 
        if ($zona != null) {

            try {
                $stmt = Conexion::conectar()->prepare(" SELECT z.id_ZonaSupervision, z.nombre as zona, a.apellido, a.nombre, a.dni, a.telefono,a.id_Agente FROM `agentes` as a inner join `zonas_supervision` as z ON z.id_Supervisor = a.id_Agente
                and $zona=:valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {
            try {
                $zonas = Conexion::conectar()->prepare("SELECT z.id_ZonaSupervision, z.nombre as zona, a.apellido , a.nombre , a.dni, a.telefono FROM `agentes` as a inner join `zonas_supervision` as z ON z.id_Supervisor = a.id_Agente;");
                $zonas->execute();
                return $zonas->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }



    // ==============================================================   
    // Agregar Zona y actualizar instituciones
    // ==============================================================  
    static public function mdlAgregarZonas($datos)
    {
        try {
            // Validar los datos antes de proceder
            if (empty($datos["nombre"]) || !is_numeric($datos["id_Supervisor"])) {
                return "error_datos_invalidos";
            }

            // Conexión y preparación de la consulta
            $conexion = Conexion::conectar();
            $stmtZona = $conexion->prepare("INSERT INTO zonas_supervision (nombre, id_Supervisor) VALUES (:nombre, :id_Supervisor)");

            // Vinculación de parámetros
            $stmtZona->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmtZona->bindParam(":id_Supervisor", $datos["id_Supervisor"], PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmtZona->execute()) {
                // Retornar el ID de la zona recién creada
                return $conexion->lastInsertId();
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Manejo de errores
            error_log("Error en mdlAgregarZonas: " . $e->getMessage()); // Registrar en un log
            return "error";
        }
    }
           

    static public function mdlEditarZonas($datos)
    {
        try {
            if (empty($datos["id_ZonaSupervision"])) {
                return "error_Zona_no_Encontrada";
            }

            // Preparar la consulta de actualización
            $conexion = Conexion::conectar();
            $stmtZona = $conexion->prepare(
                "UPDATE zonas_supervision 
             SET nombre = :nombre, id_Supervisor = :id_Supervisor 
             WHERE id_ZonaSupervision = :id_ZonaSupervision"
            );

            // Vincular los parámetros
            $stmtZona->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmtZona->bindParam(":id_Supervisor", $datos["id_Supervisor"], PDO::PARAM_INT);
            $stmtZona->bindParam(":id_ZonaSupervision", $datos["id_ZonaSupervision"], PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmtZona->execute()) {
                $filasAfectadas = $stmtZona->rowCount();
                return ($filasAfectadas > 0) ? "ok" : "no_changes";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            error_log("Error en mdlEditarZonas: " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }
        /*try {
            if (empty($datos["id_ZonaSupervision"])) {
                return "error_Zona_no_Encontrada";
            }

            // Conexión y preparación de la consulta
            $conexion = Conexion::conectar();
            $stmtZona = $conexion->prepare("UPDATE zonas_supervision SET 
            nombre = :nombre, id_Supervisor = :id_Supervisor 
            where id_ZonaSupervision = :id_ZonaSupervision");

            // Vinculación de parámetros
            $stmtZona->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmtZona->bindParam(":id_Supervisor", $datos["id_Supervisor"], PDO::PARAM_INT);
            $stmtZona->bindParam(":id_ZonaSupervision", $datos["id_ZonaSupervision"], PDO::PARAM_INT);

            // Ejecutar la consulta
            if ($stmtZona->execute()) {
                $filasAfectadas = $stmtZona->rowCount();
                return ($filasAfectadas > 0) ? "ok" : "no_changes";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            // Registrar errores y devolver mensaje de error
            error_log("Error en mdlEditarZonas: " . $e->getMessage());
            return "Error: " . $e->getMessage();
        }*/
            /*
            $stmt = Conexion::conectar()->prepare("UPDATE zonas_supervision SET 
            nombre = :nombre, id_Supervisor = :id_Supervisor 
            where id_ZonaSupervision = :id_ZonaSupervision");

            //print_r($datos);
            //return;

            $stmt->bindParam(":id_ZonaSupervision", $datos["id_ZonaSupervision"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id_Supervisor", $datos["id_Supervisor"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return print_r(Conexion::conectar()->errorInfo());
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }*/
    }

    static public function mdlActualizarZonaSupervision($idZona, $instituciones)
    {
        try {
            // Establecer la conexión
            $conexion = Conexion::conectar();

            // Preparar la consulta
            $query = "UPDATE instituciones SET id_ZonaSupervision = :id_ZonaSupervision WHERE id_institucion = :id_institucion";

            foreach ($instituciones as $idInsti) {
                // Crear una nueva instancia de PDOStatement para cada iteración
                $stmt = $conexion->prepare($query);

                // Vincular los valores
                $stmt->bindParam(":id_ZonaSupervision", $idZona, PDO::PARAM_INT);
                
                $stmt->bindValue(":id_institucion", $idInsti, PDO::PARAM_INT);

                // Ejecutar la consulta
                if (!$stmt->execute()){
                    var_dump($stmt->errorInfo());
                    return "error";
                }
            }

            return "ok";
        } catch (Exception $e) {
            // Registrar el error y retornar mensaje genérico
            return $e->getMessage();
            
        }
        /*try {
            $conexion = Conexion::conectar();
            $stmt = Conexion::conectar()->prepare(
                "UPDATE instituciones SET id_ZonaSupervision = :id_ZonaSupervision, zona= :nombre WHERE id_institucion = :id_institucion"
            );
            
            //$stmt->bindParam(":id_ZonaSupervision",$idZona,PDO::PARAM_INT);
            
            foreach ($instituciones as $idInsti) {
                $stmt->bindParam(":nombre",$nombreZona,PDO::PARAM_STR);
                $stmt->bindParam(":id_ZonaSupervision", $idZona, PDO::PARAM_INT);
                $stmt->bindValue(":id_institucion", $idInsti, PDO::PARAM_INT);
                $stmt->execute();
            }
            
            return "ok";
        } catch (Exception $e) {
            return $e->getMessage();
        }*/
    }

    static public function mdlEliminarZonaSupervision($idZona){
        $stmt = Conexion::conectar()->prepare(
            "UPDATE instituciones 
             SET id_ZonaSupervision = NULL 
             WHERE id_ZonaSupervision = :id_ZonaSupervision");

        $stmt->bindParam(":id_ZonaSupervision",$idZona, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return "ok";
        } else {
            return "error";
        }
    }
}