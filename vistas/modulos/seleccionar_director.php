<div class="container-xxl">
    <!--<div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
         <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Agentes</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">    
            <a href="nuevo_agente" class="btn btn-primary"><i class="fas fa-plus" ></i > &nbsp; Nuevo</a>
        </div> 
    </div>-->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="tablaSelectES" class="table table-striped table-hover dt-responsive nowrap w-100">  
                        <div class="table-title">
                            asd
                        </div>        
                        <thead>
                            <tr>
                                <th>Apellido</th>    
                                <th>Nombre</th>
                                <th>DNI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $agentes = ControladorAgentes::ctrMostrarAgentes();
                                foreach ($agentes as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["apellido"] ?></td>    
                                <td> <?php echo $value["nombre"] ?></td>
                                <td> <?php echo $value["dni"] ?></td>
                            </tr>

                            <?php } ?>
                            
                        </tbody>
                    </table>
                    
                </div>

            </div>
        </div>
    </div>
    
</div>