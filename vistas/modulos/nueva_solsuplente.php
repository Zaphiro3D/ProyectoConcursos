
<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nueva Solicitud de Suplente</h4>
        </div>
    </div>
    
    <div class="col-12"> <!-- Floating Labels -->
        <div class= "row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Datos del Cargo</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">
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
        <div class= "row">
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Institución Sede</h5>
                    </div><!-- end card header -->
                    
                    <div class="card-body">

                            <fieldset class="row mb-3 mt-1"> 
                                <!-- Escuela Sede -->
                                <!-- Debe completarse automaticamente dependiendo desde que institucion ingresa al sistema -->
                                <div>
                                    <!-- <label for="institucion1-deshab" class="form-label">Institución Sede</label> -->
                                    <input type="text" class="form-control" id="institucion1-deshab" disabled="" value="Dirección Departamental de Escuelas dpto. Concordia CUE: 3009962">
                                </div>
                            </fieldset>

                    </div>
                </div>  <!-- card datos sede -->
            </div>  <!-- col -->   
            <div class="col-lg-6">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">¿Comparte con otra institución?</h5>
                    </div><!-- end card header -->
                    
                    <div class="card-body">
                        <form>
                            <fieldset class="row">
                                <!-- <legend class="col-form-label pt-0 fs-14">¿Comparte con otra institución?</legend> -->
                                <div class="col-lg-6">
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
                                </div>
                                <div class="col-lg-6">
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
        </div>  <!-- row -->
        <!-- hacer un if que controle lo seleccionado en los check y que muestre para solicitar los datos de las otras instituciones  -->
        <div class="col-lg-12" id= "colSelecInstituciones">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Seleccione las Instituciones Compartidas</h5>
                </div>
                <div class="card-body">   
                    <form>
                        <!-- Opciones Datalist Instituciones        -->
                        <datalist id="OpcionesInstitucion">
                            <?php
                                $institucion = ControladorInstituciones::ctrMostrarInstituciones();
                                foreach ($institucion as $key => $value) {   
                                    // $cadena = "{$value["TipoInstitucion"]} N°{$value["numero"]}". '"' . "{$value["institucion"]}".'" '."CUE: {$value["cue"]}" ;                 
                            ?>
                            <option ><?php echo $value["tipo"] . " N°" . $value["numero"]. '" ' . $value["institucion"] .'" '."CUE: {$value["cue"]}"?> </option>
                            <?php } ?>
                        </datalist>    
                    
                        <div class="pb-3">   <!-- Datalist Instituciones 2 -->
                            <label for="institucion2"  id="lblinstitucion2" class="form-label">Segunda Institución</label>
                            <input class="form-control" list="OpcionesInstitucion" id="institucion2" placeholder="Escriba para buscar...">
                        </div>

                        <div class="pb-3">   <!-- Datalist Instituciones 3 -->
                            <label for="institucion3" id="lblinstitucion3"  class="form-label">Tercera Institución</label>
                            <input class="form-control" list="OpcionesInstitucion" id="institucion3" placeholder="Escriba para buscar...">
                        </div>

                        <div class="pb-3">   <!-- Datalist Instituciones 4 -->
                            <label for="institucion4" id="lblinstitucion4" class="form-label">Cuarta Institución</label>
                            <input class="form-control" list="OpcionesInstitucion" id="institucion4" placeholder="Escriba para buscar...">
                        </div>
                    </form>
                </div>
            </div>
        </div>  <!-- col -->

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
                                    <div class="form-floating mb-3">
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
                            
                                <div class="pb-3">   <!-- Datalist Motivo-->
                                    <!-- <label for="datalistSupervisor" class="form-label">Segunda Institución</label> -->
                                    <div class="form-floating mb-1 mt-1">
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
                            
                            <div class="row">
                                    
                                
                                        

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
                        <h5 class="card-title mb-0">Horarios</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="card-body">
                            <div class="row" id= 'hsEst1'>
                                <!-- <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="establecimiento1" placeholder="Establecimiento Sede">
                                        <label for="establecimiento1">Establecimiento</label>
                                    </div>
                                </div> -->
                                <div class="pb-2">
                                    <label for="nombreEst1" > <h5>Establecimiento</h5></label>
                                    <input class="form-control" placeholder="Nº Nombre CUE" id= "nombreEst1">        
                                </div>
                                
                                <div class="col-lg-4">
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
                                            <select class="form-select" id="diaEst1">
                                                <?php echo generarOpcionesDias(); ?>
                                            </select>

                                            <select class="form-select" id="diaEst2">
                                                <?php echo generarOpcionesDias(); ?>
                                            </select>

                                            <select class="form-select" id="diaEst3">
                                                <?php echo generarOpcionesDias(); ?>
                                            </select>

                                            <select class="form-select" id="diaEst4">
                                                <?php echo generarOpcionesDias(); ?>
                                            </select>

                                            <select class="form-select" id="diaEst5">
                                                <?php echo generarOpcionesDias(); ?>
                                            </select>
                                        </form>    
                                    </div>
                                </div>

                                <!-- Horarios de Inicio -->           
                                <div class="col-lg-4">
                                    <div class="pb-1">
                                        <form>
                                            <H6>Hora  Inicio</H6>
                                            <input id="horaIni1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaIni2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaIni3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaIni4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaIni5" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                        </form> 
                                    </div>
                                </div> 

                                <!-- Horarios de Fin -->
                                <div class="col-lg-4">
                                    <div class="pb-1">
                                        <form>
                                            <H6>Hora  Fin</H6>
                                            <input id="horaFin1" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaFin2" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaFin3" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaFin4" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            <input id="horaFin5" type="text" class="form-control 24hours-timepicker" placeholder="...">
                                            
                                        </form>  
                                    </div>
                                </div> 
                                
                            </div> <!-- Fin Hs Establecimiento 1 -->
                        </div>  <!-- Card Hs Est 1-->
                        
                        
                    </div>
                </div>
            </div>  <!-- col -->

        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                    <div class="d-flex flex-wrap gap-2">  
                        <button type="button" class="btn btn-outline-dark"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button> 
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
        institucion2.style.display = radios[1].checked || radios[2].checked || radios[3].checked ? "block" : "none";
        colSelecInstituciones.style.display = institucion2.style.display;
        lblinstitucion2.style.display = institucion2.style.display;
        institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion3.style.display = institucion3.style.display;
        institucion4.style.display = radios[3].checked ? "block" : "none";
        lblinstitucion4.style.display = institucion4.style.display;
    }

    // Añade el evento de cambio a cada radio button para ejecutar la función cuando cambie la selección
    radios.forEach(radio => {
        radio.addEventListener("change", toggleInstituciones);
    });

    // Oculta inicialmente todos los campos extra
    toggleInstituciones();
</script>
