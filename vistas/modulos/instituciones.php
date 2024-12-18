<?php
$instituciones = ControladorInstituciones::ctrMostrarInstituciones(null, null);

if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
    //print_r($rol);
}
?>
<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Instituciones</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">
            <?php if ($rol == 2 || $rol == 3 || $rol == 4) { ?>
                <!-- Mostrar un mensaje informativo -->
                <button class="btn btn-secondary" disabled>
                    <i class="fas fa-plus"></i> &nbsp; No tiene permisos para agregar Instituciones
                </button>
            <?php } else { ?>
                <a href="nueva_institucion" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp; Nueva Institución</a>
            <?php } ?>
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

                                <?php if ($rol == 2 || $rol == 3 || $rol == 4) { ?>
                                    <th>Zona de Supervisión</th>
                                <?php } else { ?>
                                    <th>Zona de Supervisión</th>
                                    <th>Acciones</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($instituciones as $key => $value) {
                                $inst = $value["tipo"] . " N°" . $value["numero"] . '" ' . $value["institucion"] . '" ' . "CUE: {$value["cue"]}";
                            ?>
                                <tr style="background-color:#000888">
                                    <td> <?php echo $value["cue"] ?></td>
                                    <td> <?php echo $value["tipo"] ?></td>
                                    <td> <?php echo $value["numero"] ?></td>
                                    <td> <?php echo $value["institucion"] ?></td>
                                    <td> <?php echo $value["apellido"] . " " . $value["nombre"] ?></td>
                                    <td> <?php echo $value["dni"] ?></td>
                                    <?php if ($rol == 2 || $rol == 3 || $rol == 4) { ?>
                                        <td> <?php echo $value["zona"] ?></td>
                                    <?php } else { ?>
                                        <td> <?php echo $value["zona"] ?></td>
                                        <td><a href="editar_institucion/<?php echo $value["id_institucion"] ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                                            <button class="btn btn-danger btn-sm btnEliminar" id_eliminar=<?php echo $value["id_institucion"]; ?> pag="instituciones" categoria="Institución" valorElim="<?php echo $value["tipo"] . " N°" . $value["numero"] . " " . $value["institucion"] . " - CUE: {$value["cue"]}"; ?>"><i class="fas fa-trash"></i></button>
                                        </td>
                                    <?php } ?>
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
$eliminar->ctrEliminarInstitucion();
?>