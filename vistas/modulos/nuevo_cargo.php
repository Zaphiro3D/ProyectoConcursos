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

<div class="container-xxl">
    <form method="POST">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-22 fw-bold m-0">Nuevo Cargo</h4>
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
                                                $turno = ModeloSolSuplente::mdlMostrarTurnoSol();
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
                                                $grado = ModeloSolSuplente::mdlMostrarGradoSol();
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
                                                $Division = ModeloSolSuplente::mdlMostrarDivisionSol();
                                                foreach($Division as $key => $value){
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
                                            <label for="nombreAgente">Hs. Cát.</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                        </div>
                    </div>
                </div>  <!-- col -->
            </div>  <!-- row -->

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
                                        <input type="text" class="form-control" id="nombreAgente" placeholder="Nombre">
                                        <label for="nombreAgente">Nombre</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="apellidoAgente" placeholder="Apellido">
                                        <label for="apellidoAgente">Apellido</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                                    <div class="form-floating mb-1">
                                        <input type="number" class="form-control" id="dniAgente" placeholder="DNI">
                                        <label for="dniAgente">Número de DNI sin puntos</label>
                                    </div>
                                </div>

                            </div>  <!-- row -->
                            
                        </div>  <!-- card body -->
                    </div>  <!-- card -->
                </div>  <!-- col -->



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
                            $institucion = ControladorInstituciones::ctrMostrarInstituciones();
                            foreach ($institucion as $key => $value) {   
                        ?>
                        <option ><?php echo $value["tipo"] . " N°" . $value["numero"]. '" ' . $value["institucion"] .'" '."CUE: {$value["cue"]}"?> </option>
                        <?php } ?>
                    </datalist>    

                    <div class="card-body">
                        
                            <div class="row" id= 'hsEst1'> <!-- Est 1 -->
                                <div class="pb-2">   <!-- Datalist Instituciones 1 -->
                                    <label for="institucion1"  id="lblinstitucion1" class="form-label">Institución Sede</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion1" placeholder="Escriba para buscar...">
                                </div>                                
                            </div> <!-- Fin Hs Establecimiento 1 -->
                        
                            <div class="row" id= 'hsEst2'><!-- Est 2 -->
                                <div class="pb-2">   <!-- Datalist Instituciones 2 -->
                                    <label for="institucion2"  id="lblinstitucion2" class="form-label">Segunda Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion2" placeholder="Escriba para buscar...">
                                </div>  
                            </div> <!-- Fin Hs Establecimiento 2 -->                        
                        
                            <div class="row"  id= 'hsEst3'><!-- Est 3 --> 
                                <div class="pb-3">   <!-- Datalist Instituciones 3 -->
                                    <label for="institucion3" id="lblinstitucion3"  class="form-label">Tercera Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion3" placeholder="Escriba para buscar...">
                                </div>
                            </div> <!-- Fin Hs Establecimiento 3 -->
                        
                            <div class="row" id= 'hsEst4'><!-- Est 4 -->
                                <div class="pb-3">   <!-- Datalist Instituciones 4 -->
                                    <label for="institucion4" id="lblinstitucion4" class="form-label">Cuarta Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="institucion4" placeholder="Escriba para buscar...">
                                </div>
                            </div> <!-- Fin Hs Establecimiento 4 -->
                    </div>
                </div>
            </div>  <!-- col -->

            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="d-flex flex-wrap gap-2">  
                            <button type="button" class="btn btn-outline-dark btnVolver" pag = "cargos" > <i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
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
