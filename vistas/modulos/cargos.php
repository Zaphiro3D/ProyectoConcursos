<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Cargos</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">
            <a href="nuevo_cargo" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Nuevo Cargo</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaCargos" class="table table-striped compact">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Inst. Sede</th>
                                <th>Cargo</th>
                                <th>Hs. Cát.</th>
                                <th>Grado</th>
                                <th>Div.</th>
                                <th>Turno</th>
                                <th>Docente</th>
                                <th>Institución 2</th>
                                <th>Institución 3</th>
                                <th>Institución 4</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $cargos = ControladorCargos::ctrMostrarCargos(null, null);
                            foreach ($cargos as $key => $value) 
                            {
                                $instituciones = explode(',', $value['instituciones']);
                            ?>
                                <tr style="background-color:#000888">
                                    <td class="dt-control"></td>
                                    <td><?php echo $instituciones[0] ?></td>
                                    <td> <?php echo $value["nombreCargo"] ?></td>
                                    <td> <?php echo $value["hsCatedra"] ?></td>
                                    <td> <?php echo $value["grado"] ?></td>
                                    <td> <?php echo $value["division"] ?></td>
                                    <td> <?php echo $value["turno"] ?></td>
                                    <td> <?php echo $value["docente"] ?></td>
                                    <td><?php echo $instituciones[1] ?? '' ?></td>
                                    <td><?php echo $instituciones[2] ?? '' ?></td>
                                    <td><?php echo $instituciones[3] ?? '' ?></td>

                                    <td><a href="editar_cargo/<?php echo $value["id_Cargo"] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                        <a href="eliminar_cargo" class="btn btn-danger btn-sm btnEliminar" id_eliminar="<?php echo $value["id_Cargo"]; ?>" pag="cargos" categoria="Cargo - Plaza N°" valorElim="<?php echo $value["numeroPlaza"]; ?>"><i class="fas fa-trash"></i></a>
                                    </td>

                                </tr>

                            <?php } ?>

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
            '<div><b>Agente:</b> ' + d[7] +
            '<br /><br /><b>Comparte con</b>' +
            '<br /><b>Institución 2:</b> ' + d[8] +
            '<br /><b>Institución 3:</b> ' + d[9] +
            '<br /><b>Institución 4:</b> ' + d[10] +
            '</div>'
        );
    }


    $(document).ready(function() {

        // Inicialización de DataTable
        let table = $('#tablaCargos').DataTable({
            scrollX: true,
            pagingType: "full_numbers",
            "language": window.espanol,
            columnDefs: [{
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
                    target: 10,
                    visible: false
                }

            ]
        });

        // Evento para mostrar y ocultar detalles
        $('#tablaCargos tbody').on('click', 'td.dt-control', function() {
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