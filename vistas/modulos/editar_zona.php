<?php

$zona = "id_ZonaSupervision";
$valor = $rutas[1];
$zona_select = ControladorZonas::ctrMostrarZonas($zona, $valor);
if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
}
if ($rol == 1){
    if ($zona_select) { ?>

        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-22 fw-bold m-0">Editar Zona de Supervisión</h4>
                </div>
            </div>

            <form method="POST">
                <div class="row"> <!-- Floating Labels -->
                    <div class="col-lg-6">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Datos de la Zona de Supervisión</h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="form-floating mb-3 mt-2">
                                    <input type="text" class="form-control" id="nombre" value="<?php echo $zona_select["zona"] ?>" name="nombre" placeholder="Nombre">
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Seleccionar Supervisor</h5>
                            </div><!-- end card header -->

                            <div class="card-body">


                                <!-- Opciones Datalist Agentes -->
                                <datalist id="OpcionesSupervisor">
                                    <?php
                                    // Mostrar todas las opciones de agentes disponibles

                                    $agentes = ControladorAgentes::ctrMostrarAgentes(NULL, NULL);
                                    foreach ($agentes as $key => $value) {
                                    ?>
                                        <option id="<?php echo $value["id_Agente"] ?>" data-id="<?php echo $value["id_Agente"] ?>"><?php echo $value["apellido"] . ", " . $value["nombre"] . ' - DNI: ' . $value["dni"] ?> </option>

                                    <?php } ?>
                                </datalist>


                                <div class="pb-3"> <!-- Datalist Agentes  -->
                                    <div class="form-floating mb-1 mt-1">
                                        <input class="form-control fs-14"
                                            list="OpcionesSupervisor"
                                            id="datalistSupervisor"
                                            placeholder="Escriba para buscar..."

                                            value="<?php echo $zona_select["supervisor"] ?>">
                                        </input>
                                        <label for=" datalistSupervisor">Escriba para buscar...</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- col -->

                    <div class="col-12">
                        <div class="row">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Seleccione las Instituciones</h5>
                                </div>
                                <div class="card-body">
                                    <!-- Pantalla Seleccionar Supervisor -->
                                    <?php //include 'seleccionar_institucion.php' 
                                    ?>

                                    <table id="tablaSelectMultiES" class="table table-striped table-hover dt-responsive nowrap w-100 tablaSelectMultiES">
                                        <div class="table-title"></div>

                                        <thead>
                                            <tr>
                                                <th>CUE</th>
                                                <th>Tipo</th>
                                                <th>N°</th>
                                                <th>Nombre</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $institucionesZona = ControladorZonas::ctrObtenerInstitucionZona($rutas[1]);
                                            $institucionesAsignadas = array_column($institucionesZona, "id_institucion");
                                            $institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
                                            // print_r($institucionesAsignadas);
                                            foreach ($institucion as $key => $value) {
                                            ?>
                                                <tr data-id_institucion="<?php echo $value['id_institucion']; ?>" style="background-color:#000888">
                                                    <td> <?php echo $value["cue"] ?></td>
                                                    <td> <?php echo $value["tipo"] ?></td>
                                                    <td> <?php echo $value["numero"] ?></td>
                                                    <td> <?php echo $value["institucion"] ?></td>
                                                </tr>

                                            <?php } ?>
                                        </tbody>

                                    </table>
                                </div>
                            </div>
                            <input type="hidden" id="institucionesSeleccionadas" name="institucionesSeleccionadas">
                        </div>
                        <?php
                        //print_r($zona_select["id_ZonaSupervision"]);

                        $guardar = new ControladorZonas();
                        $guardar->ctrEditarZonas();
                        ?>



                        <div class="col-lg-6">

                        </div>


                        <div class="row">
                            <div class="col-lg-6">
                                <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                                    <div class="d-flex flex-wrap gap-2">
                                        <input type="hidden" id="id_Supervisor" name="id_Supervisor">
                                        <input type="hidden" id="id_ZonaSupervision" name="id_ZonaSupervision" value="<?php echo $zona_select["id_ZonaSupervision"]; ?>">

                                        <a class="btn btn-outline-dark btnVolver" pag="<?php echo ControladorPlantilla::url(); ?>zonasSupervision"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</a>
                                        <button type="button" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </form>

        </div> <!-- container-fluid -->

        <?php } else { ?>
            <?php include 'no_disponible.php'; ?>
        <?php } 
}else { ?>
    <?php include 'acceso_denegado.php'; ?>
    <script>
    Swal.fire({
        title: "Error",
        text: "Permisos Insuficientes.",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
    }).then(function (result) {
    });
  </script>
<?php } ?>

<script>
    // Inicializar la variable institucionesAsignadas con los datos de PHP
    let institucionesAsignadas = <?php echo json_encode($institucionesAsignadas); ?>;

    $(document).ready(function() {
        // Asegurarse de que las institucionesAsignadas tenga los valores correctos
        console.log(institucionesAsignadas);

        // Resaltar las filas que ya están en institucionesAsignadas
        $("#tablaSelectMultiES tbody tr").each(function() {
            const institucionId = $(this).data("id_institucion"); // Obtener el ID de la institución
            if (institucionesAsignadas.includes(institucionId)) {
                // Si la institución está en institucionesAsignadas, resaltar la fila
                $(this).css("background-color", "#0000FF"); // Color azul
            }
        });

        // Manejar clic en las filas de la tabla
        $("#tablaSelectMultiES tbody").on("click", "tr", function() {
            const institucionId = $(this).data("id_institucion"); // Obtener el ID de la institución
            const row = $(this); // La fila seleccionada

            // Comprobar si la institución ya está en la lista de seleccionadas
            const index = institucionesAsignadas.indexOf(institucionId);

            if (index === -1) {
                // Si no está seleccionada, agregamos el ID y cambiamos el color de la fila a azul
                institucionesAsignadas.push(institucionId);
                row.css("background-color", "#0000FF"); // Cambiar a azul
            } else {
                // Si ya está seleccionada, la deseleccionamos y removemos el ID de la lista
                institucionesAsignadas.splice(index, 1);
                row.css("background-color", ""); // Quitar el color azul
            }

            // Actualizar el valor del campo oculto con los IDs de las instituciones seleccionadas
            $("#institucionesSeleccionadas").val(institucionesAsignadas.join(","));
        });

        // Verificar la correcta asignación de las instituciones asignadas
        console.log("Instituciones seleccionadas: ", institucionesAsignadas);
    });

    // Asignar el supervisor seleccionado al campo oculto
    const datalistSupervisor = document.getElementById('datalistSupervisor');
    const hiddenSupervisorId = document.getElementById('id_Supervisor');

    datalistSupervisor.addEventListener('input', function() {
        const inputValue = this.value;
        const options = document.getElementById('OpcionesSupervisor').options;
        let selectedSupervisorId = null;

        // Verificar si el input coincide con una opción válida
        for (let i = 0; i < options.length; i++) {
            if (options[i].value === inputValue) {
                selectedSupervisorId = options[i].getAttribute('data-id');
                break;
            }
        }

        // Actualizar el campo oculto con el ID seleccionado
        hiddenSupervisorId.value = selectedSupervisorId ? selectedSupervisorId : datalistSupervisor.getAttribute('data-id');
    });
</script>