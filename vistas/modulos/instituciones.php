<?php
    $instituciones = ControladorInstituciones::ctrMostrarInstituciones(null, null);
?>
<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Instituciones</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">    
            <a href="nueva_institucion" class="btn btn-primary"><i class="fas fa-plus" ></i > &nbsp; Nueva Institución</a>
            <!-- <button type="button" class="btn btn-primary"><i data-feather="edit-2"></i>Editar</button>
            <button type="button" class="btn btn-primary"><i data-feather="trash-2"></i>Eliminar</button>  -->
        </div> 
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaES" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>CUE</th>
                                <th>Tipo</th> 
                                <th>N°</th>
                                <th>Nombre</th>
                                <th>Director</th>
                                <th>DNI Director</th>
                                <th>Zona de Supervisión</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                
                                foreach ($instituciones as $key => $value) { 
                                    $inst= $value["tipo"] . " N°" . $value["numero"]. '" ' . $value["institucion"] .'" '."CUE: {$value["cue"]}";                       
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["cue"] ?></td>
                                <td> <?php echo $value["tipo"] ?></td> 
                                <td> <?php echo $value["numero"] ?></td>
                                <td> <?php echo $value["institucion"] ?></td>
                                <td> <?php echo $value["apellido"] . " " .$value["nombre"] ?></td>
                                <td> <?php echo $value["dni"] ?></td>
                                <td> <?php echo $value["zona"] ?></td>
                                <td><a href="editar_institucion/<?php echo $value["cue"] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> 
                                <button class="btn btn-danger btn-sm btnEliminarInst" id_Institucion=<?php echo $value["id_institucion"]; ?> institucion="<?php echo $value["tipo"] . " N°" . $value["numero"]. " " . $value["institucion"] . " - CUE: {$value["cue"]}"; ?>"><i class="fas fa-trash"></i></button></td>
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
    $eliminar = new ControladorInstituciones();
    $eliminar -> ctrEliminarInstitucion();
?>
