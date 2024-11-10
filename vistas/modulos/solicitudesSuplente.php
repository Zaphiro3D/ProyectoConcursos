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
        var espanol = {
            "processing": "Procesando...",
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "emptyTable": "Ningún dato disponible en esta tabla",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "infoThousands": ",",
            "loadingRecords": "Cargando...",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sortDescending": ": Activar para ordenar la columna de manera descendente"
            },
            "buttons": {
                "copy": "Copiar",
                "colvis": "Visibilidad",
                "collection": "Colección",
                "colvisRestore": "Restaurar visibilidad",
                "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
                "copySuccess": {
                    "1": "Copiada 1 fila al portapapeles",
                    "_": "Copiadas %ds fila al portapapeles"
                },
                "copyTitle": "Copiar al portapapeles",
                "csv": "CSV",
                "excel": "Excel",
                "pageLength": {
                    "-1": "Mostrar todas las filas",
                    "_": "Mostrar %d filas"
                },
                "pdf": "PDF",
                "print": "Imprimir",
                "renameState": "Cambiar nombre",
                "updateState": "Actualizar",
                "createState": "Crear Estado",
                "removeAllStates": "Remover Estados",
                "removeState": "Remover",
                "savedStates": "Estados Guardados",
                "stateRestore": "Estado %d"
            },
            "autoFill": {
                "cancel": "Cancelar",
                "fill": "Rellene todas las celdas con <i>%d<\/i>",
                "fillHorizontal": "Rellenar celdas horizontalmente",
                "fillVertical": "Rellenar celdas verticalmentemente"
            },
            "decimal": ",",
            "searchBuilder": {
                "add": "Añadir condición",
                "button": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "clearAll": "Borrar todo",
                "condition": "Condición",
                "conditions": {
                    "date": {
                        "after": "Despues",
                        "before": "Antes",
                        "between": "Entre",
                        "empty": "Vacío",
                        "equals": "Igual a",
                        "notBetween": "No entre",
                        "notEmpty": "No Vacio",
                        "not": "Diferente de"
                    },
                    "number": {
                        "between": "Entre",
                        "empty": "Vacio",
                        "equals": "Igual a",
                        "gt": "Mayor a",
                        "gte": "Mayor o igual a",
                        "lt": "Menor que",
                        "lte": "Menor o igual que",
                        "notBetween": "No entre",
                        "notEmpty": "No vacío",
                        "not": "Diferente de"
                    },
                    "string": {
                        "contains": "Contiene",
                        "empty": "Vacío",
                        "endsWith": "Termina en",
                        "equals": "Igual a",
                        "notEmpty": "No Vacio",
                        "startsWith": "Empieza con",
                        "not": "Diferente de",
                        "notContains": "No Contiene",
                        "notStartsWith": "No empieza con",
                        "notEndsWith": "No termina con"
                    },
                    "array": {
                        "not": "Diferente de",
                        "equals": "Igual",
                        "empty": "Vacío",
                        "contains": "Contiene",
                        "notEmpty": "No Vacío",
                        "without": "Sin"
                    }
                },
                "data": "Data",
                "deleteTitle": "Eliminar regla de filtrado",
                "leftTitle": "Criterios anulados",
                "logicAnd": "Y",
                "logicOr": "O",
                "rightTitle": "Criterios de sangría",
                "title": {
                    "0": "Constructor de búsqueda",
                    "_": "Constructor de búsqueda (%d)"
                },
                "value": "Valor"
            },
            "searchPanes": {
                "clearMessage": "Borrar todo",
                "collapse": {
                    "0": "Paneles de búsqueda",
                    "_": "Paneles de búsqueda (%d)"
                },
                "count": "{total}",
                "countFiltered": "{shown} ({total})",
                "emptyPanes": "Sin paneles de búsqueda",
                "loadMessage": "Cargando paneles de búsqueda",
                "title": "Filtros Activos - %d",
                "showMessage": "Mostrar Todo",
                "collapseMessage": "Colapsar Todo"
            },
            "select": {
                "cells": {
                    "0": "",
                    "1": "1 celda seleccionada",
                    "_": "%d celdas seleccionadas"
                },
                "columns": {
                    "0": "",
                    "1": "1 columna seleccionada",
                    "_": "%d columnas seleccionadas"
                },
                "rows": {
                    "0": "",
                    "1": "1 fila seleccionada",
                    "_": "%d filas seleccionadas"
                }
            },
            "thousands": ".",
            "datetime": {
                "previous": "Anterior",
                "next": "Proximo",
                "hours": "Horas",
                "minutes": "Minutos",
                "seconds": "Segundos",
                "unknown": "-",
                "amPm": [
                    "AM",
                    "PM"
                ],
                "months": {
                    "0": "Enero",
                    "1": "Febrero",
                    "10": "Noviembre",
                    "11": "Diciembre",
                    "2": "Marzo",
                    "3": "Abril",
                    "4": "Mayo",
                    "5": "Junio",
                    "6": "Julio",
                    "7": "Agosto",
                    "8": "Septiembre",
                    "9": "Octubre"
                },
                "weekdays": [
                    "Dom",
                    "Lun",
                    "Mar",
                    "Mie",
                    "Jue",
                    "Vie",
                    "Sab"
                ]
            },
            "editor": {
                "close": "Cerrar",
                "create": {
                    "button": "Nuevo",
                    "title": "Crear Nuevo Registro",
                    "submit": "Crear"
                },
                "edit": {
                    "button": "Editar",
                    "title": "Editar Registro",
                    "submit": "Actualizar"
                },
                "remove": {
                    "button": "Eliminar",
                    "title": "Eliminar Registro",
                    "submit": "Eliminar",
                    "confirm": {
                        "_": "¿Está seguro que desea eliminar %d filas?",
                        "1": "¿Está seguro que desea eliminar 1 fila?"
                    }
                },
                "error": {
                    "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
                },
                "multi": {
                    "title": "Múltiples Valores",
                    "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                    "restore": "Deshacer Cambios",
                    "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
                }
            },
            "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
            "stateRestore": {
                "creationModal": {
                    "button": "Crear",
                    "name": "Nombre:",
                    "order": "Clasificación",
                    "paging": "Paginación",
                    "search": "Busqueda",
                    "select": "Seleccionar",
                    "columns": {
                        "search": "Búsqueda de Columna",
                        "visible": "Visibilidad de Columna"
                    },
                    "title": "Crear Nuevo Estado",
                    "toggleLabel": "Incluir:"
                },
                "emptyError": "El nombre no puede estar vacio",
                "removeConfirm": "¿Seguro que quiere eliminar este %s?",
                "removeError": "Error al eliminar el registro",
                "removeJoiner": "y",
                "removeSubmit": "Eliminar",
                "renameButton": "Cambiar Nombre",
                "renameLabel": "Nuevo nombre para %s",
                "duplicateError": "Ya existe un Estado con este nombre.",
                "emptyStates": "No hay Estados guardados",
                "removeTitle": "Remover Estado",
                "renameTitle": "Cambiar Nombre Estado"
            }
        };
        
        // Inicialización de DataTable
        let table = $('#tablaSolSuplente').DataTable({
            scrollX: true,
            pagingType:"full_numbers",
            "language": espanol,
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
