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

    $grado = ModeloSolSuplente::mdlMostrarDatosSol("grados"); // Obtiene todas las columnas de la tabla "grados"
    $turno = ModeloSolSuplente::mdlMostrarDatosSol("Turnos"); // Obtiene todas las columnas de la tabla "Turnos"
    $division = ModeloSolSuplente::mdlMostrarDatosSol("Divisiones"); // Obtiene todas las columnas de la tabla "Divisiones"
?>

<div class="container-xxl">
    <form method="POST">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-22 fw-bold m-0">Nueva Solicitud de Suplente</h4>
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
                                        
                                        <label for="institucionSede"  id="lblinstitucion1" class="form-label">Institución Sede</label>
                                        <input class="form-control" list="OpcionesInstitucion" id="institucionSede" placeholder="Escriba para buscar...">
                                    
                                            <!-- <input type="text" class="form-control" id="nombreInstitucion1" value=""> -->
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
                                <div class="col-lg-5">
                                    <div class="form-floating mb-3">
                                        <datalist id="opocionesturno">
                                            <?php 
                                                
                                                foreach($turno as $key => $value){
                                            ?>
                                            <option><?php echo $value["turno"]  ?></option>
                                            <?php } ?>
                                        </datalist>
                                        <input class="form-control fs-14" list="opocionesturno" id="opocionesturno" placeholder="Escriba para buscar..." ></input>
                                        <label for="turno">Turno</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <datalist id="opocionesAnio">
                                            <?php 
                                                
                                                foreach($grado as $key => $value){
                                            ?>
                                            <option><?php echo $value["grado"]  ?></option>
                                            <?php } ?>
                                        </datalist>
                                        <input class="form-control fs-14" list="opocionesAnio" id="opocionesAnio" placeholder="Escriba para buscar..." ></input>
                                        <label for="anio">Año</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                    <datalist id="opocionesDivision">
                                            <?php 
                                                
                                                foreach($division as $key => $value){
                                            ?>
                                            <option><?php echo $value["division"]  ?></option>
                                            <?php } ?>
                                        </datalist>
                                        <input class="form-control fs-14" list="opocionesDivision" id="opocionesDivision" placeholder="Escriba para buscar..." ></input>
                                        <label for="division">División</label>
                                    </div>
                                </div>

                                <div class="col-lg-1">
                                    <div class="form-floating mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="hsCat" placeholder="hsCat">
                                            <label for="hsCat">Hs. Cát.</label>
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
                                <div class="row ">
                                    <div class="col-lg-6 mb-1">
                                        <label class="form-label">Fecha Inicio</label>
                                        <input type="text" class="form-control AR-datepicker" id="fechaInicio" placeholder="Fecha Inicio">
                                    </div>         
                                    
                                    <div class="col-lg-6 mb-1">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- Label de Fecha Fin -->
                                            <label class="form-label mb-0">Fecha Fin</label>

                                            <!-- Checkbox de ¿Abierto? -->
                                            <div class="form-check d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input" id="checkAbierto" style="margin-right: 5px;">
                                                <label class="form-check-label" for="checkAbierto">¿Fin Abierto?</label>
                                            </div>
                                        </div>
                                        
                                        <!-- Campo de entrada para la fecha -->
                                        <div class="mt-2">
                                            <input type="text" class="form-control AR-datepicker" id="fechaFin" placeholder="Fecha Fin">
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
                                    <input type="text" class="form-control" id="observaciones" placeholder="observaciones">
                                    <label for="observaciones">Observaciones</label>
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
                            ?>
                            <option ><?php echo $value["tipo"] . " N°" . $value["numero"]. '" ' . $value["institucion"] .'" '."CUE: {$value["cue"]}"?> </option>
                            <?php } ?>
                        </datalist>    

                        <div class="card-body">
                            <?php
                            // Función para generar el bloque de institución
                            function generarBloqueInstitucion($numeroInstitucion) {
                                ob_start(); // Iniciar el almacenamiento en búfer
                            ?>
                                <!-- Card Hs Est <?php echo $numeroInstitucion; ?> -->
                                <div class="card-body" id="hsEst<?php echo $numeroInstitucion; ?>">
                                    <div class="row">
                                        
                                        <!-- Datalist Instituciones <?php echo $numeroInstitucion; ?> -->
                                        <div class="col-12 pb-2">   
                                            <label for="institucion<?php echo $numeroInstitucion; ?>" id="lblinstitucion<?php echo $numeroInstitucion; ?>" class="form-label">Institución <?php echo $numeroInstitucion; ?></label>
                                            <input class="form-control" list="OpcionesInstitucion" id="institucion<?php echo $numeroInstitucion; ?>" placeholder="Escriba para buscar...">
                                        </div>

                                        <!-- Encabezados para pantallas grandes -->
                                        <div class="col-12 d-none d-md-flex">
                                            <div class="col-5"><h6>Día</h6></div>
                                            <div class="col-3"><h6>Hora Inicio</h6></div>
                                            <div class="col-3"><h6>Hora Fin</h6></div>
                                            <div class="col-1"><h6>Borrar</h6></div>
                                        </div>

                                        <!-- Estructura por día -->
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <div class="row align-items-center mb-2">
                                            <!-- Días -->
                                            <div class="col-12 col-md-5">
                                                <h6 class="d-md-none">Día <?php echo $i; ?></h6>
                                                <select class="form-select" id="dia<?php echo $i; ?>Est<?php echo $numeroInstitucion; ?>">
                                                    <?php echo generarOpcionesDias(); ?>
                                                </select>
                                            </div>

                                            <!-- Hora Inicio -->
                                            <div class="col-12 col-md-3">
                                                <h6 class="d-md-none">Hora Inicio</h6>
                                                <input id="horaIni<?php echo $i; ?>E<?php echo $numeroInstitucion; ?>" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            </div>

                                            <!-- Hora Fin -->
                                            <div class="col-12 col-md-3">
                                                <h6 class="d-md-none">Hora Fin</h6>
                                                <input id="horaFin<?php echo $i; ?>E<?php echo $numeroInstitucion; ?>" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            </div>

                                            <!-- Botón Borrar Horario -->
                                            <div class="col-12 col-md-1 text-md-center">
                                                <button type="button" class="btn btn-outline-primary w-100 mt-md-0 mt-2" data-bs-toggle="tooltip" data-bs-placement="bottom" data-bs-title="Borrar Horarios Día <?php echo $i; ?>" onclick="borrarHorario(<?php echo $i; ?>,<?php echo $numeroInstitucion; ?>)">
                                                    <i class="fa-solid fa-eraser"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <?php endfor; ?>
                                    </div> <!-- Fin Hs Establecimiento <?php echo $numeroInstitucion; ?> -->
                                </div> <!-- Card Hs Est <?php echo $numeroInstitucion; ?> -->
                                <?php if($numeroInstitucion != 4)  {  ?>
                                    <hr id= 'divhsEst<?php echo $numeroInstitucion +1; ?>'></hr>
                                <?php }  ?>

                            <?php
                                return ob_get_clean(); // Retornar el contenido almacenado
                            }

                            // Generar bloques de instituciones
                            for ($j = 1; $j <= 4; $j++) {
                                echo generarBloqueInstitucion($j);
                            }
                            ?>                        
                            
                        </div>
                    </div>
                </div>  <!-- col -->

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="d-flex flex-wrap gap-2">  
                            <button type="button" class="btn btn-outline-dark btnVolver" pag = "solicitudesSuplente"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                            <button type="button" class="btn btn-outline-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar Borrador</button> 
                            <button type="button" class="btn btn-primary btnEliminar"><i class="fa-solid fa-paper-plane"></i> &nbsp; Enviar</button> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> <!-- container-fluid -->