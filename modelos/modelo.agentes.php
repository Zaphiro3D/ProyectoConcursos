<?php

require_once 'conexion.php';

class ModeloAgentes{

    static public function mdlMostrarAgentes($tabla)
    {
        try {
            $productos = Conexion::conectar()->prepare("SELECT * FROM $tabla");
            $productos->execute();
            return $productos->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}