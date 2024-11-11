<?php
    require_once 'conexion.php';
class ModeloAgentes{
    // ==============================================================
    // Mostrar todos los Agentes
    // ==============================================================
    static public function mdlMostrarAgentes($agente, $valor)
    {
        //Si se manda un agente por parametro hace la consulta para un solo registro, sino trae todos. 
        if ($agente != null) {
  
            try {
                $stmt = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and eliminado = 0 and $agente = :$agente;");
                $stmt->bindParam(":" . $agente, $valor, PDO::PARAM_INT);
                $stmt->execute();
                return $stmt->fetch(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
                return "Error: " .$e ->getMessage();
            }

        } else {
            try {
                $agentes = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and eliminado = 0;");
                $agentes->execute();
                return $agentes->fetchAll(PDO::FETCH_ASSOC);

            } catch (Exception $e) {
                return "Error: " .$e ->getMessage();
            }
        }

    }

    // ==============================================================
    // Agregar Agentes
    // ==============================================================
    static public function mdlAgregarAgente($datos)
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
    static public function mdlEditarAgente($datos)
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
    // Eliminar Agentes
    // ==============================================================
    static public function mdlEliminarAgente($datos)
    {
        try {
            $elim = 1;
            $stmt = Conexion::conectar()->prepare("UPDATE agentes 
            SET eliminado = :eliminado where id_Agente = :id_Agente");
            
            $stmt->bindParam(":id_Agente", $datos, PDO::PARAM_INT);
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


    static public function mdlBuscarAgentes($agente, $valor){
        try {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM `agentes`, `roles`  WHERE agentes.id_Rol = roles.id_Rol and eliminado = 0 and $agente = :$agente;");
            $stmt->bindParam(":" . $agente, $valor, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }

    static public function mdlMostrarRolAgentes(){
        try{
        $stmt= Conexion::conectar()->prepare("SELECT r.id_Rol as idrol,r.rol FROM roles AS r WHERE r.rol!='Jefe'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }catch(Exception $e){
            return "Error:" . $e ->getMessage();
        }
    }
}