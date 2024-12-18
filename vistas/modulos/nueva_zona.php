<?php
if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
}

if ($rol==1) {
?>

<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nueva Zona de Supervisión</h4>
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
                            <input type="text" class="form-control" id="nombre" placeholder="Nombre" name="nombre">
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
                            $agentes = ControladorAgentes::ctrMostrarAgentes(NULL, NULL);
                            foreach ($agentes as $key => $value) {
                            ?>
                                <option id="<?php echo $value["id_Agente"] ?>" data-id="<?php echo $value["id_Agente"] ?>"><?php echo $value["apellido"] . ", " . $value["nombre"] . ' - DNI: ' . $value["dni"] ?> </option>
                            <?php } ?>
                        </datalist>

                        <div class="pb-3"> <!-- Datalist Agentes-->
                            <div class="form-floating mb-1 mt-1">
                                <input class="form-control fs-14" list="OpcionesSupervisor" id="datalistSupervisor" placeholder="Escriba para buscar..."></input>
                                <label for="datalistSupervisor">Escriba para buscar...</label>
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
                             <!--Pantalla Seleccionar Supervisor -->
                            <?php include 'seleccionar_institucion.php'
                            ?>
                        </div>
                    </div>
                <input type="hidden" name="institucionesSeleccionadas" id="institucionesSeleccionadas">
                </div>

                <?php
                $guardar = new ControladorZonas();
                $guardar->ctrAgregarZona();
                ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="d-flex flex-wrap gap-2">
                                <input type="hidden" name="id_Supervisor" id="id_Supervisor">
                                <button type="button" class="btn btn-outline-dark btnVolver" pag="<?php echo ControladorPlantilla::url(); ?>zonasSupervision"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button>
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
</script>