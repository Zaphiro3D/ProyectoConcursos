<?php

require_once 'conexion.php';

class ModeloInstituciones{

    static public function mdlMostrarInstituciones()
    {
        try {
            $instituciones = Conexion::conectar()->prepare("SELECT i.cue,tipo.TipoInstitucion, i.nombre as institucion, i.numero, a.apellido, a.nombre, a.dni, a.telefono, z.nombre as zona FROM tipoinstitucion as tipo, `zonassupervision` as z, `instituciones` as i left join `agentes` as a on i.id_Director = a.id_Agente where i.id_ZonaSupervison = z.id_ZonaSupervision and tipo.id_Tipo = i.id_Tipo order by tipo.id_Tipo, i.numero;");
            $instituciones->execute();
            return $instituciones->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $e) {
            return "Error: " .$e ->getMessage();
        }

    }
    
}