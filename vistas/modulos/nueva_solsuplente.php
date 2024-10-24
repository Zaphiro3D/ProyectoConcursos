<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nueva Solicitud de Suplente</h4>
        </div>
    </div>
    
    <div class="row"> <!-- Floating Labels -->
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Datos de las Instituciones</h5>
                </div><!-- end card header -->
                
                <div class="card-body">

                        <fieldset class="row mb-3"> 
                            <!-- Escuela Sede -->
                            <!-- Debe completarse automaticamente dependiendo desde que institucion ingresa al sistema -->
                            <div>
                                <label for="institucion1-deshab" class="form-label">Institución Sede</label>
                                <input type="text" class="form-control" id="institucion1-deshab" disabled="" value="Dirección Departamental de Escuelas dpto. Concordia CUE: 3009962">
                            </div>
                        </fieldset>

                
                </div>
            </div>  <!-- card datos sede -->
            
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Datos de las Instituciones</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    <form>
                        <div class="row mb-3">
                            <fieldset class="row mb-3">
                                <legend class="col-form-label pt-0 fs-14">¿Comparte con otra institución?</legend>
                                <div class="col-sm-10 d-flex gap-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="gridRadioComp1" value="option1" checked>
                                        <label class="form-check-label" for="gridRadioComp1">
                                            No comparte
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="gridRadioComp2" value="option1" unchecked>
                                        <label class="form-check-label" for="gridRadioComp2">
                                            Comparte con 1 institución
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="gridRadioComp3" value="option1" unchecked>
                                        <label class="form-check-label" for="gridRadioComp3">
                                            Comparte con 2 instituciones
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="gridRadioComp4" value="option1" unchecked>
                                        <label class="form-check-label" for="gridRadioComp4">
                                            Comparte con 3 instituciones
                                        </label>
                                    </div>
                                </div>     
                            </fieldset>                            
                        </div>
                    </form>
                </div>
            </div>

<!-- hacer un if que controle lo seleccionado en los check y que muestre para solicitar los datos de las otras instituciones  -->

            <div class="row">
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Seleccione las Instituciones Compartidas</h5>
                        </div>
                        <div class="card-body">   
                            <form>
                                <!-- Opciones Datalist Instituciones -->       
                                <datalist id="OpcionesInstitucion">
                                    <?php
                                        $institucion = ControladorInstituciones::ctrMostrarInstituciones();
                                        foreach ($institucion as $key => $value) {   
                                            // $cadena = "{$value["TipoInstitucion"]} N°{$value["numero"]}". '"' . "{$value["institucion"]}".'" '."CUE: {$value["cue"]}" ;                 
                                    ?>
                                    <option ><?php echo $value["TipoInstitucion"] . " N°" . $value["numero"]. '"' . $value["institucion"] .'" '."CUE: {$value["cue"]}"?> </option>
                                    <?php } ?>
                                </datalist>    
                            
                                <div class="pb-3">   <!-- Datalist Instituciones 2 -->
                                    <label for="datalistInstitucion2" class="form-label">Segunda Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="datalistInstitucion2" placeholder="Escriba para buscar...">
                                </div>

                                <div class="pb-3">   <!-- Datalist Instituciones 3 -->
                                    <label for="datalistInstitucion3" class="form-label">Tercera Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="datalistInstitucion3" placeholder="Escriba para buscar...">
                                </div>

                                <div class="pb-3">   <!-- Datalist Instituciones 4 -->
                                    <label for="datalistInstitucion4" class="form-label">Cuarta Institución</label>
                                    <input class="form-control" list="OpcionesInstitucion" id="datalistInstitucion4" placeholder="Escriba para buscar...">
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>             
                
            </div>

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Datos del Cargo</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    
                    <div class="row">
                            
                        
                                   

                    </div>
                    
                </div>
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
    </div>
</div> <!-- container-fluid -->

