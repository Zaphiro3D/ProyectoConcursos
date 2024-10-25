<?php

$url = ControladorPlantilla::url();

?>

<!DOCTYPE html>
<html lang="es">
    <head>

        <meta charset="utf-8" />
        <title>Sistema de Gestión de Suplentes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de Gestión de Solicitudes de Suplentes"/>
        <meta name="author" content="Ana y Vladimir"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="vistas/assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo $url; ?>vistas/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Iconos -->
        <link href="<?php echo $url; ?>vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- Otros iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

        <!-- Datatables css
        <link href="<?php echo $url; ?>vistas/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $url; ?>vistas/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $url; ?>vistas/assets/libs/datatables.net-keytable-bs5/css/keyTable.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $url; ?>vistas/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $url; ?>vistas/assets/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet" type="text/css" /> -->
         
        <!-- Datatables web -->
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/kt-2.12.1/r-3.0.3/sl-2.1.0/datatables.min.css" rel="stylesheet">
 
        <!-- Datatables Traduccion Español -->                 
        <script src= "<?php echo $url; ?>vistas/assets/libs/DataTables-ES.js"></script>
        
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

                    if (isset($_GET["pagina"]))
                    {
                        $rutas = explode('/',$_GET["pagina"]);
                        if (
                            // Agentes
                            $rutas[0] == "agentes" ||
                            $rutas[0] == "nuevo_agente" ||
                            $rutas[0] == "editar_agente" ||
                            // Instituciones
                            $rutas[0] == "instituciones" ||
                            $rutas[0] == "nueva_institucion" ||
                            $rutas[0] == "editar_institucion" ||
                            // Zonas
                            $rutas[0] == "zonasSupervision" ||
                            $rutas[0] == "nueva_zona" ||
                            $rutas[0] == "editar_zona" ||

                            // Solicitudes de Suplente
                            $rutas[0] == "solicitudesSuplente"||                            
                            $rutas[0] == "nueva_solsuplente" ||
                            $rutas[0] == "editar_editar_solsuplente" ||

                            // otros
                            $rutas[0] == "elementos_formularios" ||
                            $rutas[0] == "login"
                            
                        ) {
                            include "vistas/modulos/" . $rutas[0] . ".php";
                        }else{
                            include "vistas/modulos/404.php";
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
        
        <!-- Datatables js
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>

        dataTables.bootstrap5
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>

        dataTable.responsive
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
        
        dataTables.select 
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/libs/datatables.net-select-bs5/js/select.bootstrap5.min.js"></script>

        Datatable Demo App Js
        <script src="<?php echo $url; ?>vistas/assets/js/pages/datatable.init.js"></script>
        -->
        
        <!-- dataTables.net web -->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>-->
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/kt-2.12.1/r-3.0.3/sl-2.1.0/datatables.min.js"></script>

        
        
        <!-- App js-->
        <script src="<?php echo $url; ?>vistas/assets/js/app.js"></script>
        

    </body>
    
</html>