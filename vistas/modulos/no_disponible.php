<!-- Begin page -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="text-center">
                <div class="m-4 text-center">
                    <a class='auth-logo' href='<?php echo $url; ?>'>
                        <img src="<?php echo $url; ?>vistas/assets/images/logo-dark.png" alt="logo-dark" class="mx-auto" height="28" />
                    </a>
                </div>

                <div class="maintenance-img">
                    <img src="<?php echo $url; ?>vistas/assets/images/svg/question.svg" class="img-fluid svg-limited" alt="denegado">
                </div>
                
                <div class="text-center">
                    <h3 class="mt-4 fw-semibold text-dark text-capitalize">Registro no disponible</h3>
                    <p class="text-muted">No hemos encontrado lo que buscaba. Intente volver a la página principal.<br></p>
                </div>

                <a class='btn btn-primary mt-3 me-1' href='<?php echo $url; ?>'>Volver</a>
            </div>
        </div>
    </div>
</div>

<style>
    /* Limita el tamaño del SVG */
    .svg-limited {
        width: 50%; /* Ajusta al 50% del contenedor */
        max-width: 300px; /* Establece un tamaño máximo opcional */
        height: auto; /* Mantiene la proporción */
        margin: 0 auto; /* Centra la imagen */
    }
</style>
