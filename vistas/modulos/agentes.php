<div class="container-xxl">
    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Agentes</h4>
        </div>
    </div>
    <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="d-flex flex-wrap gap-2">    
            <button type="button" class="btn btn-primary"><i data-feather="plus"></i>Nuevo</button>
            <button type="button" class="btn btn-primary"><i data-feather="edit-2"></i>Editar</button>
            <button type="button" class="btn btn-primary"><i data-feather="trash-2"></i>Eliminar</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <a href="agregar_producto" class="btn btn-info">Agregar</a>
                </div><!-- end card header -->

                <div class="card-body">
                    <table id="datatable" class="table table-bordered table-striped dt-responsive table-responsive nowrap">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>DNI</th>
                            <th>Dirección</th>
                            <th>Teléfono</th> 
                            <th>Mail</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php

                                $productos = ControladorAgentes::ctrMostrarAgentes();
                                foreach ($productos as $key => $value) {                         
                            ?>
                            <tr style = "background-color:#000888">
                                <td> <?php echo $value["nombre"] ?></td>
                                <td> <?php echo $value["apellido"] ?></td>
                                <td> <?php echo $value["dni"] ?></td>
                                <td> <?php echo $value["direccion"] ?></td>
                                <td> <?php echo $value["telefono"] ?></td>
                                <td> <?php echo $value["email"] ?></td>
                                <td><a href="editar_producto" class="btn btn-warning"><i class="fas fa-edit"></i></a> <button class="btn btn-danger"><i class="fas fa-trash"></i></button></td>
                            </tr>

                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    
</div>

