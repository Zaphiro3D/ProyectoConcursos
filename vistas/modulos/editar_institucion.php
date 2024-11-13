<?php
$cue = "cue";
$valor = $rutas[1];

$institucion = ControladorInstituciones::ctrMostrarInstituciones($cue , $valor);
$agentes = ControladorAgentes::ctrMostrarAgentes(NULL, NULL);
$zonas = ControladorZonas::ctrMostrarZonas();
$tipos = ControladorInstituciones::ctrMostrarTipos();

if ($institucion) {
?>

<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Editar Institución</h4>
        </div>
    </div>

    <form method="POST">
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
                                    <input type="number" class="form-control" id="numero" name="numero" placeholder="numero">
                                    <label for="numero">N°</label>
                                </div>
                            </div>
                            <!-- <h6 class="fs-15 mb-3">Nombre</h6> -->
                            <div class="col-lg-6"> 
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" required>
                                    <label for="nombre">Nombre</label>
                                </div>
                            </div>
                                                        
                            <div class="col-lg-4"> 
                                <!-- <h6 class="fs-15 mb-3">CUE</h6> -->
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="cue" name="cue" placeholder="CUE" required>
                                    <label for="cue">CUE</label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row"> 
                            <div class="col-lg-6"> 
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="tipo" name="tipo" aria-label="Tipo" required>
                                        <option selected></option>
                                        <?php
                                        foreach ($tipos as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value["id_Tipo"]; ?>"><?php echo $value["tipo"];?> </option>
                                        <?php } ?>
                                    </select>
                                    <label for="tipo">Elegir tipo</label>
                                </div>
                            </div>

                            <div class="col-lg-6"> 
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="zona" name="zona" aria-label="Zona de Supervision">
                                        <option selected></option>
                                        <?php
                                        foreach ($zonas as $key => $value) {
                                        ?>
                                            <option value="<?php echo $value["id_ZonaSupervision"]; ?>"><?php echo $value["zona"];?> </option>
                                        <?php } ?>
                                        
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
                                <!-- Opciones Datalist Instituciones        -->
                                <datalist id="OpcAgentes">
                                    <?php
                                        foreach ($agentes as $key => $value) {               
                                    ?>
                                    <option value = <?php echo $value["apellido"] . ", " . $value["nombre"]. ' - DNI: ' . $value["dni"] ?> data-id="<?php echo $value["id_Agente"] ?>" ></option>
                                    <?php } ?>
                                </datalist>  
                            
                                <div class="form-floating mb-3">
                                    <div class="pb-3"> <!-- Datalist Agentes -->
                                        <label for="director" id="lblDirector" class="form-label">Agentes</label>
                                        <input class="form-control" list="OpcAgentes" id="director" name="director" placeholder="Escriba para buscar...">
                                    </div>
                                </div>
                                <!-- Campo oculto para almacenar solo el ID del director -->
                                <input type="hidden" id="director_id" name="director_id">
                            </div>
                        </div>                    
                    </div>             
                    
                </div>

                <?php
                $guardar = new ControladorInstituciones();
                $guardar->ctrEditarInstitucion();
                ?>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                            <div class="d-flex flex-wrap gap-2">  
                                <!-- Campo oculto para almacenar solo el ID de la institución -->
                                <input type="hidden" id="id_Institucion" name="id_Institucion" value="<?php echo $institucion["id_institucion"]; ?>">

                                <button type="button" class="btn btn-outline-dark btnVolver" pag = "instituciones"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                                <button type="button" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button> 
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
        </div>
    </form>
</div> <!-- container-fluid -->
<?php } else { ?>
    <h3>Institución no disponible</h3>
<?php } ?>

