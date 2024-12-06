<?php

require_once 'conexion.php';

class ModeloZonas{

    static public function mdlMostrarZonas($zona, $valor)
    {
        //Si se manda un agente por parametro hace la consulta para un solo registro, sino trae todos. 
        if ($zona != null) {

            try {
                $stmt = Conexion::conectar()->prepare("SELECT z.id_ZonaSupervision, z.nombre as zona, a.apellido, a.nombre, a.dni, a.telefono FROM `agentes` as a inner join `zonas_supervision` as z ON z.id_Supervisor = a.id_Agente
                and $zona=:valor");
                $stmt->bindParam(":valor", $valor, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        } else {
            try {
                $zonas = Conexion::conectar()->prepare("SELECT z.id_ZonaSupervision, z.nombre as zona, a.apellido, a.nombre, a.dni, a.telefono FROM `agentes` as a inner join `zonas_supervision` as z ON z.id_Supervisor = a.id_Agente;");
                $zonas->execute();
                return $zonas->fetchAll(PDO::FETCH_ASSOC);
            } catch (Exception $e) {
                return "Error: " . $e->getMessage();
            }
        }
    }
    

    static public function mdlAgregarZonas($datos)
    {
        try {
            $stmtZona = Conexion::conectar()->prepare("INSERT INTO zonas_supervision (nombre,id_Supervisor) VALUES (:nombre,:id_Supervisor)");

            $stmtZona->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmtZona->bindParam(":id_Supervisor", $datos["id_Supervisor"], PDO::PARAM_INT);

            if (!$stmtZona->execute()) {
                return "error_zonas";
            }
            // Obtener el último id_Usuario insertado
            $idzona = Conexion::conectar()->query("SELECT MAX(id_ZonaSupervision) AS id FROM zonas_supervision")->fetch(PDO::FETCH_ASSOC)['id'];

            $stmtInstituciones = Conexion::conectar()->prepare(
                "INSERT INTO instituciones  (id_ZonaSupervision,id_Institucion) VALUES (:id_ZonaSupervision, :id_Institucion)"
            );

            $stmtInstituciones->bindParam(":id_Institucion",$datos["id_Institucion"], PDO::PARAM_INT);
            $stmtInstituciones->bindParam(":id_zonaSupervision", $idzona, PDO::PARAM_INT);

            if ($stmtInstituciones->execute()) {
                return "ok";
            } else {
                return "error_instituciones";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlEditarZonas($datos)
    {
        try {
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
        }
    }

    static public function mdlActualizarZonaSupervision($idZona, $instituciones)
    {
        try {
            $stmt = Conexion::conectar()->prepare(
                "UPDATE instituciones SET id_ZonaSupervision = :id_ZonaSupervision WHERE id_Institucion = :id_Institucion"
            );

            print_r("Id Profe: " . $idZona);
            print_r("id isntituciones: " . $instituciones);

            //$stmt->bindParam(":id_ZonaSupervision",$idZona,PDO::PARAM_INT);
            foreach ($instituciones as $idInsti) {
                $stmt->bindParam(":id_ZonaSupervision", $idZona, PDO::PARAM_INT);
                $stmt->bindParam(":id_Institucion", $idInsti, PDO::PARAM_INT);
                $stmt->execute();
            }
            return "ok";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}