<?php

$zona = "id_ZonaSupervision";
$valor = $rutas[1];
$zona_select = ControladorZonas::ctrMostrarZonas($zona, $valor);

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
                                        data-id=""
                                        value=""><?php echo "Supervisor Actual ". $zona_select["apellido"] . ", " . $zona_select["nombre"] . ' - DNI: ' . $zona_select["dni"] ?>
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
                                <?php include 'seleccionar_institucion.php' ?>
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

                                    <a class="btn btn-outline-dark btnVolver" pag="zonasSupervision"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</a>
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
    <h3>Zona no disponible</h3>
<?php } ?>

<script>
    document.getElementById('datalistSupervisor').addEventListener('input', function() {
        // Obtener el valor del input
        var inputValue = this.value;

        // Obtener todas las opciones del datalist
        var options = document.getElementById('OpcionesSupervisor').options;

        // Buscar el ID del agente seleccionado
        for (var i = 0; i < options.length; i++) {
            if (options[i].value === inputValue) {

                // Asignar el ID del agente al input oculto 
                document.getElementById('id_Supervisor').value = options[i].getAttribute('data-id');
                break;
            }
        }
    });

    // Pasar el array PHP como un objeto JavaScript para que seleccione las especialidades
    const institucionesSeleccionadas = <?php echo json_encode($institucionesAsignadas); ?>;
</script>