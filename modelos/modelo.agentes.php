<?php

require_once 'conexion.php';

class ModeloAgentes{

    static public function mdlMostrarAgentes($tabla)
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    static public function mdlMostrarDirectores($tabla)
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and roles.id_Rol = 3;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }

    static public function mdlMostrarSupervisores($tabla)
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and roles.id_Rol = 2;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}