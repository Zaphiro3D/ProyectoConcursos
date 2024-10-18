<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nueva Zona de Supervisión</h4>
        </div>
    </div>
    
    <div class="row"> <!-- Floating Labels -->
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Datos de la Zona de Supervisión</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    
                    <div class="row"> 
                        
                        <!-- <h6 class="fs-15 mb-3">Nombre</h6> -->
                        <div class="col-lg-12"> 
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                <label for="nombre">Nombre</label>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>  

            <div class="row">
                
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Seleccione un Supervisor</h5>
                        </div>
                        <div class="card-body">                           
                            <!-- Pantalla Seleccionar director -->
                            <?php include 'seleccionar_supervisor.php' ?>
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

