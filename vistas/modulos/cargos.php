<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Cargos</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">    
            <a href="nuevo_cargo" class="btn btn-primary"><i class="fas fa-plus" ></i > &nbsp; Nuevo Cargo</a>
        </div> 
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaES" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Cargo</th>    
                                <th>Hs. Cát.</th>
                                <th>Grado</th>
                                <th>Div.</th>
                                <th>Turno</th>
                                <th>Docente</th>
                                <th>Inst. Sede</th>
                                <th>Institución 2</th>
                                <th>Institución 3</th>
                                <th>Institución 4</th>                                 
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $cargos = ControladorCargos::ctrMostrarCargos();
                                
                                foreach ($cargos as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["nombreCargo"] ?></td>
                                <td> <?php echo $value["hsCatedra"] ?></td>
                                <td> <?php echo $value["grado"] ?></td>
                                <td> <?php echo $value["division"] ?></td>
                                <td> <?php echo $value["turno"] ?></td>
                                <td> <?php echo $value["docente"] ?></td>
                                

                                <?php
                                // Procesa las instituciones y las divide en columnas
                                $instituciones = explode(',', $value['instituciones']);
                                for ($i = 0; $i < 4; $i++) {
                                    if (isset($instituciones[$i])) {
                                        echo "<td>" . $instituciones[$i] . "</td>";
                                    } else {
                                        echo "<td></td>";  // Celda vacía si no hay más instituciones
                                    }
                                }
                                ?>

                                <td><a href="editar_cargo" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a> <a href="eliminar_cargo" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a></td>
                                
                            </tr>

                            <?php } ?>
                            
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>
    
</div>