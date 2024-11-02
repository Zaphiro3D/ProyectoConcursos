<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Solicitudes de Suplente</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">
            <a href="nueva_solsuplente" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Nueva Solicitud</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaES" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Establecimiento Sede</th>
                                <th>Cargo</th>
                                <th>Hs Cátedra</th>
                                <th>Grado</th>
                                <th>División</th>
                                <th>Turno</th>
                                <th>Fecha Desde</th>
                                <th>Fecha Hasta</th>
                                <th>Motivo Lic.</th>
                                <th>Agente Reemplazado</th>
                                <th>Establecimiento 2</th>
                                <th>Establecimiento 3</th>
                                <th>Establecimiento 4</th>
                                <th>Horario</th>
                                <th>Observaciones</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $nombreinstitucion = ControladorSolSuplente::ctrMostrarSolSuplente();
                            foreach ($nombreinstitucion as $key => $value) {
                                $instituciones = explode(',', $value['instituciones']);
                                $horarios = explode(' | ', $value['horarios']);
                            ?>
                                                          
                                
                            <tr>        
                                <td><?php echo $instituciones[0]?></td>
                                <td><?php echo $value["nombreCargo"] ?></td>
                                <td><?php echo $value["hsCatedra"] ?></td>
                                <td><?php echo $value["grado"] ?></td>
                                <td><?php echo $value["division"] ?></td>
                                <td><?php echo $value["turno"] ?></td>
                                
                                <td><?php echo $value["fechaInicio"] ?></td>
                                <td><?php echo $value["fechaFin"] ?></td>
                                <td><?php echo $value["motivo"]?></td>
                                <td><?php echo $value["docente"] ?></td>

                                <?php
                                // Procesa las instituciones y las divide en columnas
                                
                                for ($i = 1; $i < 4; $i++) {
                                    if (isset($instituciones[$i])) {
                                        echo "<td>" . $instituciones[$i] . "</td>";
                                    } else {
                                        echo "<td></td>";  // Celda vacía si no hay más instituciones
                                    }
                                }
                                
                                // Procesa los horarios  y los concatena para mostrarlos
                                $horario = '' ;
                                for ($i = 0; $i < count($horarios); $i++) {
                                    if (isset($horarios[$i])) {
                                        $horario = $horario . $horarios[$i] . '. ';
                                    } 
                                }
                                ?>
                                
                                <td><?php echo $horario ?>  </td>
                                <td><?php echo $value["observaciones"] ?></td>
                                <td><?php echo "" ?> </td>
                                <?php  }?>
                            </tr>
                            

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>