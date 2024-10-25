<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nueva Zona de Supervisión</h4>
        </div>
    </div>
    
    
    <div class="row"> <!-- Floating Labels -->
        <div class="col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Datos de la Zona de Supervisión</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    <div class="form-floating mb-3 mt-2">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        <label for="nombre">Nombre</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Seleccionar Supervisor</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    <!-- Opciones Datalist Instituciones -->       
                    <datalist id="OpcionesSupervisor">
                        <?php
                            $agentes = ControladorAgentes::ctrMostrarAgentes_noS();
                            foreach ($agentes as $key => $value) {   
                        ?>
                        <option ><?php echo $value["apellido"] . ", " . $value["nombre"]. ' - DNI: ' . $value["dni"] ?> </option>
                        <?php } ?>
                    </datalist>    
                
                    <div class="pb-3">   <!-- Datalist Supervisores-->
                        <!-- <label for="datalistSupervisor" class="form-label">Segunda Institución</label> -->
                        <div class="form-floating mb-1 mt-1">
                            <input class="form-control fs-14" list="OpcionesSupervisor" id="datalistSupervisor" placeholder="Escriba para buscar..." ></input>
                            <label for="datalistSupervisor">Escriba para buscar...</label>
                        </div>   
                    </div>    
                </div>
            </div>
        </div>  <!-- col -->
        
        <div class="col-12">
            <div class="row">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Seleccione las Instituciones</h5>
                    </div>
                    <div class="card-body">                           
                        <!-- Pantalla Seleccionar Supervisor -->
                        <?php include 'seleccionar_institucion.php' ?>
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

