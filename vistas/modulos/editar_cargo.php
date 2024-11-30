<?php
$id_cargo = "id_Cargo";
$valor = $rutas[1];
$cargo_select = ControladorCargos::ctrMostrarCargos($id_cargo, $valor);
print_r($cargo_select);


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
if ($cargo_select) {
?>
    <div class="container-xxl">
        <form method="POST">
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

                                            <label for="institucionSede" id="lblinstitucion1" class="form-label">Institución Sede</label>
                                            <input class="form-control" list="OpcionesInstitucion" id="institucionSede" name="institucionSede" placeholder="Escriba para buscar...">

                                            <!-- <input type="text" class="form-control" id="nombreInstitucion1" value=""> -->
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
                                            <input type="number" class="form-control" id="plaza" name="plaza" placeholder="N° Plaza" value="<?php echo $cargo_select["numeroPlaza"] ?>">
                                            <label for="plaza">N° Plaza</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="nombrecargo" name="id_Nombrecargo" aria-label="Floating label select example" required>

                                                <option value="<?php echo $cargo_select["nombreCargo"] ?>" selected><?php echo $cargo_select["nombreCargo"] ?> </option>
                                                <?php $cargo = ModeloSolSuplente::mdlMostrarDatosSol("nombres_Cargos", "*", null);

                                                foreach ($cargo as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value["id_NombreCargo"] ?>"><?php echo $value["nombreCargo"] ?> </option>

                                                <?php } ?>
                                            </select>
                                            <!--input type="text" class="form-control" list="opcionescargo" id="opcionescargo" name="opcionescargo" placeholder="Cargo"-->
                                            <label for="cargo">Cargo</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="turno" name="id_Turno" aria-label="Floating label select example" required>
                                                <option value=""><?php echo $cargo_select["turno"] ?></option>
                                                <?php
                                                $turno = ControladorSolSuplente::ctrMostrarDatosSol("turnos", "*", null);
                                                foreach ($turno as $key => $value) {
                                                ?>
                                                    <option value="id_Turno"><?php echo $value["turno"]  ?></option>
                                                <?php } ?>
                                            </select>
                                            <!--input class="form-control fs-14" list="opcionesturno" id="opcionesturno" name="opcionesturno" placeholder="Escriba para buscar..."></input-->
                                            <label for="turno">Turno</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="grados" name="id_Grado" aria-label="Floating label select example" required>
                                                <option value=""><?php echo $cargo_select["grado"]; ?></option>
                                                <?php
                                                $grado = ControladorSolSuplente::ctrMostrarDatosSol("grados", "*", null);
                                                foreach ($grado as $key => $value) {
                                                ?>
                                                    <option value="<?php $value["id_Grado"] ?>"><?php echo $value["grado"]  ?></option>
                                                <?php } ?>
                                            </select>
                                            <!--input class="form-control fs-14" list="opcionesAnio" id="opcionesAnio" name="opcionesAnio" placeholder="Escriba para buscar..."></input-->
                                            <label for="anio">Año</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-3">
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="diviciones" name="id_Division" aria-label="Floating label select example" required>
                                                <option value=""><?php echo $cargo_select["division"]; ?></option>
                                                <?php
                                                $Division = ControladorSolSuplente::ctrMostrarDatosSol("divisiones", "*", null);
                                                foreach ($Division as $key => $value) {
                                                ?>
                                                    <option value="<?php $value["id_Division"] ?>"><?php echo $value["division"]  ?></option>

                                                <?php } ?>

                                            </select>
                                            <!--input class="form-control fs-14" list="opcionesDivision" id="opcionesDivision" name="opcionesDivision" placeholder="Escriba para buscar..."></input-->
                                            <label for="division">División</label>
                                        </div>
                                    </div>
                                    <div class="col-lg-1">
                                        <div class="form-floating mb-3">
                                            <div class="form-floating">
                                                <input type="number" class="form-control" id="hsCat" name="hsCat" placeholder="hsCat" value="<?php echo $cargo_select["hsCatedra"] ?>">
                                                <label for="nombreAgente">Hs. Cát.</label>
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
                                            <input type="text" class="form-control" id="nombreDocente" name="nombreDocente" placeholder="Nombre" value="<?php echo $cargo_select["nombreDocente"] ?>">
                                            <label for="nombreDocente">Nombre</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-floating mb-1">
                                            <input type="text" class="form-control" id="apellidoAgente" name="apellidoAgente" placeholder="Apellido" value="<?php echo $cargo_select["apellidoDocente"] ?>">
                                            <label for="apellidoAgente">Apellido</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-3">
                                        <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                                        <div class="form-floating mb-1">
                                            <input type="number" class="form-control" id="dniAgente" name="dniAgente" placeholder="DNI" value="<?php echo $cargo_select["dniDocente"] ?>">
                                            <label for="dniAgente">Número de DNI sin puntos</label>
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
                                        <div class="form-check mb-2 mx-2">
                                            <input class="form-check-input" type="radio" name="gridRadiosComparte" id="noComparte" name="noComparte" value="option1" checked>
                                            <label class="form-check-label" for="noComparte">
                                                No comparte
                                            </label>
                                        </div>

                                        <div class="form-check mb-2 mx-2">
                                            <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte1" name="comparte1" value="option1" unchecked>
                                            <label class="form-check-label" for="comparte1">
                                                Comparte con 1 institución
                                            </label>
                                        </div>
                                        <div class="form-check mb-2 mx-2">
                                            <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte2" name="comparte2" value="option1" unchecked>
                                            <label class="form-check-label" for="comparte2">
                                                Comparte con 2 instituciones
                                            </label>
                                        </div>

                                        <div class="form-check mb-2 mx-2">
                                            <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte3" name="comparte3" value="option1" unchecked>
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
                            <datalist id="OpcionesInstitucion" name="OpcionesInstitucion">
                                <option value=""></option>
                                <?php
                                $institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
                                foreach ($institucion as $key => $value) {
                                ?>
                                    <option><?php echo $value["tipo"] . " N°" . $value["numero"] . '" ' . $value["institucion"] . '" ' . "CUE: {$value["cue"]}" ?> </option>
                                <?php } 
                                
                                foreach ($cargo_select as $key => $value) {
                                    $insti = explode(',', $value['instituciones']);?>
                                    <option value="<?php echo $insti[0]?>"></option>
                                <?php
                                    
                                }
                                ?>
                            </datalist>
                            <?php print_r($insti)?>

                            <div class="card-body">

                                <div class="row" id='hsEst1'> <!-- Est 1 -->
                                    <div class="pb-2"> <!-- Datalist Instituciones 1 -->
                                        <label for="institucion1" id="lblinstitucion1" name="lblinstitucion1" class="form-label">Institución Sede</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion1" name="institucion1" placeholder="Escriba para buscar..." value="<?php echo $insti[0]; ?> ">
                                    </div>
                                </div> <!-- Fin Hs Establecimiento 1 -->

                                <div class="row" id='hsEst2'><!-- Est 2 -->
                                    <div class="pb-2"> <!-- Datalist Instituciones 2 -->
                                        <label for="institucion2" id="lblinstitucion2" name="lblinstitucion2" class="form-label">Segunda Institución</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion2" name="institucion2" placeholder="Escriba para buscar...">
                                    </div>
                                </div> <!-- Fin Hs Establecimiento 2 -->

                                <div class="row" id='hsEst3'><!-- Est 3 -->
                                    <div class="pb-3"> <!-- Datalist Instituciones 3 -->
                                        <label for="institucion3" id="lblinstitucion3" class="form-label">Tercera Institución</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion3" name="institucion3" placeholder="Escriba para buscar...">
                                    </div>
                                </div> <!-- Fin Hs Establecimiento 3 -->

                                <div class="row" id='hsEst4'><!-- Est 4 -->
                                    <div class="pb-3"> <!-- Datalist Instituciones 4 -->
                                        <label for="institucion4" id="lblinstitucion4" class="form-label">Cuarta Institución</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion4" name="institucion4" placeholder="Escriba para buscar...">
                                    </div>
                                </div> <!-- Fin Hs Establecimiento 4 -->
                            </div>

                        </div>
                    </div> <!-- col -->

                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="d-flex flex-wrap gap-2">
                                <input type="hidden" name="id_Cargo" value="<?php echo $cargo_select["id_Cargo"]; ?>">

                                <a class="btn btn-outline-dark btnVolver" pag="cargos"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</a>
                                <button type="button" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> <!-- container-fluid -->

<?php } else { ?>
    <h3>Cargo no disponible</h3>
<?php } ?>

