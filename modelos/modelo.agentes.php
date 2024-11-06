<?php

require_once 'conexion.php';

class ModeloAgentes{

    // ==============================================================
    // Mostrar todos los Agentes
    // ==============================================================
    static public function mdlMostrarAgentes()
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    // ==============================================================
    // Mostrar solo directores
    // ==============================================================
    static public function mdlMostrarDirectores()
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and roles.id_Rol = 3;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    // ==============================================================
    // Mostrar solo supervisores
    // ==============================================================
    static public function mdlMostrarSupervisores()
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and roles.id_Rol = 2;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    // ==============================================================
    // Mostrar quienes no sean supervisores
    // ==============================================================
    static public function mdlMostrarAgentes_noS()
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and roles.id_Rol != 2;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    // ==============================================================
    // Agregar Agentes
    // ==============================================================
    static public function mdlAgregarAgente($datos)
    {
        try {
            // SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;
            $stmt = Conexion::conectar()->prepare("INSERT INTO (nombre, stock, precio, id_categoria) VALUES (:nombre, :stock, :precio, :id_categoria)");

            // UN ENLACE POR CADA DATO, TENER EN CUENTA EL TIPO DE DATO STR O INT
            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
            $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
            $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);

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
    static public function mdlEditarAgente($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("UPDATE SET nombre = :nombre, precio = :precio, stock = :stock, id_categoria = :id_categoria WHERE id_producto = :id_producto");

            $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $datos["precio"], PDO::PARAM_STR);
            $stmt->bindParam(":stock", $datos["stock"], PDO::PARAM_INT);
            $stmt->bindParam(":id_categoria", $datos["id_categoria"], PDO::PARAM_INT);
            $stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

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
    // Eliminar Agentes
    // ==============================================================
    static public function mdlEliminarAgente($datos)
    {
        try {
            $stmt = Conexion::conectar()->prepare("DELETE FROM WHERE id_producto = :id_producto");
            
            $stmt->bindParam(":id_producto", $datos, PDO::PARAM_INT);
            
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