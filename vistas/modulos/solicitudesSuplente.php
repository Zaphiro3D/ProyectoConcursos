<?php
$solSuplente = ControladorSolSuplente::ctrMostrarSolSuplente(NULL, NULL);

$eliminar = new ControladorSolSuplente();
$eliminar->ctrEliminarSolicitud();

$aprobar = new ControladorSolSuplente();
$aprobar->ctrAprobarSolicitud();

$rechazar = new ControladorSolSuplente();
$rechazar->ctrRechazarSolicitud();

if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
}

?>
<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Solicitudes de Suplente</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">
            <?php 
            
            $estadoAutorizados = [];
            switch ($rol) {
                case 1: // Jefe
                    $estadoAutorizados = [1, 2, 3, 4, 5, 6, 7];
                    break;
                case 2: // Supervisor
                    $estadoAutorizados = [1, 2, 4, 5];
                    break;
    
                case 3: // Director
                    $estadoAutorizados = [1, 4];
                    break;
    
                case 4: // Administrativo
                    $estadoAutorizados = [3, 5, 6, 7];
                    break;
            }
    
            $estadoAutorizadosString = implode(',', $estadoAutorizados);


            
            if ($rol == 4) { ?>
                <!-- Mostrar un mensaje informativo -->
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-plus"></i> &nbsp; No tiene permisos para agregar una Nueva solicitud
                </button>
            <?php } else { ?>
                <a href="nueva_solsuplente" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Nueva Solicitud</a>
            <?php } ?>
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
                                <th>Div</th>
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
                            foreach ($solSuplente as $value):
                                $instituciones = explode(',', $value['instituciones']);
                            ?>                                                          
                                
                            <tr>    
                                <td class="dt-control"></td>                        
                                <td><?php echo $instituciones[0]?></td>
                                <td><?php echo $value["nombreCargo"] ?></td>
                                <td><?php echo $value["hsCatedra"] ?></td>
                                <td><?php echo $value["grado"] ?></td>
                                <td><?php echo $value["division"] ?></td>
                                <td><?php echo $value["turno"] ?></td>
                                <td><?php echo DateTime::createFromFormat('Y-m-d', $value["fechaInicio"])->format('d-m-Y')?></td>
                                <td><?php echo DateTime::createFromFormat('Y-m-d', $value["fechaFin"])->format('d-m-Y') ?></td>
                                <td><?php echo $value["motivo"] ?></td>
                                <td><?php echo $value["docente"] . '<br> DNI: ' . $value["dni"] ?></td>
                                <td><?php echo $instituciones[1] ?? ''  ?></td>
                                <td><?php echo $instituciones[2] ?? ''  ?></td>
                                <td><?php echo $instituciones[3] ?? ''  ?></td>
                                <td>
                                    <?php 
                                    $horarios = explode(' || ', $value['horarios_por_escuela']);
                                    
                                    foreach ($horarios as $detalle) {
                                        $hs = explode(', ', $detalle);
                                        
                                        foreach ($hs as $r =>$renglon) {
                                            if ($r == 0){
                                                echo "<br><b>{$renglon}</b><br>";
                                            } else{
                                                $str = str_replace("Horarios: ", "", $renglon); // casa "Horarios:"
                                                echo "- " . "{$str}" . "<br>";
                                            }
                                        }
                                    }
                                    echo "<hr>";
                                    ?>
                                </td>
                                <td><?php echo $value["observaciones"] ?></td>
                                <!-- Col Estado -->
                                <td class= "justify-content-center">
                                    <?php
                                    switch ($value["id_EstadoSol"]) {
                                            // Borrador
                                        case 1:
                                    ?>
                                            <h6><span class="badge rounded-pill bg-light text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clipboard"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h6>
                                        <?php
                                            break;

                                            // Pendiente en supervisión
                                        case 2:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-info text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clock"></i><?php echo " " . "Pendiente"; ?>
                                                </span></h6>
                                        <?php
                                            break;

                                            // Pendiente en administracion
                                        case 3:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-primary text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clock"></i><?php echo " " . "Pendiente";  ?>
                                                </span></h6>
                                        <?php
                                            break;

                                            // Rechazado por Supervisión
                                        case 4:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-danger text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-xmark"></i><?php echo " " . "Rechazado"; ?>
                                                </span></h6>
                                        <?php
                                            break;

                                            // Rechazado por Administración
                                        case 5:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-warning text-dark" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-xmark"></i><?php echo " " . "Rechazado"; ?>
                                                </span></h6>
                                        <?php
                                            break;

                                            // A Concursar
                                        case 6:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-success text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-check"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h6>
                                        <?php
                                            break;

                                            // Ya Concursado
                                        case 7:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-secondary text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-clipboard-check"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h6>
                                        <?php
                                            break;


                                            // Eliminado
                                        case 8:
                                        ?>
                                            <h6><span class="badge rounded-pill bg-dark text-light" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="<?php echo $value["estado"]; ?>">
                                                    <i class="fa-solid fa-delete-left"></i><?php echo " " . $value["estado"]; ?>
                                                </span></h6>
                                    <?php
                                            break;


                                        default:
                                            $value["estado"];
                                    } ?>
                                </td>
                                
                                <!-- Fin columna estado -->
                                <td>
                                <?php if ($rol == 3) { 
                                    if (in_array($value["id_EstadoSol"], $estadoAutorizados)){?>
                                        
                                        <a
                                            href="editar_solsuplente/<?php echo $value["id_SolSuplente"] ?>"
                                            class="btn btn-warning btn-sm m-1"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            data-bs-title="Editar"><i class="fas fa-edit"></i>
                                        </a>
                                        <button
                                            href="eliminar_solsuplente"
                                            class="btn btn-danger btn-sm btnEliminar m-1"
                                            id_eliminar=<?php echo $value["id_SolSuplente"]; ?>
                                            pag="solicitudesSuplente"
                                            categoria="Solicitud de Suplente"
                                            valorElim="<?php echo $instituciones[0] . " - " . $value["nombreCargo"]; ?>"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            data-bs-title="Eliminar"><i class="fas fa-trash"></i>
                                        </button>
                                    
                                    <?php }
                                } elseif (in_array($value["id_EstadoSol"], $estadoAutorizados)){ 
                                    ?>
                                    <a
                                        href="editar_solsuplente/<?php echo $value["id_SolSuplente"] ?>"
                                        class="btn btn-warning btn-sm mb-1"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-title="Editar"><i class="fas fa-edit"></i>
                                    </a>
                                    <?php if ($rol != 4){ //administrativo ?> 
                                        <button
                                            href="eliminar_solsuplente"
                                            class="btn btn-danger btn-sm btnEliminar mb-1"
                                            id_eliminar=<?php echo $value["id_SolSuplente"]; ?>
                                            pag="solicitudesSuplente"
                                            categoria="Solicitud de Suplente"
                                            valorElim="<?php echo $instituciones[0] . " - " . $value["nombreCargo"]; ?>"
                                            data-bs-toggle="tooltip"
                                            data-bs-placement="bottom"
                                            data-bs-title="Eliminar"><i class="fas fa-trash"></i>
                                        </button>
                                    
                                    <?php } echo '<br>'?>
                                    <!-- &nbsp;|&nbsp; -->
                                    <a
                                        href="<?php echo "solicitudesSuplente?id_aprobar=" . $value["id_SolSuplente"]  . '&id_estado=' . $value["id_EstadoSol"] ?>"
                                        class="btn btn-success btn-sm"
                                        id_aprobar=<?php echo $value["id_SolSuplente"]; ?>
                                        id_estado=<?php echo $value["id_EstadoSol"]; ?>
                                        pag="solicitudesSuplente"
                                        valorAprobar="<?php echo $value["id_SolSuplente"]; ?>"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-title="Aprobar"><i class="fas fa-circle-check"></i>
                                    </a>
                                    <a
                                        href="<?php echo "solicitudesSuplente?id_rechazar=" . $value["id_SolSuplente"]  . '&id_estado=' . $value["id_EstadoSol"] ?>"
                                        class="btn btn-danger btn-sm"
                                        id_rechazar=<?php echo $value["id_SolSuplente"]; ?>
                                        id_estado=<?php echo $value["id_EstadoSol"]; ?>
                                        pag="solicitudesSuplente"
                                        valorRechazar="<?php echo $value["id_SolSuplente"]; ?>"
                                        data-bs-toggle="tooltip"
                                        data-bs-placement="bottom"
                                        data-bs-title="Rechazar"><i class="fas fa-circle-xmark"></i>
                                    </a>
                            <?php }?>
                                </td>
                            <?php endforeach; ?>
                            </tr>


                        </tbody>
                    </table>
                    <!-- Campo escondido que guarda el url -->
                    <input type="hidden" id="url" value="<?php echo $url; ?>">

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
            '<br /><b>Institución 4:</b> ' + d[13] +
            '<br /><br /><b>Horario:</b> ' + d[14] +
            '<br /><b>Observaciones:</b> ' + d[15] +
            '</div>'
        );
    }


    $(document).ready(function() {
        // Inicialización de DataTable
        let table = $('#tablaSolSuplente').DataTable({
            scrollX: true,
            pagingType: "full_numbers",
            "language": window.espanol,
            columnDefs: [{
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
        $('#tablaSolSuplente tbody').on('click', 'td.dt-control', function() {
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