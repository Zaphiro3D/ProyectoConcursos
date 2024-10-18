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

                                $instituciones = ControladorInstituciones::ctrMostrarInstituciones();
                                foreach ($instituciones as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["cue"] ?></td>
                                <td> <?php echo $value["TipoInstitucion"] ?></td> 
                                <td> <?php echo $value["numero"] ?></td>
                                <td> <?php echo $value["institucion"] ?></td>
                                <td> <?php echo $value["apellido"] . " " .$value["nombre"] ?></td>
                                <td> <?php echo $value["dni"] ?></td>
                                <td> <?php echo $value["zona"] ?></td>
                                <td><a href="editar_institucion" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> <a href="eliminar_institucion" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                            </tr>

                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    
</div>

