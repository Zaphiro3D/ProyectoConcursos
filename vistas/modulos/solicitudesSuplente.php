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
                            ?>
                            
                                <?php
                                // Procesa las instituciones y las divide en columnas
                                $instituciones = explode(',', $value['instituciones']);
                                for ($i = 0; $i < 4; $i++) {
                                    //   if (isset($instituciones[$i])) {
                                    ?>
                                    <!--echo "<td>" . $instituciones[0] . "</td>";
                                    //} 
                                    //else {-->
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
                                    echo "<td>" . $instituciones[1] . "</td>";
                                    echo "<td>" . $instituciones[2] . "</td>";
                                    echo "<td>" . $instituciones[3] . "</td>";  // Celda vacía si no hay más instituciones
                               
                                //}
                                ?>
                                <td><?php echo $value["horario"].$value["dias"] ?></td>
                                <td><?php echo $value["observaciones"] ?></td>
                                <td><?php echo "" ?> </td>
                                <?php  }?>
                            </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>