<?php
// Para opciones de selects
$institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
$cargos = ControladorSolSuplente::ctrMostrarDatosSol("nombres_cargos", "*", null);
$turno = ControladorSolSuplente::ctrMostrarDatosSol("turnos", "*", null);
$grado = ControladorSolSuplente::ctrMostrarDatosSol("grados", "*", null);
$division = ControladorSolSuplente::ctrMostrarDatosSol("divisiones", "*", null);
$dias = ControladorSolSuplente::ctrMostrarDatosSol("dias", "*", null);

//Controlador para la edición
$controlador = new ControladorSolSuplente();
$resultado = $controlador->ctrEditarSolicitud();

//Validación
$validador = new validador();
$errores = $resultado['errores'] ?? [];
$validado = $resultado['validado'] ?? '';

//Necesario para cargar datos a editar
$id_solic = "id_SolSuplente";

if (isset($rutas[1])){
    $valor = $rutas[1];
    $solic_select = ControladorSolSuplente::ctrMostrarSolSuplente($id_solic, $valor);
    // Procesa las instituciones, id 
    $insti = explode(',', $solic_select['instituciones']);
    $id_Insti = explode(',', $solic_select['id_instituciones']);
    

    //Procesa los horarios
    $horariosOrganizados = ControladorSolSuplente::ctrMostrarHorariosSol($valor);
}

