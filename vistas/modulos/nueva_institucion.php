<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nueva Institución</h4>
        </div>
    </div>
    
    <div class="row"> <!-- Floating Labels -->
        <div class="col-12">
            <div class="card">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Datos de la Institución</h5>
                    </div><!-- end card header -->
                    
                    <div class="card-body">
                        <div class="row">
                        <h6 class="fs-15 mb-3">Nombre</h6>
                            <div class="col-lg-12"> 
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" placeholder="Nombre">
                                    <label for="floatingInput">Nombre</label>
                                </div>
                            </div>

                            <div class="row">                               
                                <div class="col-lg-4"> 
                                    <h6 class="fs-15 mb-3">CUE</h6>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="CUE">
                                        <label for="floatingInput">CUE</label>
                                    </div>
                                </div>

                                <div class="col-lg-6"> 
                                    <h6 class="fs-15 mb-3">Tipo</h6>
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example">
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
                                        <label for="floatingSelect">Elegir rol</label>
                                    </div>
                                </div>

                                <div class="col-lg-2"> 
                                <h6 class="fs-15 mb-3">Número</h6>
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" placeholder="DNI">
                                    <label for="floatingInput">N°</label>
                                </div>
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
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                                    <div class="d-flex flex-wrap gap-2">  
                                        <button type="button" class="btn btn-light"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button> 
                                        <button type="button" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

</div> <!-- container-fluid -->

