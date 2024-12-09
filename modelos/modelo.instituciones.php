<?php

require_once 'conexion.php';

class ModeloInstituciones{

    // ==============================================================
    // Mostrar Instituciones
    // ==============================================================
    static public function mdlMostrarInstituciones($id_institucion, $valor)
    {
        //Si se manda un agente por parametro hace la consulta para un solo registro, sino trae todos. 
        if ($id_institucion != null) {
            try {
                $stmt = Conexion::conectar()->prepare("SELECT 
                i.id_institucion, i.cue,tipo.tipo, tipo.id_Tipo , i.id_ZonaSupervision, i.id_Director, i.nombre as institucion, i.numero, a.apellido, a.nombre, a.dni, a.telefono, z.nombre as zona 
                FROM `tipo_institucion` as tipo, `zonas_supervision` as z, `instituciones` as i left join `agentes` as a on i.id_Director = a.id_Agente 
                where i.eliminado = 0 and i.id_ZonaSupervision = z.id_ZonaSupervision and tipo.id_Tipo = i.id_Tipo and $id_institucion = :$id_institucion order by tipo.id_Tipo, i.numero;");
                $stmt->bindParam(":" . $id_institucion, $valor, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
                return "Error: " .$e ->getMessage();
            }


        } else {
            try {
                $instituciones = Conexion::conectar()->prepare("SELECT 
                i.id_institucion, i.cue,tipo.tipo, i.nombre as institucion, i.numero, a.apellido, a.nombre, a.dni, a.telefono, z.nombre as zona 
                FROM `instituciones` as i 
                inner join `tipo_institucion` as tipo on tipo.id_Tipo = i.id_Tipo
                left join `agentes` as a on i.id_Director = a.id_Agente
                left join `zonas_supervision` as z on i.id_ZonaSupervision = z.id_ZonaSupervision
                where i.eliminado = 0 order by tipo.id_Tipo, i.numero;");
                
                $instituciones->execute();
                return $instituciones->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
                return "Error: " .$e ->getMessage();
            }
        }    
    }

    // ==============================================================
    // Mostrar Tipos
    // ==============================================================
    static public function mdlMostrarTipos()
    {        
        try {
            $instituciones = Conexion::conectar()->prepare("SELECT * FROM `tipo_institucion` where id_Tipo > 1;");
            
            $instituciones->execute();
            return $instituciones->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    // ==============================================================
    // Agregar Institucion
    // ==============================================================
    static public function mdlAgregarInstitucion($datos)
    {
        try {
            // SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;
            $stmt = Conexion::conectar()->prepare("INSERT INTO instituciones (id_Tipo, cue, numero, nombre, id_Director, id_ZonaSupervision ) VALUES (:id_Tipo, :cue, :numero, :nombre, :id_Director, :id_ZonaSupervision)");

 
            $stmt->bindParam(":id_Tipo", $datos["id_Tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":cue", $datos["cue"], PDO::PARAM_INT);
            $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id_Director", $datos["id_Director"], PDO::PARAM_INT);
            $stmt->bindParam(":id_ZonaSupervision", $datos["id_ZonaSupervision"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return "error";
            }
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    // ==============================================================
    // Editar Institucion
    // ==============================================================
    static public function mdlEditarInstitucion($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE instituciones SET 
            id_Tipo = :id_Tipo, cue = :cue, numero = :numero, nombre = :nombre, 
            id_Director = :id_Director, id_ZonaSupervision = :id_ZonaSupervision
            WHERE id_Institucion = :id_Institucion");

            $stmt->bindParam(":id_Institucion", $datos["id_Institucion"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Tipo", $datos["id_Tipo"], PDO::PARAM_INT);
            $stmt->bindParam(":cue", $datos["cue"], PDO::PARAM_INT);
            $stmt->bindParam(":numero", $datos["numero"], PDO::PARAM_INT);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":id_Director", $datos["id_Director"], PDO::PARAM_INT);
            $stmt->bindParam(":id_ZonaSupervision", $datos["id_ZonaSupervision"], PDO::PARAM_INT);

            if ($stmt->execute()) {
                return "ok";
            } else {
                return print_r(Conexion::conectar()->errorInfo());
            }
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
    

    // ==============================================================
    // Eliminar Institucion
    // ==============================================================
    static public function mdlEliminarInstitucion($datos)
    {
        try {
            $elim = 1;
            $stmt = Conexion::conectar()->prepare("UPDATE instituciones 
            SET eliminado = :eliminado where id_Institucion = :id_Institucion");
            
            $stmt->bindParam(":id_Institucion", $datos, PDO::PARAM_INT);
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
    // Verificar si existe una institucion
    // ==============================================================
    public static function mdlExisteInstitucion($idInstitucion)
    {
        $stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM instituciones WHERE id_Institucion = :id");
        $stmt->bindParam(":id", $idInstitucion, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

}