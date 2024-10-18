<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Editar Institución</h4>
        </div>
    </div>
    
    <div class="row"> <!-- Floating Labels -->
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Datos de la Institución</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    
                    <div class="row"> 
                        <div class="col-lg-2"> 
                            <!-- <h6 class="fs-15 mb-3">Número</h6> -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="numero" placeholder="DNI">
                                <label for="numero">N°</label>
                            </div>
                        </div>
                        <!-- <h6 class="fs-15 mb-3">Nombre</h6> -->
                        <div class="col-lg-6"> 
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>
                                                    
                        <div class="col-lg-4"> 
                            <!-- <h6 class="fs-15 mb-3">CUE</h6> -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="cue" placeholder="CUE">
                                <label for="cue">CUE</label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row"> 
                        <div class="col-lg-6"> 
                            <!-- <h6 class="fs-15 mb-3">Tipo</h6> -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="tipo" aria-label="Floating label select example">
                                    <option selected>Ver opciones</option>
                                    <option value="1">Escuela NINA</option>
                                    <option value="2">Escuela NEP</option>
                                    <option value="3">Escuela de Educación Integral</option>
                                    <option value="3">Centro Educativo Integral</option>
                                    <option value="3">Jardín Materno Infantil</option>
                                    <option value="3">Centro Integrador Comunitario</option>
                                    <option value="3">Equipo de Orientación Escolar (EOE)</option>
                                    <option value="3">Escuela Primaria de Jóvenes y Adultos</option>
                                    <option value="3">Centro Comunitario</option>
                                    <option value="3">Unidad Educativa de Nivel Inicial</option>
                                </select>
                                <label for="tipo">Elegir tipo</label>
                            </div>
                        </div>

                        <div class="col-lg-6"> 
                            <!-- <h6 class="fs-15 mb-3">Tipo</h6> -->
                            <div class="form-floating mb-3">
                                <select class="form-select" id="zona" aria-label="Floating label select example">
                                    <option selected>Ver opciones</option>
                                    <option value="1">Zona A</option>
                                    <option value="2">Zona B</option>
                                    <option value="3">...</option>
                                </select>
                                <label for="zona">Elegir Zona de Supervisión</label>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

            <div class="row">
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Seleccione un Director</h5>
                        </div>
                        <div class="card-body">                           
                            <!-- Pantalla Seleccionar director -->
                            <?php include 'seleccionar_director.php' ?>
                        </div>
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