if ($solic_select) {
?>


<div class="container-xxl">
    <form method="POST" name="formSolic" novalidate>
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-22 fw-bold m-0">Editar Solicitud de Suplente</h4>
            </div>
        </div>
        
        <div class="col-12"> <!-- Floating Labels -->
            <div class= "row">
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
                                            value="<?php echo htmlspecialchars($_POST['institucionSede'] ?? $_POST['institucion1'] ?? $insti[0]?? ''); ?>"
                                            required
                                            readonly
                                        >
                                        <div class="invalid-feedback"><?php echo $errores['insti1'] ?? 'Por favor, complete este campo.'; ?></div> 
                                    </div>
                                </fieldset>
                            </div>
                        </div>  <!-- card datos sede -->
                    </div>  <!-- col -->   


                    <div class="card">
                        <div class="card-header">
                            <h5 
                                class="card-title mb-0">Datos del Cargo
                                <small class="text-body-secondary"> <br>Complete el número de plaza primero</small>
                            </h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input 
                                            type="number" 
                                            class="form-control border-primary border-3 <?php echo isset($errores['numeroPlaza']) ? 'is-invalid' : ''; ?>" 
                                            list="numeroPlaza"    
                                            name="numeroPlaza" 
                                            id="numeroPlaza" 
                                            value= "<?php echo $plaza ?? $_POST['numeroPlaza'] ?? $solic_select['numeroPlaza'] ?? ''; ?>" 
                                            placeholder="N° Plaza" 
                                            required
                                            readonly
                                            >
                                        <label for="numeroPlaza">N° Plaza</label>
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
                                            readonly
                                            disabled
                                            required>
                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_NombreCargo']) && (empty($solic_select) || empty($solic_select["id_NombreCargo"])) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php foreach ($cargos as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_NombreCargo"]; ?>" 
                                                    
                                                    <?php
                                                    // Priorizar selección del formulario si fue enviado
                                                    if (isset($_POST['id_NombreCargo']) && $_POST['id_NombreCargo'] == $value["id_NombreCargo"]) {
                                                        echo 'selected';
                                                    }
                                                    // Si no hay envío, verificar si $solic_select está definido y tiene el índice id_NombreCargo
                                                    elseif (!isset($_POST['id_NombreCargo']) && !empty($solic_select) && isset($solic_select["id_NombreCargo"]) && $solic_select["id_NombreCargo"] == $value["id_NombreCargo"]) {
                                                        echo 'selected';
                                                    }
                                                    ?>>
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
                                            disabled
                                            required>
                                            
                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_Turno']) && (empty($solic_select) || empty($solic_select["id_Turno"])) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php foreach ($turno as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_Turno"]; ?>" 
                                                    <?php
                                                        // Priorizar selección del formulario si fue enviado
                                                        if (isset($_POST['id_Turno']) && $_POST['id_Turno'] == $value["id_Turno"]) {
                                                            echo 'selected';
                                                        }
                                                        // Si no hay envío, verificar si $solic_select está definido y tiene el índice id_Turno
                                                        elseif (!isset($_POST['id_Turno']) && !empty($solic_select) && isset($solic_select["id_Turno"]) && $solic_select["id_Turno"] == $value["id_Turno"]) {
                                                            echo 'selected';
                                                        }
                                                    ?>>
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
                                            class="form-select <?php echo isset($errores['id_Grado'])  ? 'is-invalid' : ''; ?>" 
                                            id="id_Grado" 
                                            name="id_Grado" 
                                            aria-label="id_Grado" 
                                            disabled
                                            required>

                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_Grado']) && (empty($solic_select) || empty($solic_select["id_Grado"])) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php foreach ($grado as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_Grado"]; ?>" 
                                                    <?php
                                                        // Priorizar selección del formulario si fue enviado
                                                        if (isset($_POST['id_Grado']) && $_POST['id_Grado'] == $value["id_Grado"]) {
                                                            echo 'selected';
                                                        }
                                                        // Si no hay envío, verificar si $solic_select está definido y tiene el índice id_Grado
                                                        elseif (!isset($_POST['id_Grado']) && !empty($solic_select) && isset($solic_select["id_Grado"]) && $solic_select["id_Grado"] == $value["id_Grado"]) {
                                                            echo 'selected';
                                                        }
                                                    ?>>
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
                                            disabled
                                            required>

                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($_POST['id_Division']) && (empty($solic_select) || empty($solic_select["id_Division"])) ? 'selected' : ''; ?>> </option>

                                            <!-- Opciones dinámicas -->
                                            <?php foreach ($division as $key => $value): ?>
                                                <option 
                                                    value="<?php echo $value["id_Division"]; ?>" 
                                                    <?php
                                                        // Priorizar selección del formulario si fue enviado
                                                        if (isset($_POST['id_Division']) && $_POST['id_Division'] == $value["id_Division"]) {
                                                            echo 'selected';
                                                        }
                                                        // Si no hay envío, verificar si $solic_select está definido y tiene el índice id_Division
                                                        elseif (!isset($_POST['id_Division']) && !empty($solic_select) && isset($solic_select["id_Division"]) && $solic_select["id_Division"] == $value["id_Division"]) {
                                                            echo 'selected';
                                                        }
                                                    ?>>
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
                                            <input type="number" class="form-control <?php echo isset($errores['hsCatedra']) ? 'is-invalid' : ''; ?>" id="hsCatedra" name="hsCatedra"  value= "<?php echo htmlspecialchars($_POST['hsCatedra'] ?? $solic_select['hsCatedra'] ?? ''); ?>"  placeholder="hsCat" readonly>
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
                </div>  <!-- col -->
            </div>  <!-- row -->
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos del Agente</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div  class="row">
                                <div class="col-lg-12">
                                    <div class="col-lg-12">
                                        <div class="form-floating my-3">
                                            <input type="text" class="form-control <?php echo isset($errores['nombreDocente']) ? 'is-invalid' : ''; ?>" id="nombreDocente" name="nombreDocente"  value= "<?php echo htmlspecialchars($_POST['nombreDocente'] ?? $solic_select['nombreDocente'] ?? ''); ?>" placeholder="Nombre">
                                            <label for="nombreDocente">Nombre</label>
                                            <div class="invalid-feedback"><?php echo $errores['nombreDocente'] ?? ''; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control <?php echo isset($errores['apellidoDocente']) ? 'is-invalid' : ''; ?>" id="apellidoDocente" name="apellidoDocente"  value= "<?php echo htmlspecialchars($_POST['apellidoDocente'] ?? $solic_select['apellidoDocente'] ?? ''); ?>" placeholder="Apellido">
                                            <label for="apellidoDocente">Apellido</label>
                                            <div class="invalid-feedback"><?php echo $errores['apellidoDocente'] ?? ''; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                                        <div class="form-floating mb-3">
                                            <input type="number" class="form-control <?php echo isset($errores['dniDocente']) ? 'is-invalid' : ''; ?>" id="dniDocente" name="dniDocente" value= "<?php echo htmlspecialchars($_POST['dniDocente'] ?? $solic_select['dniDocente'] ?? ''); ?>" placeholder="DNI">
                                            <label for="dniDocente">Número de DNI sin puntos</label>
                                            <div class="invalid-feedback"><?php echo $errores['dniDocente'] ?? ''; ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>  <!-- row -->
                            
                        </div>  <!-- card body -->
                    </div>  <!-- card -->
                </div>  <!-- col -->

                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Motivo</h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                
                                <div class="row">
                                    <!-- Opciones Datalist Motivo -->
                                    <datalist id="opcionesMotivo">
                                        <?php
                                        $motivoSol = ControladorSolSuplente::ctrMostrarDatosSol("motivos_suplencia");
                                        $motivoSelec = ControladorSolSuplente::ctrMostrarDatosSol("motivos_suplencia", ' * ', " WHERE id_MotivoSuplencia = " . $solic_select['id_MotivoSuplencia'] );
                                        
                                        foreach ($motivoSelec as $key => $value) {
                                            $articulo = ($value["articulo"] !== '' && $value["articulo"] !== 0) ? $value["articulo"] . " ": '';
                                            $inciso = ($value["inciso"] !== '' && $value["inciso"] !== '0') ? ' "' . $value["inciso"] . '" - ' : '';
                                            $resolucion = ($value["resolucion"] !== '' && $value["resolucion"] !== 0) ? $value["resolucion"] . " - " : '';
                                            $motivo = $value["motivo"];
                                            $motivoFinal = $articulo . $inciso . $resolucion . $motivo;
                                        }

                                        foreach ($motivoSol as $key => $value) {
                                            $articulo = ($value["articulo"] !== '' && $value["articulo"] !== 0) ? $value["articulo"] . " ": '';
                                            $inciso = ($value["inciso"] !== '' && $value["inciso"] !== '0') ? ' "' . $value["inciso"] . '" - ' : '';
                                            $resolucion = ($value["resolucion"] !== '' && $value["resolucion"] !== 0) ? $value["resolucion"] . " - " : '';
                                            $motivo = $value["motivo"];
                                        ?>
                                        
                                            <option data-id="<?php echo $value["id_MotivoSuplencia"]; ?>"><?php echo $articulo . $inciso . $resolucion . $motivo; ?></option>
                                        <?php } ?>
                                    </datalist>

                                    <div class="pb-1"> <!-- Datalist Motivo -->
                                        <!-- <div class="form-floating"> -->
                                            <label for="motivo" id="lblIdMotivo" class="form-label">Motivo</label>
                                            <input 
                                                class="form-control fs-14 <?= isset($errores["insti" . ($i + 1)]) ? 'is-invalid' : '' ?>" 
                                                list="opcionesMotivo" 
                                                id="motivo" 
                                                name="motivo" 
                                                placeholder="Escriba para buscar..."
                                                value="<?php echo htmlspecialchars($_POST['motivo'] ?? $motivoFinal ?? ''); ?>"
                                                oninput="autoSelectBestMatch('motivo', 'opcionesMotivo', 'idMotivo')"
                                            >
                                        <!-- </div> -->
                                        <div class="invalid-feedback">
                                            <?= $errores["motivo"] ?? 'Por favor, complete este campo.'; ?>
                                        </div>
                                        <input 
                                            type="hidden" 
                                            id="idMotivo" 
                                            name="idMotivo" 
                                            value="<?= $valorInstitucion = htmlspecialchars( $_POST['idMotivo'] ??  $solic_select['id_MotivoSuplencia'] ?? ''); ?>"
                                        >

                                    </div>
    
                                </div>
                            </div>
                        </div>
                    </div>  <!-- col -->


                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Datos del Trámite</h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="row ">
                                    <div class="col-lg-6 mb-1">
                                        <label class="form-label">Fecha Inicio</label>
                                        <input type="text" class="form-control AR-datepicker <?php echo isset($errores['fechaInicio']) ? 'is-invalid' : ''; ?>" id="fechaInicio" name="fechaInicio" value= "<?php echo htmlspecialchars($_POST['fechaInicio'] ?? $solic_select['fechaInicio'] ?? ''); ?>" placeholder="Fecha Inicio">
                                        <div class="invalid-feedback"><?php echo $errores['fechaInicio'] ?? 'Debe completar este campo'; ?></div>
                                    </div>         
                                    
                                    <div class="col-lg-6 mb-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- Label de Fecha Fin -->
                                            <label class="form-label mb-0">Fecha Fin</label>

                                            <!-- Checkbox de ¿Abierto? -->
                                            <div class="form-check d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input " id="checkAbierto" name="checkAbierto" style="margin-right: 5px;" <?= $_POST['checkAbierto'] ?? ''; ?> >
                                                <label class="form-check-label" for="checkAbierto">¿Fin Abierto?</label>
                                            </div>
                                        </div>
                                        
                                        <!-- Campo de entrada para la fecha -->
                                        <div class="mt-2">
                                            <input type="text" class="form-control AR-datepicker <?php echo isset($errores['fechaFin']) ? 'is-invalid' : ''; ?>" id="fechaFin" name="fechaFin" value= "<?php echo htmlspecialchars($_POST['fechaFin'] ?? $solic_select['fechaFin'] ?? ''); ?>" placeholder="Fecha Fin">
                                            <div class="invalid-feedback"><?php echo $errores['fechaFin'] ?? 'Debe completar este campo'; ?></div>
                                        </div> 
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>  <!-- col -->
                </div>  <!-- col -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-header">
                            <h5 class="card-title mb-0">Observaciones</h5>
                        </div><!-- end card header -->
                        
                        <div class="card-body">
                            <div class="col-lg-12">
                                <div class="form-floating my-3">
                                    <input type="text" class="form-control <?php echo isset($errores['observaciones']) ? 'is-invalid' : ''; ?>" id="observaciones" name="observaciones" value= "<?php echo htmlspecialchars($_POST['observaciones'] ?? $solic_select['observaciones'] ?? ''); ?>" placeholder="observaciones">
                                    <label for="observaciones">Observaciones</label>
                                    <div class="invalid-feedback"><?php echo $errores['observaciones'] ?? ''; ?></div>
                                </div>
                            </div>
                                

                        </div>
                    </div>  <!-- card datos sede -->
                </div>  <!-- col -->   

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
                                        $insti ? $indiceMaximo = max(array_keys($insti)) : $indiceMaximo = 0;
                                        
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
                                            disabled
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
                                            disabled
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
                                            disabled
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
                                            disabled
                                            <?= $checkSeleccionado === 'comparte3' ? 'checked' : ''; ?>>
                                        <label class="form-check-label" for="comparte3">
                                            Comparte con 3 instituciones
                                        </label>
                                    </div>


                                </div>
                            </fieldset>
                        </div>
                    </div>  <!-- card comparte -->      
                </div>  <!-- col -->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Horarios</h5>
                        </div><!-- end card header -->


                        <!-- Opciones Datalist Instituciones   -->
                        <datalist id="OpcionesInstitucion">
                            <?php 
    
                            foreach ($institucion as $key => $value) { ?>
                                <option 
                                    value="<?php echo $value["institucion"] . ' N°' . $value["numero"] . ' (CUE: ' . $value["cue"] . ')'; ?>" 
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

                            // Ajusta el array de horarios al ID de la institución
                            $horarios = $horariosOrganizados[$id_Institucion] ?? [];
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
                                    disabled
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

                            <!-- Encabezados para pantallas grandes -->
                            <div class="col-12 d-none d-md-flex">
                                <div class="col-5"><h6>Día</h6></div>
                                <div class="col-3"><h6>Hora Inicio</h6></div>
                                <div class="col-3"><h6>Hora Fin</h6></div>
                                <div class="col-1"><h6>Borrar</h6></div>
                            </div>

                            <!-- Estructura por institución -->
                            <?php
                                // Obtener todos los horarios de la institución actual
                                $horariosInstitucion = $horariosOrganizados[$id_Institucion] ?? []; 

                                // Aplanar los horarios de todos los días en un solo array para iterar fácilmente
                                $horariosTotales = [];
                                foreach ($horariosInstitucion as $numDia => $horariosDia) {
                                    foreach ($horariosDia as $horario) {
                                        $horariosTotales[] = ['dia' => $numDia] + $horario; // Agregar el número de día al horario
                                    }
                                }

                                // Asegurar exactamente 5 filas
                                while (count($horariosTotales) < 5) {
                                    $horariosTotales[] = []; // Agregar filas vacías si faltan
                                }

                                // Limitar a un máximo de 5 filas
                                $horariosTotales = array_slice($horariosTotales, 0, 5);

                                // Mostrar las 5 filas
                                foreach ($horariosTotales as $indice => $horario): 
                                ?>
                                <div class="row align-items-center mb-2">
                                    <div class="col-12 col-md-5">
                                        <h6 class="d-md-none">Día</h6>
                                        <select 
                                            class="form-select" 
                                            name="instituciones[<?= $i ?>][dias][<?php echo $indice; ?>][dia]" 
                                            id="dia<?= $i ?>E<?php echo $indice; ?>";
                                            required>
                                            
                                            <!-- Opción predeterminada -->
                                            <option value="" <?php echo empty($horario['dia']) && empty($_POST['instituciones'][$i]['dias'][$indice]['dia']) ? 'selected' : ''; ?>></option>
                                            
                                            <!-- Opciones dinámicas -->
                                            <?php foreach ($dias as $dia): ?>
                                                <?php 
                                                    // Priorizar el valor enviado por el usuario
                                                    $selected = ($_POST['instituciones'][$i]['dias'][$indice]['dia'] ?? '') == $dia["id_Dia"] || ($horario['dia'] ?? '') == $dia["id_Dia"];
                                                ?>
                                                <option 
                                                    value="<?php echo $dia["id_Dia"]; ?>" 
                                                    <?php echo $selected ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($dia["nombre"]); ?>
                                                </option>
                                            <?php endforeach; ?>
                                            
                                        </select>

                                    </div>

                                    <div class="col-12 col-md-3">
                                        <input 
                                            name="instituciones[<?= $i ?>][dias][<?php echo $indice; ?>][horaInicio]" 
                                            id="horaIni<?= $i?>E<?php echo $indice; ?>"; 
                                            type="text" class="form-control 24hours-timepicker" 
                                            placeholder="" 
                                            value="<?php echo $horario['horaInicio'] ?? ''; ?>"
                                        >
                                    </div>

                                    <div class="col-12 col-md-3">
                                        <input 
                                            name="instituciones[<?= $i ?>][dias][<?php echo $indice; ?>][horaFin]"
                                            id="horaFin<?= $i ?>E<?php echo $indice; ?>"; 
                                            type="text" 
                                            class="form-control 24hours-timepicker" 
                                            placeholder="" 
                                            value="<?php echo $horario['horaFin'] ?? ''; ?>"
                                        >
                                    </div>

                                    <div class="col-12 col-md-1 text-md-center">
                                        <button 
                                            type="button" 
                                            class="btn btn-outline-primary" 
                                            onclick="borrarHorario(<?php echo $i; ?>,<?php echo $indice; ?>)">
                                            <i class="fa-solid fa-eraser"></i>
                                        </button>
                                    </div>
                                </div>
                                <?php endforeach; ?>

                            <?php if($i != 3)  {  ?>
                                <hr id= 'divhsEst<?php echo $i +1; ?>'></hr>
                            <?php }  ?>
                        <?php endfor; ?>

                        </div>
                    </div>

                </div>  <!-- col -->
            </div>
            <?php
                $estado =NULL;
                switch ($estado) {
                    case 1:
                        # code...
                        break;
                    
                    default:
                        # code...
                        break;
                }

            ?>
            <!-- Campo oculto para estado de suplencia -->
            <input type="hidden" name="estado" id="estado"  value= "<?php echo $estado ?? $solic_select['id_EstadoSol']?>">
            
            <!-- Campo oculto para estado de suplencia -->
            <input type="hidden" name="id_sol" id="id_sol"  value= "<?php echo $solic_select['id_SolSuplente']?>">
            


            <div class="row">
                <div class="col-lg-12">
                    <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="d-flex flex-wrap gap-2">  
                            <button type="button" class="btn btn-outline-dark btnVolver" pag = "<?php echo ControladorPlantilla::url(); ?>solicitudesSuplente"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                            <button type="submit" class="btn btn-primary btnGuardar" onclick="cambiarEstado(1)"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> <!-- container-fluid -->

<?php } else { ?>
    <!-- <h3>Solicitud no disponible</h3> -->
    <?php include 'no_disponible.php'; ?>
<?php } ?>


<!-- Script js específico para modificaciones dinámicas de formulario -->
<script src="<?php echo $url; ?>vistas/assets/js/sol_suplente.js"></script>
<script>
    function cambiarEstado(estado) {
        document.getElementById('estado').value = estado;
        document.getElementById('formSolicitud').submit();
    }
</script>
