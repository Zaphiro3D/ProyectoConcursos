<?php
/* Función para opciones de select días
function generaOpcionesDias()
{
    $dias = ControladorSolSuplente::ctrMostrarDiasSol();
    $opciones = '<option>...</option>';
    foreach ($dias as $value) {
        $opciones .= "<option>{$value['nombre']}</option>";
    }
    return $opciones;
}*/




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

                                <div class="row mb-2 mt-1">
                                    <!-- Escuela Sede -->
                                    <!-- Debe completarse automaticamente dependiendo desde que institucion ingresa al sistema -->
                                    <div>
                                        <datalist id=institucion>
                                            <?php $sede = ModeloCargos::mdlMostrarCargos();
                                            foreach ($sede as $key => $value) {
                                                $insti = explode(',', $value["instituciones"]);

                                            ?>

                                        </datalist>

                                        <label for="institucion" id="linstitucion1" class="form-label">Institución Sede</label>
                                        <input value="<?php echo $insti[0]; ?>" class="form-control" list="institucion" id=institucion1 placeholder="Escriba para buscar..."></input>
                                    <?php } ?>

                                    <!-- <input type="text" class="form-control" id="nombreInstitucion1" value=""> -->
                                    </div>
                                </div>

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
                                        <datalist id="optionsol">
                                            <?php $plaza = ModeloSolSuplente::mdlMostrarSolSuplente();
                                            foreach ($plaza as $key => $sol) {
                                            ?>
                                                <option><?php echo $sol["numeroTramite"]; ?></option>

                                        </datalist>
                                        <input type="number" class="form-control" list="optionsol" id="optionplaza" placeholder="N° Plaza" value="<?php echo $sol["numeroTramite"]; ?>"></input>
                                    <?php } ?>
                                    <label for="plaza">N° Plaza</label>
                                    </div>

                                </div>
                                <div class="col-lg-9">
                                    <div class="form-floating mb-3">
                                        <input value="<?php echo $sol["nombreCargo"] ?>" type="text" class="form-control" id="cargo" placeholder="Cargo">
                                        <label for="cargo">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-floating mb-3">
                                        <datalist id="opocionesturno">
                                            <?php
                                            $turno = ModeloSolSuplente::mdlMostrarTurnoSol();
                                            foreach ($turno as $key => $value) {
                                            ?>
                                                <option><?php echo $value["turno"]  ?></option>
                                            <?php  } ?>
                                        </datalist>
                                        <input value="<?php echo $sol["turno"]  ?>" class="form-control fs-14" list="opocionsol" id="opocionesturno" placeholder="Escriba para buscar..."></input>
                                        <label for="turno">Turno</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <datalist id="opocionesAnio">
                                            <?php
                                            $grado = ModeloSolSuplente::mdlMostrarGradoSol();
                                            foreach ($grado as $key => $value) {
                                            ?>
                                                <option><?php echo $value["grado"]  ?></option>
                                            <?php } ?>
                                        </datalist>
                                        <input value="<?php echo $sol["grado"]  ?>" class="form-control fs-14" list="opocionesAnio" id="opocionesAnio" placeholder="Escriba para buscar..."></input>
                                        <label for="anio">Año</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <datalist id="opocionesDivision">
                                            <?php
                                            $Division = ModeloSolSuplente::mdlMostrarDivisionSol();
                                            foreach ($Division as $key => $value) { ?>

                                                <option><?php echo $value["division"];  ?></option>
                                            <?php } ?>
                                        </datalist>
                                        <input value="<?php echo $sol["division"];  ?>" class="form-control fs-14" list="opocionesDivision" id="opocionesDivision" placeholder="Escriba para buscar..."></input>

                                        <label for="division">División</label>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-floating mb-3">
                                        <div class="form-floating">
                                            <input value="<?php echo $sol["hsCatedra"];  ?>" list="optionplaza" type="number" class="form-control" id="hsCat" placeholder="hsCat">
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
                                        <datalist id="nombreAgente">
                                            <?php $nombreA = ModeloCargos::mdlMostrarCargos();
                                            foreach ($nombreA as $key => $value) {
                                                $apellido = explode(',', $value["docente"]);
                                                $nombre = explode('(', $apellido[1]);
                                            } ?>
                                        </datalist>
                                        <input value="<?php echo $nombre[0]; ?>" type="text" class="form-control" list="nombreAgente" id="nombreAgente" placeholder="Nombre">
                                        <label for="nombreAgente">Nombre</label>

                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-1">

                                        <input value="<?php echo $apellido[0] ?>" type="text" class="form-control" id="apellidoAgente" placeholder="Apellido">
                                        <label for="apellidoAgente">Apellido</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                                    <div class="form-floating mb-1">
                                        <?php $dni = explode(')', $nombre[1]) ?>
                                        <input value="<?php echo $dni[0] ?>" type="number" class="form-control" id="dniAgente" placeholder="DNI">
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
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="noComparte" value="option1" checked>
                                        <label class="form-check-label" for="noComparte">
                                            No comparte
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte1" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte1">
                                            Comparte con 1 institución
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte2" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte2">
                                            Comparte con 2 instituciones
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte3" value="option1" unchecked>
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
                            <h5 class="card-title mb-0">Horarios</h5>
                        </div><!-- end card header -->


                        <!-- Opciones Datalist Instituciones        -->
                        <datalist id="OpcionesInstitucion">
                            <?php
                            $institucion = ControladorInstituciones::ctrMostrarInstituciones();
                            foreach ($institucion as $key => $value) {
                            ?>
                                <option><?php echo $value["tipo"] . " N°" . $value["numero"] . '" ' . $value["institucion"] . '" ' . "CUE: {$value["cue"]}" ?> </option>
                            <?php } ?>
                        </datalist>

                        <div class="card-body">
                            <div class="card-body" id='hsEst1'> <!-- Card Hs Est 1 -->
                                <div class="row">
                                    <div class="pb-2"> <!-- Datalist Instituciones 1 -->

                                        <label for="institucion1" id="lblinstitucion1" class="form-label">Institución Sede</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion1" placeholder="Escriba para buscar...">
                                    </div>

                                    <div class="col-5">
                                        <div class="pb-3"> <!-- Div dias -->
                                            <?php
                                            // Función para opciones de select días
                                            function generarOpcionesDias()
                                            {
                                                $dias = ControladorSolSuplente::ctrMostrarDiasSol();
                                                $opciones = '<option>...</option>';
                                                foreach ($dias as $value) {
                                                    $opciones .= "<option>{$value['nombre']}</option>";
                                                }
                                                return $opciones;
                                            }
                                            ?>

                                            <form>
                                                <H6>Días</H6>
                                                <select class="form-select" id="dia1Est1">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia2Est1">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia3Est1">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia4Est1">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia5Est1">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Inicio -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Inicio</H6>
                                                <input id="horaIni1E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni2E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni3E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni4E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni5E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Fin -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Fin</H6>
                                                <input id="horaFin1E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin2E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin3E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin4E1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin5E1" type="text" class="form-control 24hours-timepicker" placeholder="...">

                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="btn-group-vertical mt-4" role="group" aria-label="Vertical button group">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 1" onclick="borrarHorario(1,1)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 2" onclick="borrarHorario(2,1)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 3" onclick="borrarHorario(3,1)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 4" onclick="borrarHorario(4,1)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 5" onclick="borrarHorario(5,1)"><i class="fa-solid fa-eraser"></i></button>

                                        </div>
                                    </div>


                                </div> <!-- Fin Hs Establecimiento 1 -->
                            </div> <!-- Card Hs Est 1-->

                            <hr id='divhsEst2'>
                            </hr>

                            <div class="card-body" id='hsEst2'> <!-- Card Hs Est 2 -->
                                <div class="row">
                                    <div class="pb-2"> <!-- Datalist Instituciones 2 -->
                                        <label for="institucion2" id="lblinstitucion2" class="form-label">Segunda Institución</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion2" placeholder="Escriba para buscar...">
                                    </div>

                                    <div class="col-5">
                                        <div class="pb-3"> <!-- Div dias -->
                                            <form>
                                                <H6>Días</H6>
                                                <select class="form-select" id="dia1Est2">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia2Est2">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia3Est2">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia4Est2">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia5Est2">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Inicio -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Inicio</H6>
                                                <input id="horaIni1E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni2E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni3E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni4E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni5E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Fin -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Fin</H6>
                                                <input id="horaFin1E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin2E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin3E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin4E2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin5E2" type="text" class="form-control 24hours-timepicker" placeholder="...">

                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="btn-group-vertical mt-4" role="group" aria-label="Vertical button group">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 1" onclick="borrarHorario(1,2)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 2" onclick="borrarHorario(2,2)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 3" onclick="borrarHorario(3,2)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 4" onclick="borrarHorario(4,2)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 5" onclick="borrarHorario(5,2)"><i class="fa-solid fa-eraser"></i></button>

                                        </div>
                                    </div>


                                </div> <!-- Fin Hs Establecimiento 2 -->
                            </div> <!-- Card Hs Est 2-->

                            <hr id='divhsEst3'>
                            </hr>

                            <div class="card-body" id='hsEst3'> <!-- Card Hs Est 3 -->
                                <div class="row">
                                    <div class="pb-3"> <!-- Datalist Instituciones 3 -->
                                        <label for="institucion3" id="lblinstitucion3" class="form-label">Tercera Institución</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion3" placeholder="Escriba para buscar...">
                                    </div>

                                    <div class="col-5">
                                        <div class="pb-3"> <!-- Div dias -->
                                            <form>
                                                <H6>Días</H6>
                                                <select class="form-select" id="dia1Est3">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia2Est3">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia3Est3">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia4Est3">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia5Est3">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Inicio -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Inicio</H6>
                                                <input id="horaIni1E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni2E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni3E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni4E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni5E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Fin -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Fin</H6>
                                                <input id="horaFin1E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin2E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin3E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin4E3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin5E3" type="text" class="form-control 24hours-timepicker" placeholder="...">

                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="btn-group-vertical mt-4" role="group" aria-label="Vertical button group">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 1" onclick="borrarHorario(1,3)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 2" onclick="borrarHorario(2,3)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 3" onclick="borrarHorario(3,3)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 4" onclick="borrarHorario(4,3)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 5" onclick="borrarHorario(5,3)"><i class="fa-solid fa-eraser"></i></button>

                                        </div>
                                    </div>


                                </div> <!-- Fin Hs Establecimiento 3 -->
                            </div> <!-- Card Hs Est 3-->

                            <hr id='divhsEst4'>
                            </hr>

                            <div class="card-body" id='hsEst4'> <!-- Card Hs Est 4 -->
                                <div class="row">
                                    <div class="pb-3"> <!-- Datalist Instituciones 4 -->
                                        <label for="institucion4" id="lblinstitucion4" class="form-label">Cuarta Institución</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucion4" placeholder="Escriba para buscar...">
                                    </div>

                                    <div class="col-5">
                                        <div class="pb-3"> <!-- Div dias -->
                                            <form>
                                                <H6>Días</H6>
                                                <select class="form-select" id="dia1Est4">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia2Est4">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia3Est4">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia4Est4">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>

                                                <select class="form-select" id="dia5Est4">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Inicio -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Inicio</H6>
                                                <input id="horaIni1E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni2E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni3E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni4E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaIni5E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Horarios de Fin -->
                                    <div class="col-3">
                                        <div class="pb-1">
                                            <form>
                                                <H6>Hora Fin</H6>
                                                <input id="horaFin1E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin2E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin3E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin4E4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                                <input id="horaFin5E4" type="text" class="form-control 24hours-timepicker" placeholder="...">

                                            </form>
                                        </div>
                                    </div>

                                    <div class="col-1">
                                        <div class="btn-group-vertical mt-4" role="group" aria-label="Vertical button group">
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 1" onclick="borrarHorario(1,4)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 2" onclick="borrarHorario(2,4)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 3" onclick="borrarHorario(3,4)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 4" onclick="borrarHorario(4,4)"><i class="fa-solid fa-eraser"></i></button>
                                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día 5" onclick="borrarHorario(5,4)"><i class="fa-solid fa-eraser"></i></button>

                                        </div>
                                    </div>


                                </div> <!-- Fin Hs Establecimiento 4 -->
                            </div> <!-- Card Hs Est 4-->

                        </div>
                    </div>
                </div> <!-- col -->

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-dark btnVolver" pag="cargos"> <i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button>
                            <button type="button" class="btn btn-outline-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> <!-- container-fluid -->

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
        //document.getElementById("divhsEst2").style.display = institucion2.style.display;
        

        // Institucion 3
        institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion3.style.display = institucion3.style.display;
        //document.getElementById("divhsEst3").style.display = institucion3.style.display;
        

        // Institucion 4
        institucion4.style.display = radios[3].checked ? "block" : "none";
        lblinstitucion4.style.display = institucion4.style.display;
        //document.getElementById("divhsEst4").style.display = institucion4.style.display;
        

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