<!-- Script para habilitar las opciones segun la cantidad de instituciones  -->
<script>
    // Selecciona los radio buttons y los contenedores de cada institución
    const radios = document.getElementsByName("gridRadiosComparte");
    const institucion2 = document.getElementById("institucion2");
    const institucion3 = document.getElementById("institucion3");
    const institucion4 = document.getElementById("institucion4");

    // Función para mostrar u ocultar campos según la opción seleccionada
    function toggleInstituciones() {
        // Institucion 2
        institucion2.style.display = radios[1].checked || radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion2.style.display = institucion2.style.display;
        // document.getElementById("divhsEst2").style.display = institucion2.style.display;

        // Institucion 3
        institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion3.style.display = institucion3.style.display;
        // document.getElementById("divhsEst3").style.display = institucion3.style.display;

        // Institucion 4
        institucion4.style.display = radios[3].checked ? "block" : "none";
        lblinstitucion4.style.display = institucion4.style.display;
        // document.getElementById("divhsEst4").style.display = institucion4.style.display;
    }

    // Función para sincronizar el valor de la institucion sede en horario
    function syncFields(source, target) {
        target.value = source.value;
    }

    // Obtener los elementos de los campos
    const institucionSede = document.getElementById("institucionSede");
    const institucion1 = document.getElementById("institucion1");

    // Agregar event listeners para sincronizar los valores en ambos sentidos
    institucionSede.addEventListener("input", function() {
        syncFields(institucionSede, institucion1);
    });

    institucion1.addEventListener("input", function() {
        syncFields(institucion1, institucionSede);
    });
    //----- Fin sincronizar el valor de la institucion sede en horario -------

    // Añade el evento de cambio a cada radio button para ejecutar la función cuando cambie la selección
    radios.forEach(radio => {
        radio.addEventListener("change", toggleInstituciones);
    });

    // Oculta inicialmente todos los campos extra
    toggleInstituciones();
</script>