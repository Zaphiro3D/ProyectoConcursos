
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
                        <div class="col-lg-6">
                            <h6 class="fs-15 mb-3">Apellido</h6>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Apellido">
                                <label for="floatingInput">Apellido completo</label>
                            </div>

                            <h6 class="fs-15 mb-3">Nombre</h6>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Nombre">
                                <label for="floatingInput">Nombre completo</label>
                            </div>

                            <h6 class="fs-15 mb-3">DNI</h6>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="DNI">
                                <label for="floatingInput">Número de DNI sin puntos</label>
                            </div>

                        </div>

                        <div class="col-lg-6">
                        <h6 class="fs-15 mb-3">Email</h6>    
                        <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInputGrid" placeholder="nombre@ejemplo.com" value="nombre@ejemplo.com">
                                <label for="floatingInputGrid">Email</label>
                            </div>

                            <h6 class="fs-15 mb-3">Dirección</h6>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" placeholder="Direccion">
                                <label for="floatingInput">Dirección</label>
                            </div>

                            <h6 class="fs-15 mb-3">Teléfono</h6>
                            <div class="form-floating mb-3">
                                <input type="tel" class="form-control" id="floatingInput" placeholder="Telefono">
                                <label for="floatingInput">Teléfono sin 0 ni 15</label>
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
                                <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
                                    <option selected>Ver opciones</option>
                                    <option value="1">Director</option>
                                    <option value="2">Supervisor</option>
                                    <option value="3">Administrativo</option>
                                </select>
                                <label for="floatingSelect">Elegir rol</label>
                            </div>
                        </div>

                        <div class="col-lg-6">

                            <h6 class="fs-15 mb-3">Usuario y Contraseña</h6>

                            <div class="row g-2">
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control"  id="floatingInput"  disabled="" placeholder="DNI">
                                        <label for="floatingInput">Usuario: DNI sin puntos</label>
                                    </div>
                                </div>
                                <div class="col-md">
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="floatingPassword" placeholder="Contraseña">
                                        <label for="floatingPassword">Contraseña</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="d-flex flex-wrap gap-2">    
                <button type="button" class="btn btn-light"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                <button type="button" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button> 
                <!-- <button type="button" class="btn btn-primary"><i data-feather="trash-2"></i>Eliminar</button>  -->
            </div> 
        </div>
    </div>

</div> <!-- container-fluid -->

