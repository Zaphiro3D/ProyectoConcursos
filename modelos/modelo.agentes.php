<?php

require_once 'conexion.php';

class ModeloAgentes{

    static public function mdlMostrarAgentes($tabla)
    {
        try {
            $productos = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;");
            $productos->execute();
            return $productos->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}