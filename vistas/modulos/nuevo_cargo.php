<?php
// Para opciones de selects
$institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
$cargos = ControladorSolSuplente::ctrMostrarDatosSol("nombres_cargos", "*", null);
$turno = ControladorSolSuplente::ctrMostrarDatosSol("turnos", "*", null);
$grado = ControladorSolSuplente::ctrMostrarDatosSol("grados", "*", null);
$division = ControladorSolSuplente::ctrMostrarDatosSol("divisiones", "*", null);

$validador = new validador();

$controlador = new ControladorCargos();
$resultado = $controlador->ctrAgregarCargo();


$errores = $resultado['errores'] ?? [];
$validado = $resultado['validado'] ?? '';

if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
}

if ($rol==1) {

?>

<div class="container-xxl">
    <form method="POST" novalidate>
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-22 fw-bold m-0">Nuevo Cargo</h4>
            </div>
        </div>

        <div class="col-12"> <!-- Floating Labels -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Institución Sede</h5>
                            </div><!-- end card header -->

                            <div class="card-body">

                                <fieldset class="row mb-2 mt-1">
                                    <!-- Escuela Sede -->
                                    <!-- Debe completarse automaticamente dependiendo desde que institucion ingresa al sistema -->
                                    <div>

                                        <label for="institucionSede" id="lblinstitucionsede" class="form-label">Institución Sede</label>
                                        <input 
                                            class="form-control <?php echo isset($errores['insti1']) ? 'is-invalid' : ''; ?>" 
                                            list="OpcionesInstitucion" 
                                            id="institucionSede" 
                                            
                                            name="institucionSede" 
                                            placeholder="Escriba para buscar..."
                                            oninput="autoSelectBestMatch('institucionSede', 'OpcionesInstitucion', 'idInstitucion1');"
                                            value="<?php echo htmlspecialchars($_POST['institucionSede'] ?? $_POST['institucion1'] ?? ''); ?>"
                                            required
                                        >
                                        <div class="invalid-feedback"><?php echo $errores['insti1'] ?? 'Por favor, complete este campo.'; ?></div> 
                                    </div>
                                </fieldset>

                            </div>
                        </div> <!-- card datos sede -->
                    </div> <!-- col -->


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos del Cargo</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control <?php echo isset($errores['numeroPlaza']) ? 'is-invalid' : ''; ?>" list="numeroPlaza" name="numeroPlaza"  value= "<?php echo $_POST['numeroPlaza'] ?? ''; ?>" placeholder="N° Plaza" required>
                                        <label for="plaza">N° Plaza</label>
                                        <div class="invalid-feedback"><?php echo $errores['numeroPlaza'] ?? 'Por favor, complete este campo.'; ?></div> 
                                    </div>
                                </div>

                                <!-- Nombres de Cargos -->
                                <div class="col-lg-9">
                                    <div class="form-floating mb-3"> 
                                        <select 
                                            class="form-select <?php echo isset($errores['id_NombreCargo']) ? 'is-invalid' : ''; ?>" 
                                            id="id_NombreCargo" 
                                            name="id_NombreCargo" 
                                            aria-label="id_NombreCargo" 
                                            required>
                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_NombreCargo']) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php 
                                            
                                            foreach ($cargos as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_NombreCargo"]; ?>" 
                                                    <?php echo (isset($_POST['id_NombreCargo']) && intval($_POST['id_NombreCargo']) == $value["id_NombreCargo"]) ? 'selected' : ''; ?>>
                                                    <?php echo ($value["nombreCargo"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_NombreCargo">Cargo</label>
                                        <div class="invalid-feedback">
                                            <?php echo $errores['id_NombreCargo'] ?? 'Por favor, seleccione un cargo válido.'; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Turnos -->
                                <div class="col-lg-5">
                                    <div class="form-floating mb-3">
                                        <select 
                                            class="form-select <?php echo isset($errores['id_Turno']) ? 'is-invalid' : ''; ?>" 
                                            id="id_Turno" 
                                            name="id_Turno" 
                                            aria-label="id_Turno" 
                                            required>
                                            
                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_Turno']) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php 
                                            
                                            foreach ($turno as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_Turno"]; ?>" 
                                                    <?php echo (isset($_POST['id_Turno']) && intval($_POST['id_Turno']) == $value["id_Turno"]) ? 'selected' : ''; ?>>
                                                    <?php echo ($value["turno"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_Turno">Turno</label>
                                        <div class="invalid-feedback">
                                            <?php echo $errores['id_Turno'] ?? ''; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Grados -->
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select 
                                            class="form-select <?php echo isset($errores['id_Grado']) ? 'is-invalid' : ''; ?>" 
                                            id="id_Grado" 
                                            name="id_Grado" 
                                            aria-label="id_Grado" 
                                            required>

                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_Grado']) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php 
                                            
                                            foreach ($grado as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_Grado"]; ?>" 
                                                    <?php echo (isset($_POST['id_Grado']) && intval($_POST['id_Grado']) == $value["id_Grado"]) ? 'selected' : ''; ?>>
                                                    <?php echo ($value["grado"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_Grado">Grado</label>
                                        <div class="invalid-feedback">
                                            <?php echo $errores['id_Grado'] ?? ''; ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Divisiones -->
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select 
                                            class="form-select <?php echo isset($errores['id_Division']) ? 'is-invalid' : ''; ?>" 
                                            id="id_Division" 
                                            name="id_Division" 
                                            aria-label="id_Division" 
                                            required>

                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_Division']) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php 
                                            
                                            foreach ($division as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_Division"]; ?>" 
                                                    <?php echo (isset($_POST['id_Division']) && intval($_POST['id_Division']) == $value["id_Division"]) ? 'selected' : ''; ?>>
                                                    <?php echo ($value["division"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <label for="id_Division">División</label>
                                        <div class="invalid-feedback">
                                            <?php echo $errores['id_Division'] ?? ''; ?>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-floating mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control <?php echo isset($errores['hsCatedra']) ? 'is-invalid' : ''; ?>" id="hsCatedra" name="hsCatedra"  value= "<?php echo htmlspecialchars($_POST['hsCatedra'] ?? ''); ?>"  placeholder="hsCat">
                                            <label for="hsCatedra">Hs. Cát.</label>
                                            <div class="invalid-feedback">
                                                <?php echo $errores['hsCatedra'] ?? ''; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div> <!-- col -->
            </div> <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos del Agente</h5>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="nombreDocente" name="nombreDocente"  value= "<?php echo htmlspecialchars($_POST['nombreDocente'] ?? ''); ?>" placeholder="Nombre">
                                        <label for="nombreDocente">Nombre</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="apellidoDocente" name="apellidoDocente"  value= "<?php echo htmlspecialchars($_POST['apellidoDocente'] ?? ''); ?>" placeholder="Apellido">
                                        <label for="apellidoDocente">Apellido</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-floating mb-1">
                                        <input type="number" class="form-control <?php echo isset($errores['dniDocente']) ? 'is-invalid' : ''; ?>" id="dniDocente" name="dniDocente" value= "<?php echo htmlspecialchars($_POST['dniDocente'] ?? ''); ?>" placeholder="DNI">
                                        <label for="dniDocente">Número de DNI sin puntos</label>
                                        <div class="invalid-feedback"><?php echo $errores['dniDocente'] ?? ''; ?></div> 
                                    </div>
                                </div>

                            </div> <!-- row -->
                        </div> <!-- card body -->
                    </div> <!-- card -->
                </div> <!-- col -->

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">¿Comparte con otra institución?</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <fieldset class="row ">
                                <!-- <legend class="col-form-label pt-0 fs-14">¿Comparte con otra institución?</legend> -->
                                <div class="row row-cols-lg-auto g-2 align-items-center">
                                    <?php
                                    // Obtener el valor enviado por el usuario, si existe
                                    $checkSeleccionado = $_POST['gridRadiosComparte'] ?? 'noComparte';
                                    ?>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" 
                                            type="radio" 
                                            name="gridRadiosComparte" 
                                            id="noComparte" 
                                            value="noComparte" 
                                            <?= $checkSeleccionado === 'noComparte' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="noComparte">
                                            No comparte
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" 
                                            type="radio" 
                                            name="gridRadiosComparte" 
                                            id="comparte1" 
                                            value="comparte1" 
                                            <?= $checkSeleccionado === 'comparte1' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="comparte1">
                                            Comparte con 1 institución
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" 
                                            type="radio" 
                                            name="gridRadiosComparte" 
                                            id="comparte2" 
                                            value="comparte2" 
                                            <?= $checkSeleccionado === 'comparte2' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="comparte2">
                                            Comparte con 2 instituciones
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" 
                                            type="radio" 
                                            name="gridRadiosComparte" 
                                            id="comparte3" 
                                            value="comparte3" 
                                            <?= $checkSeleccionado === 'comparte3' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="comparte3">
                                            Comparte con 3 instituciones
                                        </label>
                                    </div>


                                </div>
                            </fieldset>
                        </div>
                    </div> <!-- card comparte -->
                </div> <!-- col -->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Instituciones</h5>
                        </div><!-- end card header -->


                        <!-- Opciones Datalist Instituciones   -->
                        <datalist id="OpcionesInstitucion">
                            <?php 
                            
    
                            foreach ($institucion as $key => $value) { ?>
                                <option 
                                    value="<?php echo $value["institucion"] . ' ' . ' N°' . $value["numero"] . ' (CUE: ' . $value["cue"] . ')'; ?>" 
                                    id="<?php echo $value["id_institucion"]; ?>"
                                    data-id="<?php echo $value["id_institucion"]; ?>"
                                >
                                </option>
                            <?php } ?>
                        </datalist>

                        <div class="card-body">

                        <?php
                        // Array con las etiquetas para cada institución
                        $labels = [
                            'Institución Sede',
                            'Segunda Institución',
                            'Tercera Institución',
                            'Cuarta Institución'
                        ];

                        for ($i = 0; $i < count($labels); $i++): 
                            // Obtener el valor previamente enviado si existe
                            if($i == 0){
                                $valorInstitucion = htmlspecialchars($_POST['institucion1'] ?? $_POST['institucionSede'] ?? '');
                            }else{
                                // $valorInstitucion = $_POST['instituciones'][$i]['id_Institucion'] ?? '';
                                $valorInstitucion = ControladorInstituciones::ctrObtenerNombreInstitucion($_POST['instituciones'][$i]['id_Institucion'] ?? '');
                            }
                        ?>
                            <div class="row" id="Est<?= $i + 1 ?>"> <!-- Establecimiento <?= $i + 1 ?> -->
                                <div class="pb-2"> <!-- Datalist Instituciones <?= $i + 1 ?> -->
                                    <label for="institucion<?= $i + 1 ?>" id="lblinstitucion<?= $i + 1 ?>" class="form-label"><?= $labels[$i] ?></label>
                                    <input 
                                        class="form-control <?= isset($errores["insti" . ($i + 1)]) ? 'is-invalid' : '' ?>" 
                                        list="OpcionesInstitucion" 
                                        id="institucion<?= $i + 1 ?>" 
                                        name="instituciones[<?= $i ?>][id_Institucion]" 
                                        placeholder="Escriba para buscar..."
                                        value="<?= htmlspecialchars($valorInstitucion); ?>"
                                        oninput="autoSelectBestMatch('institucion<?= $i + 1 ?>', 'OpcionesInstitucion', 'idInstitucion<?= $i + 1 ?>');"
                                    >
                                    <div class="invalid-feedback">
                                        <?= $errores["insti" . ($i + 1)] ?? 'Por favor, complete este campo.'; ?>
                                    </div>
                                    <input 
                                        type="hidden" 
                                        id="idInstitucion<?= $i + 1 ?>" 
                                        name="instituciones[<?= $i ?>][id_Institucion]" 
                                        value="<?= htmlspecialchars($valorInstitucion); ?>"
                                    >
                                    
                                </div>
                            </div> <!-- Fin Establecimiento <?= $i + 1 ?> -->
                        <?php endfor; ?>


                        </div>
                    </div>
                </div> <!-- col -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-dark btnVolver" pag="<?php echo ControladorPlantilla::url(); ?>cargos"> <i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button>
                            <button type="submit" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
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

<!-- Script js específico para modificaciones dinámicas de formulario -->
<script src="<?php echo $url; ?>vistas/assets/js/cargos.js"></script>