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
/*
Textos completos
id_Cargo
id_NombreCargo
id_Grado
id_Division
id_Turno
hsCatedra
apellidoDocente
nombreDocente
dniDocente*/
    static public function mdlAgregarCargos($datos)
    {
        try {
            // SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;
            $stmt = Conexion::conectar()->prepare("INSERT INTO 
        cargos (id_NombreCargo,id_Grado,id_Division,id_Turno,hsCatedra,apellidoDocente,nombreDocente,dniDocente ) 
        VALUES 
        (:id_NombreCargo,:id_Grado,:id_Division,:id_Turno,:hsCatedra,:apellidoDocente,:nombreDocente,:dniDocente)");


            
            $stmt->bindParam(":id_NombreCargo", $datos["id_NombreCargo"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Grado", $datos["id_Grado"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Division", $datos["id_Division"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Turno", $datos["id_Turno"], PDO::PARAM_INT);
            $stmt->bindParam(":hsCatedra", $datos["hsCatedra"], PDO::PARAM_INT);
            $stmt->bindParam(":apellidoDocente", $datos["apellidoDocente"], PDO::PARAM_STR);
            $stmt->bindParam(":nombreDocente", $datos["nombreDocente"], PDO::PARAM_STR);
            $stmt->bindParam(":dniDocente", $datos["dniDocente"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlAgregarNumPla($datos)
    {
        try {
            // SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;
            $stmt = Conexion::conectar()->prepare("INSERT INTO 
        plazas (numeroPlaza,id_Cargo,id_Institucion,Sede ) 
        VALUES 
        (:numeroPlaza,:id_Cargo,:id_Institucion,:Sede)");



            $stmt->bindParam(":numeroPlaza", $datos["numeroPLaza"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Cargo", $datos["id_cargo"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Institucion", $datos["id_Institucion"], PDO::PARAM_INT);
            $stmt->bindParam(":Sede", $datos["Sede"], PDO::PARAM_INT);
            

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

/*static public function mdlMostrarCargos()
    {
        try {
            $cargos = Conexion::conectar()->prepare(
            "SELECT 
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
                c.id_Cargo;"
            );

            $cargos->execute();
            return $cargos->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }*/