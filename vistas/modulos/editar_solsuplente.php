<?php
$solicitud = ModeloSolSuplente::mdlMostrarSolSuplente();
?>
<div class="container-xxl">

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
                                        <input type="text" class="form-control" id="institucion1-deshab" disabled="" value="<?php  ?>">
                                    </div>
                                </fieldset>

                        </div>
                    </div>  <!-- card datos sede -->
                </div>  <!-- col -->   


                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Datos del Cargo</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row mt-1">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="plaza" placeholder="N° Plaza">
                                    <label for="plaza">N° Plaza</label>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="cargo" placeholder="Cargo">
                                    <label for="cargo">Cargo</label>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="turno">
                                        <option selected>...</option>
                                        <option value="1">Director</option>
                                        <option value="2">Supervisor</option>
                                        <option value="3">Administrativo</option>
                                    </select>
                                    <label for="turno">Turno</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="anio">
                                        <option selected>...</option>
                                        <option value="1">Director</option>
                                        <option value="2">Supervisor</option>
                                        <option value="3">Administrativo</option>
                                    </select>
                                    <label for="anio">Año</label>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="division">
                                        <option selected>...</option>
                                        <option value="1">Director</option>
                                        <option value="2">Supervisor</option>
                                        <option value="3">Administrativo</option>
                                    </select>
                                    <label for="division">División</label>
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
                                        <input type="text" class="form-control" id="nombreAgente" placeholder="Nombre">
                                        <label for="nombreAgente">Nombre</label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="apellidoAgente" placeholder="Apellido">
                                        <label for="apellidoAgente">Apellido</label>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="dniAgente" placeholder="DNI">
                                        <label for="dniAgente">Número de DNI sin puntos</label>
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
                                        $motivoSol = ControladorSolSuplente::ctrMostrarMotivoSol();
                                        foreach ($motivoSol as $key => $value) {   
                                    ?>
                                    <option ><?php echo $value["articulo"] . ' "' . $value["inciso"] . '" - ' . $value["resolucion"] . " - ". $value["motivo"] ?> </option>
                                    <?php } ?>
                                </datalist>    
                            
                                <div class="pb-1">   <!-- Datalist Motivo-->
                                    <!-- <label for="datalistSupervisor" class="form-label">Segunda Institución</label> -->
                                    <div class="form-floating">
                                        <input class="form-control fs-14" list="opcionesMotivo" id="opcionesMotivo" placeholder="Escriba para buscar..." ></input>
                                        <label for="opcionesMotivo">Escriba para buscar...</label>
                                    </div>   
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
                            <form>
                                <div class="row ">
                                    <div class="col-lg-6">
                                        <label class="form-label">Fecha Inicio</label>
                                        <input type="text" class="form-control AR-datepicker" id="fechaInicio" placeholder="Fecha Inicio">
                                    </div>
                                    <div class="col-lg-6 ">
                                        <label class="form-label">Fecha Fin</label>
                                        <input type="text" class="form-control AR-datepicker" id="fechaFin" placeholder="Fecha Fin">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>  <!-- col -->
            </div>  <!-- col -->
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">¿Comparte con otra institución?</h5>
                    </div><!-- end card header -->
                    
                    <div class="card-body">
                        <form>
                            <fieldset class="row">
                                <!-- <legend class="col-form-label pt-0 fs-14">¿Comparte con otra institución?</legend> -->
                                <div class="col-sm-10 d-flex gap-2">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="noComparte" value="option1" checked>
                                        <label class="form-check-label" for="noComparte">
                                            No comparte
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte1" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte1">
                                            Comparte con 1 institución
                                        </label>
                                    </div>
                                <!-- </div>
                                <div class="col-lg-6"> -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte2" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte2">
                                            Comparte con 2 instituciones
                                        </label>
                                    </div>

                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte3" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte3">
                                            Comparte con 3 instituciones
                                        </label>
                                    </div>
                                </div>     
                            </fieldset> 
                        </form>
                    </div>
                </div>  <!-- card comparte -->      
            </div>  <!-- col -->

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Horarios</h5>
                    </div><!-- end card header -->
 
                    
                    <!-- Opciones Datalist Instituciones        -->
                    <datalist id="OpcionesInstitucion">
                        <?php
                            $institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
                            foreach ($institucion as $key => $value) {   
                                // $cadena = "{$value["TipoInstitucion"]} N°{$value["numero"]}". '"' . "{$value["institucion"]}".'" '."CUE: {$value["cue"]}" ;                 
                        ?>
                        <option ><?php echo $value["tipo"] . " N°" . $value["numero"]. '" ' . $value["institucion"] .'" '."CUE: {$value["cue"]}"?> </option>
                        <?php } ?>
                    </datalist>    

                    <div class="card-body">
                        <div class="card-body" id= 'hsEst1'> <!-- Card Hs Est 1 -->
                            <div class="row">
                                <div class="pb-2">   <!-- Datalist Instituciones 1 -->
                                    <label for="institucion1"  id="lblinstitucion1" class="form-label">Institución Sede</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion1" placeholder="Escriba para buscar...">
                                </div>
                                
                                <div class="col-5">
                                    <div class="pb-3">   <!-- Div dias -->
                                        <?php
                                        // Función para opciones de select días
                                        function generarOpcionesDias() {
                                            $dias = ControladorSolSuplente::ctrMostrarDiasSol();
                                            $opciones = '<option>...</option>';
                                            foreach ($dias as $value) { 
                                                $opciones .= "<option>{$value['nombre']}</option>";
                                            }
                                            return $opciones;
                                        }
                                        ?>

                                        <form >
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
                                            <H6>Hora  Inicio</H6>
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
                                            <H6>Hora  Fin</H6>
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
                        </div>  <!-- Card Hs Est 1-->

                        <hr id= 'divhsEst2'></hr>
                        
                        <div class="card-body" id= 'hsEst2'>  <!-- Card Hs Est 2 -->
                            <div class="row">
                                <div class="pb-2">   <!-- Datalist Instituciones 2 -->
                                    <label for="institucion2"  id="lblinstitucion2" class="form-label">Segunda Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion2" placeholder="Escriba para buscar...">
                                </div>
                                
                                <div class="col-5">
                                    <div class="pb-3">   <!-- Div dias -->
                                        <form >
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
                                            <H6>Hora  Inicio</H6>
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
                                            <H6>Hora  Fin</H6>
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
                        </div>  <!-- Card Hs Est 2-->

                        <hr id= 'divhsEst3'></hr>
                        
                        <div class="card-body" id= 'hsEst3'>  <!-- Card Hs Est 3 -->
                            <div class="row">
                                <div class="pb-3">   <!-- Datalist Instituciones 3 -->
                                    <label for="institucion3" id="lblinstitucion3"  class="form-label">Tercera Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion3" placeholder="Escriba para buscar...">
                                </div>
                                
                                <div class="col-5">
                                    <div class="pb-3">   <!-- Div dias -->
                                        <form >
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
                                            <H6>Hora  Inicio</H6>
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
                                            <H6>Hora  Fin</H6>
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
                        </div>  <!-- Card Hs Est 3-->

                        <hr id= 'divhsEst4'></hr>

                        <div class="card-body" id= 'hsEst4'>  <!-- Card Hs Est 4 -->
                            <div class="row">
                                <div class="pb-3">   <!-- Datalist Instituciones 4 -->
                                    <label for="institucion4" id="lblinstitucion4" class="form-label">Cuarta Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion4" placeholder="Escriba para buscar...">
                                </div>
                                
                                <div class="col-5">
                                    <div class="pb-3">   <!-- Div dias -->
                                        <form >
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
                                            <H6>Hora  Inicio</H6>
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
                                            <H6>Hora  Fin</H6>
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
                        </div>  <!-- Card Hs Est 4-->
                        
                    </div>
                </div>
            </div>  <!-- col -->

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="d-flex flex-wrap gap-2">  
                        <button type="button" class="btn btn-outline-dark btnVolver" pag = "solicitudesSuplente"> <i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                        <button type="button" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button> 
                    </div>
                </div>
            </div>
        </div>
    </div>
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
        document.getElementById("divhsEst2").style.display = institucion2.style.display;
        document.getElementById("hsEst2").style.display = institucion2.style.display;
        
        // Institucion 3
        institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion3.style.display = institucion3.style.display;
        document.getElementById("divhsEst3").style.display = institucion3.style.display;
        document.getElementById("hsEst3").style.display = institucion3.style.display;
        
        // Institucion 4
        institucion4.style.display = radios[3].checked ? "block" : "none";
        lblinstitucion4.style.display = institucion4.style.display;
        document.getElementById("divhsEst4").style.display = institucion4.style.display;
        document.getElementById("hsEst4").style.display = institucion4.style.display;


        //<hr id= 'div-hsEst4'></hr>
        //<div class="card-body" id= 'hsEst4'>  <!-- Card Hs Est 4 -->
    }

    // Función para borrar horarios
    function borrarHorario(dia, inst) {
        // Selecciona los campos de inicio y fin correspondientes al día especificado
        const horaInicio = document.getElementById(`horaIni${dia}E${inst}`);
        const horaFin = document.getElementById(`horaFin${dia}E${inst}`);

        // Borra el contenido de los campos
        if (horaInicio) horaInicio.value = "";
        if (horaFin) horaFin.value = "";
    }

    // Añade el evento de cambio a cada radio button para ejecutar la función cuando cambie la selección
    radios.forEach(radio => {
        radio.addEventListener("change", toggleInstituciones);
    });

    // Oculta inicialmente todos los campos extra
    toggleInstituciones();
</script>
