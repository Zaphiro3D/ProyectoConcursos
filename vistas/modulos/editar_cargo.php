<?php
$id_cargo = "id_Cargo";
$valor = $rutas[1];
$cargo_select = ControladorCargos::ctrMostrarCargos($id_cargo, $valor);
// print_r($cargo_select);

$insti = explode(',', $cargo_select['instituciones']);
$id_Insti = explode(',', $cargo_select['id_instituciones']);


// Función para opciones de select días
function generarOpcionesDias()
{
    $dias = ControladorSolSuplente::ctrMostrarDatosSol("dias", "*", null);
    $opciones = '<option>...</option>';
    foreach ($dias as $value) {
        $opciones .= "<option>{$value['nombre']}</option>";
    }
    return $opciones;
}

$validador = new validador();

$controlador = new ControladorCargos();
$resultado = $controlador->ctrEditarCargo();

$errores = $resultado['errores'] ?? [];
$validado = $resultado['validado'] ?? '';

if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
}
if ($rol == 1){
    if ($cargo_select) {
    ?>
        <div class="container-xxl">
            <form method="POST" novalidate>
                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="flex-grow-1">
                        <h4 class="fs-22 fw-bold m-0">Editar Cargo</h4>
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
                                                    value="<?php echo htmlspecialchars($_POST['institucionSede'] ?? $_POST['institucion1'] ?? $insti[0] ?? ''); ?>"
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
                                                <input type="number" class="form-control <?php echo isset($errores['numeroPlaza']) ? 'is-invalid' : ''; ?>" list="numeroPlaza" name="numeroPlaza"  value= "<?php echo $_POST['numeroPlaza'] ?? $cargo_select['numeroPlaza'] ?? ''; ?>" placeholder="N° Plaza" required>
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
                                                    <option value="" disabled <?php echo empty($_POST['id_NombreCargo']) && empty($cargo_select["id_NombreCargo"]) ? 'selected' : ''; ?>>
                                                        Seleccione un cargo
                                                    </option>

                                                    <!-- Opciones dinámicas -->
                                                    <?php 
                                                    $cargos = ControladorSolSuplente::ctrMostrarDatosSol("nombres_cargos", "*", null);
                                                    foreach ($cargos as $key => $value): ?>
                                                        <option 
                                                            value="<?php echo $value["id_NombreCargo"]; ?>" 
                                                            <?php
                                                                // Priorizar selección del formulario si fue enviado
                                                                if (isset($_POST['id_NombreCargo']) && $_POST['id_NombreCargo'] == $value["id_NombreCargo"]) {
                                                                    echo 'selected';
                                                                }
                                                                // Si no hay envío, mostrar el rol actual del agente
                                                                elseif (!isset($_POST['id_NombreCargo']) && $cargo_select["id_NombreCargo"] == $value["id_NombreCargo"]) {
                                                                    echo 'selected';
                                                                }
                                                            ?>>
                                                            <?php echo htmlspecialchars($value["nombreCargo"]); ?>


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
                                                    <option value="" disabled <?php echo empty($_POST['id_Turno']) && empty($cargo_select["id_Turno"]) ? 'selected' : ''; ?>>
                                                        Seleccione un turno
                                                    </option>

                                                    <!-- Opciones dinámicas -->
                                                    <?php 
                                                    $turnos = ControladorSolSuplente::ctrMostrarDatosSol("turnos", "*", null);
                                                    foreach ($turnos as $key => $value): ?>
                                                        <option 
                                                            value="<?php echo $value["id_Turno"]; ?>" 
                                                            <?php
                                                                // Priorizar selección del formulario si fue enviado
                                                                if (isset($_POST['id_Turno']) && $_POST['id_Turno'] == $value["id_Turno"]) {
                                                                    echo 'selected';
                                                                }
                                                                // Si no hay envío, mostrar el rol actual del agente
                                                                elseif (!isset($_POST['id_Turno']) && $cargo_select["id_Turno"] == $value["id_Turno"]) {
                                                                    echo 'selected';
                                                                }
                                                            ?>>
                                                            <?php echo htmlspecialchars($value["turno"]); ?>


                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="id_Turno">Turno</label>
                                                <div class="invalid-feedback">
                                                    <?php echo $errores['id_Turno'] ?? 'Por favor, seleccione un turno válido.'; ?>
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
                                                    >
                                                    <!-- Opción predeterminada -->
                                                    <option value="" <?php echo empty($_POST['id_Grado']) && empty($cargo_select["id_Grado"]) ? 'selected' : ''; ?>>
                                                    </option>

                                                    <!-- Opciones dinámicas -->
                                                    <?php 
                                                    $grados = ControladorSolSuplente::ctrMostrarDatosSol("grados", "*", null);
                                                    foreach ($grados as $key => $value): ?>
                                                        <option 
                                                            value="<?php echo $value["id_Grado"]; ?>" 
                                                            <?php
                                                                // Priorizar selección del formulario si fue enviado
                                                                if (isset($_POST['id_Grado']) && $_POST['id_Grado'] == $value["id_Grado"]) {
                                                                    echo 'selected';
                                                                }
                                                                // Si no hay envío, mostrar el rol actual del agente
                                                                elseif (!isset($_POST['id_Grado']) && $cargo_select["id_Grado"] == $value["id_Grado"]) {
                                                                    echo 'selected';
                                                                }
                                                            ?>>
                                                            <?php echo htmlspecialchars($value["grado"]); ?>


                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="id_Grado">Grado</label>
                                                <div class="invalid-feedback">
                                                    <?php echo $errores['id_Grado'] ?? 'Por favor, seleccione un grado válido.'; ?>
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
                                                    >
                                                    <!-- Opción predeterminada -->
                                                    <option value="" <?php echo empty($_POST['id_Division']) && empty($cargo_select["id_Division"]) ? 'selected' : ''; ?>>
                                                    </option>

                                                    <!-- Opciones dinámicas -->
                                                    <?php 
                                                    $divisiones = ControladorSolSuplente::ctrMostrarDatosSol("divisiones", "*", null);
                                                    foreach ($divisiones as $key => $value): ?>
                                                        <option 
                                                            value="<?php echo $value["id_Division"]; ?>" 
                                                            <?php
                                                                // Priorizar selección del formulario si fue enviado
                                                                if (isset($_POST['id_Division']) && $_POST['id_Division'] == $value["id_Division"]) {
                                                                    echo 'selected';
                                                                }
                                                                // Si no hay envío, mostrar el rol actual del agente
                                                                elseif (!isset($_POST['id_Division']) && $cargo_select["id_Division"] == $value["id_Division"]) {
                                                                    echo 'selected';
                                                                }
                                                            ?>>
                                                            <?php echo htmlspecialchars($value["division"]); ?>


                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <label for="id_Division">División</label>
                                                <div class="invalid-feedback">
                                                    <?php echo $errores['id_Division'] ?? 'Por favor, seleccione una división válido.'; ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-lg-1">
                                            <div class="form-floating mb-3">
                                                <div class="form-floating">
                                                    <input type="number" class="form-control <?php echo isset($errores['hsCatedra']) ? 'is-invalid' : ''; ?>" id="hsCatedra" name="hsCatedra"  value= "<?php echo $_POST['hsCatedra'] ?? $cargo_select['hsCatedra'] ?? ''; ?>"  placeholder="hsCat">
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
                                                <input type="text" class="form-control" id="nombreDocente" name="nombreDocente"  value= "<?php echo htmlspecialchars($_POST['nombreDocente'] ?? $cargo_select['nombreDocente'] ?? ''); ?>" placeholder="Nombre">
                                                <label for="nombreDocente">Nombre</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-4">
                                            <div class="form-floating mb-1">
                                                <input type="text" class="form-control" id="apellidoDocente" name="apellidoDocente"  value= "<?php echo htmlspecialchars($_POST['apellidoDocente'] ?? $cargo_select['apellidoDocente'] ?? ''); ?>" placeholder="Apellido">
                                                <label for="apellidoDocente">Apellido</label>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <div class="form-floating mb-1">
                                                <input type="number" class="form-control <?php echo isset($errores['dniDocente']) ? 'is-invalid' : ''; ?>" id="dniDocente" name="dniDocente" value= "<?php echo htmlspecialchars($_POST['dniDocente'] ?? $cargo_select['dniDocente'] ?? ''); ?>" placeholder="DNI">
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
                                            
                                            if (isset($_POST['gridRadiosComparte'])){
                                                // Obtener el valor enviado por el usuario
                                                $checkSeleccionado = $_POST['gridRadiosComparte'];
                                            } else{
                                                $indiceMaximo = max(array_keys($insti));
                                                switch ($indiceMaximo) {
                                                    case 0:
                                                        $checkSeleccionado = "noComparte";
                                                        break;

                                                    case 1:
                                                        $checkSeleccionado = "comparte1";
                                                        break;

                                                    case 2:
                                                        $checkSeleccionado = "comparte2";
                                                        break;
                                                        
                                                    case 3:
                                                        $checkSeleccionado = "comparte3";
                                                        break;
                                                    
                                                    default:
                                                        $checkSeleccionado = "noComparte";
                                                        break;
                                                }
                                            }
                                            
                                            
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


                                <!-- Opciones Datalist Instituciones        -->
                                <datalist id="OpcionesInstitucion">
                                    <?php 
                                    $institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
            
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
                                        $valorInstitucion = $_POST['institucion' . $i + 1 ] ?? $insti[$i] ?? '';
                                        $id_Institucion = $_POST['instituciones'][$i]['id_Institucion'] ?? $id_Insti[$i] ?? '';
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
                                                    value="<?= htmlspecialchars($id_Institucion); ?>"
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
                                    <input type="hidden" name="id_Cargo" value="<?php echo $cargo_select["id_Cargo"]; ?>">

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

<!-- Script js específico para modificaciones dinámicas de formulario -->
<script src="<?php echo $url; ?>vistas/assets/js/cargos.js"></script>

