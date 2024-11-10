<?php 
session_destroy();
?>
<body class="bg-color">

    <!-- Begin page -->
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
                                                    <a class='auth-logo' href='<?php echo $url; ?>vistas/modulos/inicio.php'>
                                                        <img src="<?php echo $url; ?>vistas/assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28"/>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="maintenance-img text-center pt-3">
                                            <img src="<?php echo $url; ?>vistas/assets/images/svg/logout.svg" height="72" alt="svg-logo">
                                        </div>
                                        
                                        <div class="text-center auth-title-section">
                                            <h3 class="text-dark fs-20 fw-medium mb-2">Cerraste tu sesión.</h3>
                                            <p class="text-muted fs-15">Gracias por usar el Sistema de Gestión de Suplentes</p>
                                        </div>
                                    
                                        <div class="text-center d-grid">
                                            <a class='btn btn-primary mt-3 me-1' href='<?php echo $url; ?>vistas/modulos/login.php'> Ingresar </a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-xl-6 col-lg-6 p-0 vh-100 d-flex justify-content-center account-page-bg"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END wrapper -->        
</body>
