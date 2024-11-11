<?php
    $agentes = ControladorAgentes::ctrMostrarAgentes(null, null);
?>

<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Agentes</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">    
            <a href="nuevo_agente" class="btn btn-primary"><i class="fas fa-plus" ></i > &nbsp; Nuevo Agente</a>
        </div> 
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaES" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Apellido</th>    
                                <th>Nombre</th>
                                <th>DNI</th>
                                <th>Rol</th>
                                <th>Dirección</th>
                                <th>Teléfono</th> 
                                <th>Mail</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php                                
                                foreach ($agentes as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["apellido"] ?></td>    
                                <td> <?php echo $value["nombre"] ?></td>
                                <td> <?php echo $value["dni"] ?></td>
                                <td> <?php echo $value["rol"] ?></td>
                                <td> <?php echo $value["direccion"] ?></td>
                                <td> <?php echo $value["telefono"] ?></td>
                                <td> <?php echo $value["email"] ?></td>
                                <td><a href="editar_agente/<?php echo $value["id_Agente"] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> 
                                <button class="btn btn-danger btn-sm btnEliminarAgente" id_Agente=<?php echo $value["id_Agente"]; ?> nombre_completo="<?php echo $value['apellido'] . ', ' . $value['nombre']; ?>" ><i class="fas fa-trash"></i></button></td>
                            </tr>
                           
                            <?php } ?>
                            
                        </tbody>
                    </table>
                    <!-- Campo escondido que guarda el url -->
                    <input type="hidden" id="url" value="<?php echo $url; ?>">
                </div>

            </div>
        </div>
    </div>
    
</div>

<?php 
    $eliminar = new ControladorAgentes();
    $eliminar -> ctrEliminarAgente();
?>