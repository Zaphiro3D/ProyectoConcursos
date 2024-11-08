<body class="bg-color">
    <?php
        //echo $encriptar;
    ?>
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-12">
                <div class="p-0">
                    <div class="row d-flex align-items-center">
                        <div class="col-md-6 col-xl-6 col-lg-6">
                            <div class="row">
                                <div class="col-md-6 mx-auto">
                                    <div class="mb-0 border-0">
                                        <div class="p-0">
                                            <div class="text-center">
                                                <div class="mb-4">
                                                    <a href="index.html" class="auth-logo">
                                                        <img src="vistas/assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28" />
                                                    </a>
                                                </div>
                        
                                                <div class="auth-title-section mb-3"> 
                                                    <h3 class="text-dark fs-20 fw-medium mb-2">Bienvenido</h3>
                                                    <p class="text-dark fs-14 mb-0">Ingrese sus datos.</p>
                                                </div>
                                            </div>
                                        </div>
        
                                        <div class="pt-0">
                                            <form method="POST" class="my-4">
                                                <div class="form-group mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input class="form-control" type="email" id="email" name="email" required="" placeholder="Ingrese su email">
                                                </div>
                    
                                                <div class="form-group mb-3">
                                                    <label for="password" class="form-label">Contraseña</label>
                                                    <input class="form-control" type="password" required="" id="password" name="password" placeholder="Ingrese su contraseña">
                                                </div>
                    
                                                <!-- <div class="form-group d-flex mb-3">                                                        
                                                    <div class="col-sm-6 text-end">
                                                        <a class='text-muted fs-14' href='auth-recoverpw.html'>Olvidó su contraseña?</a>                             
                                                    </div>
                                                </div> -->
                                                
                                                <div class="form-group mb-0 row">
                                                    <div class="col-12">
                                                        <div class="d-grid">
                                                            <button class="btn btn-primary" type="submit"> Ingresar </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php 
                                                    $ingreso = new ControladorAgentes();
                                                    $ingreso -> ctrIngresoAgente();
                                                ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6 col-lg-6 p-0 vh-100 d-flex justify-content-center account-page-bg">
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</body>