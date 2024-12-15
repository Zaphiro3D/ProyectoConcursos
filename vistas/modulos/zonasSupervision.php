<?php
$eliminar = new ControladorZonas;
$eliminar->ctrEliminarZona();
?>
<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Zonas de Supervisión</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">
            <a href="nueva_zona" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Nueva Zona</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaES" class="table table-striped dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Zona</th>
                                <th>Supervisor</th>
                                <th>DNI</th>
                                <th>teléfono</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $zonasSupervision = ControladorZonas::ctrMostrarZonas(null, null);
                            foreach ($zonasSupervision as $key => $value) {
                            ?>
                            <tr style="background-color:#000888">
                                <td> <?php echo $value["zona"] ?></td>
                                <td> <?php echo $value["apellido"] . ' ' . $value["nombre"] ?></td>
                                <td> <?php echo $value["dni"] ?></td>
                                <td> <?php echo $value["telefono"] ?></td>
                                <td><a href="editar_zona/<?php echo $value["id_ZonaSupervision"] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                    <button
                                        class="btn btn-danger btn-sm btnEliminarZona"
                                        zona = <?php echo $value["zona"]; ?>
                                        id_ZonaSupervision = <?php echo $value["id_ZonaSupervision"]; ?>>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <?php } ?>

                        </tbody>
                    </table>
                    <input type="hidden" id="url" value="<?php echo $url; ?>">
                </div>
            </div>
        </div>
    </div>
</div>