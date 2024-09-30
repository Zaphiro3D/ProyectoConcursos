<?php

$url = ControladorPlantilla::url();

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8" />
        <title>Sistema Lab 4</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo $url; ?>vistas/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Icons -->
        <link href="<?php echo $url; ?>vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    </head>



    <!-- body start -->
    <body data-menu-color="dark" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout">

            <!-- Topbar Start -->
            <?php include 'modulos/header.php' ?>
            <!-- end Topbar -->

            <!-- Left Sidebar Start -->
            <?php include 'modulos/menu.php' ?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
         
            <div class="content-page">
                    <?php

                    $rutas = explode('/',$_GET["pagina"]);

                    //print_r($rutas);

                    if (isset($_GET["pagina"]))
                    {
                        if ($rutas[0] == "categorias" ||                    
                            $rutas[0] == "productos" ||
                            $rutas[0] == "usuarios"
                        ) {
                        include "vistas/modulos/" . $rutas[0] . ".php";
                        }
                    }
                        

                    ?>
                


                <!-- Footer Start -->
               <?php include 'modulos/footer.php' ?>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Vendor -->
        <script src="<?php echo $url; ?>vistas/assets/libs/jquery/jquery.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/node-waves/waves.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/feather-icons/feather.min.js"></script>
        <!-- App js-->
        <script src="<?php echo $url; ?>vistas/assets/js/app.js"></script>
        
    </body>

 
</html>