<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nuevo Agente</h4>
        </div>
    </div>
    
    <div class="row"> <!-- Floating Labels -->
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Datos del Agente</h5>
                </div><!-- end card header -->
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                            <div class="form-floating mb-3">
                                <input type="number" class="form-control" id="dni" placeholder="DNI">
                                <label for="dni">Número de DNI sin puntos</label>
                            </div>

                        </div>
                        <div class="col-lg-4">
                            <!-- <h6 class="fs-15 mb-3">Apellido</h6> -->

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="apellido" placeholder="Apellido">
                                <label for="apellido">Apellido completo</label>
                            </div>
                        </div>

                        <div class="col-lg-5">
                            <!-- <h6 class="fs-15 mb-3">Nombre</h6> -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                                <label for="nombre">Nombre completo</label>
                            </div>
                        </div>
                    </div>
                        
                    <div class="row">
                        <div class="col-lg-4">
                            <!-- <h6 class="fs-15 mb-3">Email</h6>  -->
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="nombre@ejemplo.com">
                                <label for="email">Email</label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- <h6 class="fs-15 mb-3">Dirección</h6> -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="direccion" placeholder="Direccion">
                                <label for="direccion">Dirección</label>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- <h6 class="fs-15 mb-3">Teléfono</h6> -->
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="telefono" placeholder="Telefono">
                                <label for="telefono">Teléfono sin 0 ni 15</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Acceso al Sistema</h5>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        
                        <div class="col-lg-6">
                            <h6 class="fs-15 mb-3">Rol</h6>
                            <div class="form-floating mb-3">
                                <select class="form-select" id="rol" aria-label="Floating label select example">
                                    <option selected>Ver opciones</option>
                                    <option value="1">Director</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">Administrativo</option>
                                </select>
                                <label for="rol">Elegir rol</label>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <h6 class="fs-15 mb-3">Usuario y Contraseña</h6>
                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  id="usuario"  disabled="" placeholder="DNI">
                                        <label for="usuario">Usuario: DNI sin puntos</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="contrasena" placeholder="Contraseña">
                                        <label for="contrasena">Contraseña</label>
                                    </div>
                                </div>
                            </div>
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

