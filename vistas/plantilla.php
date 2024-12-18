<?php
session_start();
$url = ControladorPlantilla::url();

?>

<!DOCTYPE html>
<html lang="es">

    <head>

        <meta charset="utf-8" />
        <title>Sistema de Gestión de Suplentes</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Sistema de Gestión de Solicitudes de Suplentes" />
        <meta name="author" content="Ana y Vladimir" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="vistas/assets/images/favicon.ico">

        <!-- Flatpickr Timepicker css -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        <!-- App css -->
        <link href="<?php echo $url; ?>vistas/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

        <!-- Iconos -->
        <link href="<?php echo $url; ?>vistas/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

        <!-- Otros iconos -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />

        <!-- Datatables web -->
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/kt-2.12.1/r-3.0.3/sl-2.1.0/datatables.min.css" rel="stylesheet">

        <!-- Datatables Traduccion Español -->
        <script src="<?php echo $url; ?>vistas/assets/js/espanol-dt.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/js/DataTables-ES.js"></script>

        <!-- Alertas -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="<?php echo $url; ?>vistas/assets/js/alerts.js"></script>
        <script src="<?php echo $url; ?>vistas/assets/js/alerts_Confirmaciones.js"></script>

        <!-- Autocompletar Datalist -->
        <script src="<?php echo $url; ?>vistas/assets/js/autocompletar_dl.js"></script>

    </head>

    <?php
         if (isset($_GET["pagina"]) && $_GET["pagina"] === "salir") {
             session_destroy();
             header("Location: login");
             exit();
         }
    ?>
    <!-- body -->
    <?php if (isset($_SESSION["iniciarSesion"])) { ?>

        <body data-menu-color="dark" data-sidebar="default">

            <!-- Inicio de Página -->
            <div id="app-layout">

                <!-- Barra Superior -->
                <?php include 'modulos/header.php' ?>

                <!-- Barra lateral izquierda -->
                <?php include 'modulos/menu.php' ?>

                <!-- ============================================================== -->
                <!-- Inicio del Contenido -->
                <!-- ============================================================== -->

                <div class="content-page">
                    <?php

                    if (isset($_GET["pagina"])) {
                        $rutas = explode('/', $_GET["pagina"]);

                        // Validar otras rutas
                        if (
                            // Agentes
                            $rutas[0] == "agentes" ||
                            $rutas[0] == "nuevo_agente" ||
                            $rutas[0] == "editar_agente" ||

                            // Cargos
                            $rutas[0] == "cargos" ||
                            $rutas[0] == "nuevo_cargo" ||
                            $rutas[0] == "editar_cargo" ||

                            // Instituciones
                            $rutas[0] == "instituciones" ||
                            $rutas[0] == "nueva_institucion" ||
                            $rutas[0] == "editar_institucion" ||

                            // Zonas
                            $rutas[0] == "zonasSupervision" ||
                            $rutas[0] == "nueva_zona" ||
                            $rutas[0] == "editar_zona" ||

                            // Solicitudes de Suplente
                            $rutas[0] == "solicitudesSuplente" ||
                            $rutas[0] == "nueva_solsuplente" ||
                            $rutas[0] == "editar_solsuplente"||

                            // General
                            $rutas[0] == "acceso_denegado" ||
                            $rutas[0] == "inicio" ||
                            $rutas[0] == "salir" 
                        ) {
                            include "vistas/modulos/" . $rutas[0] . ".php";
                        } else {
                            include "vistas/modulos/404.php";
                        }
                    } else {
                        include "vistas/modulos/inicio.php";
                    }

                    ?>

                    <?php include 'modulos/footer.php'; ?>

                </div>





                
                <!-- ============================================================== -->
                <!-- Fin del contenido -->
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

            <!-- Flatpickr Timepicker Plugin js -->
            <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
            <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/es.js"></script> <!-- Traduccion al español -->
            <script src="<?php echo $url; ?>vistas/assets/js/pages/form-picker.js"></script>

            <!-- DataTables.net web -->
            <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.1.8/b-3.1.2/b-colvis-3.1.2/b-html5-3.1.2/b-print-3.1.2/kt-2.12.1/r-3.0.3/sl-2.1.0/datatables.min.js"></script>

            <!-- App js-->
            <script src="<?php echo $url; ?>vistas/assets/js/app.js"></script>

        </body>
    <?php } else {
        include "vistas/modulos/login.php";
    }

    ?>

</html>