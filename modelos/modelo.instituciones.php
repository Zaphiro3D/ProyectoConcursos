<?php

require_once 'conexion.php';

class ModeloInstituciones{

    // ==============================================================
    // Mostrar Instituciones
    // ==============================================================
    static public function mdlMostrarInstituciones()
    {
        try {
            $instituciones = Conexion::conectar()->prepare("SELECT 
            i.id_institucion, i.cue,tipo.tipo, i.nombre as institucion, i.numero, a.apellido, a.nombre, a.dni, a.telefono, z.nombre as zona 
            FROM `tipo_institucion` as tipo, `zonas_supervision` as z, `instituciones` as i left join `agentes` as a on i.id_Director = a.id_Agente 
            where i.eliminado = 0 and i.id_ZonaSupervison = z.id_ZonaSupervision and tipo.id_Tipo = i.id_Tipo order by tipo.id_Tipo, i.numero;");
            
            $instituciones->execute();
            return $instituciones->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    // ==============================================================
    // Agregar Instituciones
    // ==============================================================
    static public function mdlAgregarInstitucion($datos)
    {
        try {
            // SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;
            $stmt = Conexion::conectar()->prepare("INSERT INTO agentes (apellido, nombre, dni, telefono, direccion, email, usuario, password, id_Rol) VALUES (:apellido, :nombre, :dni, :telefono, :direccion, :email, :usuario, :password, :id_Rol)");

            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_INT);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", crypt($datos["password"], '$2a$07$tawfdgyaufiusdgopfhgjxerctyuniexrcvrdtfyg$'), PDO::PARAM_STR);
            $stmt->bindParam(":id_Rol", $datos["id_Rol"], PDO::PARAM_INT);

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
    // Editar Agentes
    // ==============================================================
    static public function mdlEditarInstitucion($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE agentes SET 
            apellido = :apellido, nombre = :nombre, dni = :dni, telefono = :telefono, 
            direccion = :direccion, email = :email, usuario = :usuario, 
            password = :password, id_Rol = :id_Rol
            WHERE id_Agente = :id_Agente");

            $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":dni", $datos["dni"], PDO::PARAM_INT);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);
            $stmt->bindParam(":password", crypt($datos["password"], '$2a$07$tawfdgyaufiusdgopfhgjxerctyuniexrcvrdtfyg$'), PDO::PARAM_STR);
            $stmt->bindParam(":id_Rol", $datos["id_Rol"], PDO::PARAM_INT);
            $stmt->bindParam(":id_Agente", $datos["id_Agente"], PDO::PARAM_INT);

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
    
}