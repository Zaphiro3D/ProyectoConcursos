<?php

require_once 'conexion.php';

class ModeloZonas{

    static public function mdlMostrarZonas($tabla)
    {
        try {
            $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol;");
            $agentes->execute();
            return $agentes->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}