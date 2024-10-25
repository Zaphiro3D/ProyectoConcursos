<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="tablaSelectMultiES" class="table table-striped table-hover dt-responsive nowrap w-100">  
                        <div class="table-title">
                        </div>        
                        <thead>
                            <tr>
                                <th>CUE</th>
                                <th>Tipo</th> 
                                <th>N°</th>
                                <th>Nombre</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $institucion = ControladorInstituciones::ctrMostrarInstituciones();
                                foreach ($institucion as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["cue"] ?></td>
                                <td> <?php echo $value["TipoInstitucion"] ?></td> 
                                <td> <?php echo $value["numero"] ?></td>
                                <td> <?php echo $value["institucion"] ?></td>
                            </tr>

                            <?php } ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>