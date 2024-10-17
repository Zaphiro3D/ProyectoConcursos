<div class="container-xxl">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="tablaSelectES" class="table table-striped table-hover dt-responsive nowrap w-100">  
                        <div class="table-title">
                        </div>        
                        <thead>
                            <tr>
                                <th>Zona</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $agentes = ControladorAgentes::ctrMostrarSupervisores();
                                foreach ($agentes as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["nombre"] ?></td> 
                            </tr>

                            <?php } ?>
                            
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>