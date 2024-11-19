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
                    <table id="tablaSolSuplente" class="table table-striped compact">                    
                        <thead>
                            <tr>
                                <th></th>
                                <th>Establecimiento Sede</th>
                                <th>Cargo</th>
                                <th>Hs. Cátedra</th>
                                <th>Grado</th>
                                <th>División</th>
                                <th>Turno</th>
                                <th>Fecha Inicio</th>
                                <th>Fecha Fin</th>
                                <th>Motivo</th>
                                <th>Agente Reemplazado</th>
                                <th>Institución 2</th>
                                <th>Institución 3</th>
                                <th>Institución 4</th>
                                <th>Horarios</th>
                                <th>Observaciones</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            $solSuplente = ControladorSolSuplente::ctrMostrarSolSuplente();
                            foreach ($solSuplente as $value):
                                $instituciones = explode(',', $value['instituciones']);
                                $horarios = explode(' | ', $value['horarios']);
                                
                                // Procesa los horarios  y los concatena para mostrarlos
                                $horario = '' ;
                                for ($i = 0; $i < count($horarios); $i++) {
                                    if (isset($horarios[$i])) {
                                        $horario = $horario . $horarios[$i] . '. ';
                                    }
                                }
                            ?>                                                          
                                
                            <tr>    
                                <td class="dt-control"></td>    
                                <td><?php echo $instituciones[0]?></td>
                                <td><?php echo $value["nombreCargo"] ?></td>
                                <td><?php echo $value["hsCatedra"] ?></td>
                                <td><?php echo $value["grado"] ?></td>
                                <td><?php echo $value["division"] ?></td>
                                <td><?php echo $value["turno"] ?></td>
                                <td><?php echo $value["fechaInicio"] ?></td>
                                <td><?php echo $value["fechaFin"] ?></td>
                                <td><?php echo $value["motivo"] ?></td>
                                <td><?php echo $value["docente"] ?></td>
                                <td><?php echo $instituciones[1] ?></td>
                                <td><?php echo $instituciones[2] ?></td>
                                <td><?php echo $instituciones[3] ?></td>
                                <td><?php echo $horario ?></td>
                                <td><?php echo $value["observaciones"] ?></td>
                                <!-- Col Estado -->
                                <td class= "justify-content-center">
                                    <?php
                                    switch ($value["id_EstadoSol"]) {
                                        // Borrador
                                        case 1:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-light text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clipboard"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h5> 
                                            <?php 
                                            break;

                                        // Pendiente en supervisión
                                        case 2:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-info text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clock"></i><?php echo " " . "Pendiente"; ?>
                                                </span></h5>
                                            <?php 
                                            break;

                                        // Pendiente en administracion
                                        case 3:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-primary text-light"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clock"></i><?php echo " " . "Pendiente";  ?>
                                                </span></h4>
                                            <?php 
                                            break;

                                        // Rechazado por Supervisión
                                        case 4:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-danger text-dark"  data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-xmark"></i><?php echo " " . "Rechazado"; ?>
                                                </span></h5> 
                                            <?php 
                                            break;
                                        
                                        // Rechazado por Administración
                                        case 5:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-warning text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-xmark"></i><?php echo " " . "Rechazado"; ?>
                                                </span></h5>
                                            <?php 
                                            break;

                                        // A Concursar
                                        case 6:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-success text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-check"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h5>
                                            <?php 
                                            break;

                                        // Ya Concursado
                                        case 7:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-secondary text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clipboard-check"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h5>
                                            <?php 
                                            break;


                                        // Eliminado
                                        case 8:
                                            ?>
                                                <h5><span class="badge rounded-pill bg-dark text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-delete-left"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h5>
                                            <?php 
                                            break;


                                        default:
                                        $value["estado"];
                                    }?>
                                </td>
                                <!-- Fin columna estado -->
                                <td><a href="editar_solsuplente" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Editar"><i class="fas fa-edit"></i>
                                    </a> <button href="eliminar_solsuplente" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Eliminar"><i class="fas fa-trash"></i></button> 
                                    &nbsp;|&nbsp; 
                                    <button href="aprobar_solic" class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Aprobar"><i class="fas fa-circle-check"></i>
                                    </button> <button href="rechazar_solic" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Rechazar"><i class="fas fa-circle-xmark"></i></button> 
                                </td>
                                <?php endforeach;?>
                            </tr>
                            

                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

</div>

<script>
    // Función de formato para los detalles de la tabla
    function format(d) {
        return (
            '<div><b>Hs Cátedra:</b> ' + d[3] + 
            '<br> <b>Fecha Inicio:</b> ' + d[7] + 
            '&nbsp; - &nbsp;<b>Fecha Fin:</b> ' + d[8] + 
            '<br /><b>Motivo:</b> ' + d[9] + 
            '<br /><br /><b>Comparte con</b>' +
            '<br /><b>Institución 2:</b> ' + d[11] + 
            '<br /><b>Institución 3:</b> ' + d[12] + 
            '<br /><b>Institución 4:</b> ' + d[13]+ 
            '<br /><br /><b>Horario:</b> ' + d[14] + 
            '<br /><b>Observaciones:</b> ' + d[15] + 
            '</div>'
        );
    }


    $(document).ready(function() {

        
        // Inicialización de DataTable
        let table = $('#tablaSolSuplente').DataTable({
            scrollX: true,
            pagingType:"full_numbers",
            "language": window.espanol,
            columnDefs: [
            {
                target: 3,
                visible: false
            },
            {
                target: 7,
                visible: false
            },
            {
                target: 8,
                visible: false
            },
            {
                target: 9,
                visible: false
            },
            {
                target: 11,
                visible: false
            },
            {
                target: 12,
                visible: false
            },
            {
                target: 13,
                visible: false
            },
            {
                target: 14,
                visible: false
            },
            {
                target: 15,
                visible: false
            }
            
            ]
        });

        // Evento para mostrar y ocultar detalles
        $('#tablaSolSuplente tbody').on('click', 'td.dt-control', function () {
            let tr = $(this).closest('tr');
            let row = table.row(tr);

            if (row.child.isShown()) {
                // Esta fila ya está abierta, la cierra
                row.child.hide();
                                
            } else {
                // Abre la fila y muestra detalles
                
                row.child(format(row.data())).show();
            }
        });
    });
</script>
