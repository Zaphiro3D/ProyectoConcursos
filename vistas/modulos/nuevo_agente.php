<?php
$zonas = ControladorZonas::ctrMostrarZonas();
$instituciones = ControladorInstituciones::ctrMostrarInstituciones(null, null);
$rol = ControladorAgentes::ctrMostrorRolAgentes();
?>

<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nuevo Agente</h4>
        </div>
    </div>
    <form method="POST">
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
                                    <input type="number" class="form-control" id="dni" name="dni" placeholder="DNI" value="<?= $_POST["dni"] ?? '' ?>" required>
                                    <label for="dni">Número de DNI sin puntos</label>
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <!-- <h6 class="fs-15 mb-3">Apellido</h6> -->

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" value="<?= $_POST["apellido"] ?? '' ?>" required>
                                    <label for="apellido">Apellido completo</label>
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <!-- <h6 class="fs-15 mb-3">Nombre</h6> -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" value="<?= $_POST["nombre"] ?? '' ?>" required>
                                    <label for="nombre">Nombre completo</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <!-- <h6 class="fs-15 mb-3">Email</h6>  -->
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="nombre@ejemplo.com" value="<?= $_POST["email"] ?? '' ?>" required>
                                    <label for="email">Email</label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- <h6 class="fs-15 mb-3">Dirección</h6> -->
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Direccion" value="<?= $_POST["direccion"] ?? '' ?>">
                                    <label for="direccion">Dirección</label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <!-- <h6 class="fs-15 mb-3">Teléfono</h6> -->
                                <div class="form-floating mb-3">
                                    <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="Telefono" value="<?= $_POST["telefono"] ?? '' ?>">
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

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <h6 class="fs-15 mb-3">Rol</h6>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" id="rol" name="rol" aria-label="Floating label select example" required>
                                                <option selected></option>
                                                    <?php
                                                    foreach ($rol as $key => $value) {
                                                    ?>
                                                        <option value="<?php echo $value["idrol"]; ?>"><?php echo $value["rol"];?> </option>
                                                    <?php } ?>
                                                <!--option value="1">Director</option>
                                                <option value="2">Supervisor</option>
                                                <option value="3">Administrativo</option-->
                                            </select>
                                            <label for="rol">Elegir rol</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <h6 class="fs-15 mb-3">Usuario y Contraseña</h6>
                                        <div class="row g-2">
                                            <div class="col-md">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="usuario" name="usuario" disabled="" placeholder="DNI" value="<?= $_POST["email"] ?? '' ?>" required>
                                                    <label for="usuario">Usuario: correo electrónico</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña" value="<?= $_POST["contraseña"] ?? '' ?>" required>
                                                    <label for="contrasena">Contraseña</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card" id="cardInstiRol">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Seleccione la Institucion Correspondiente al Rol</h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <!-- Opciones Datalist Instituciones -->
                                        <datalist id="OpcInstituciones">
                                            <?php
                                            foreach ($instituciones as $key => $value) {
                                            ?>
                                                <option id="<?php echo $value["id_institucion"]; ?>" data-id="<?php echo $value["id_institucion"]; ?>"><?php echo $value["tipo"] . " N°" . $value["numero"] . '" ' . $value["institucion"] . '" ' . "CUE: {$value["cue"]}" ?> </option>
                                            <?php } ?>
                                        </datalist>

                                        <div class="pb-3"> <!-- Datalist Instituciones-->
                                            <div class="form-floating mb-1 mt-1">
                                                <input class="form-control fs-14" list="OpcInstituciones" id="dlInstituciones" name="dlInstituciones" placeholder="Escriba para buscar..."></input>
                                                <label for="dlInstituciones">Escriba para buscar...</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="card" id="cardZonaRol">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Seleccione la Zona Correspondiente al Rol</h5>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="row">

                                    <div class="col-lg-12">
                                        <!-- Opciones Datalist Zonas -->
                                        <datalist id="OpcZonas" name="OpcZonas">
                                            <?php
                                            foreach ($zonas as $key => $value) {
                                            ?>
                                                <option data-id="<?php echo $value["id_ZonaSupervision"]; ?>" ><?php echo $value["zona"] ?> </option>
                                            <?php } ?>
                                        </datalist>

                                        <div class="pb-3"> <!-- Datalist Zonas-->
                                            <div class="form-floating mb-1 mt-1">
                                                <input class="form-control fs-14" list="OpcZonas" id="dlZonas" name="dlZonas" placeholder="Escriba para buscar..."></input>
                                                <label for="dlZonas">Escriba para buscar...</label>
                                            </div>
                                        </div>
                                        <!-- Campo oculto para almacenar solo el ID de la institucion o del agente para autocompletar el datalist-->
                                        <input type="hidden" id="id_autocompletar" name="id_autocompletar">
                                    </div>
                                </div>
                            </div>

                        </div>
                        <?php
                        $guardar = new ControladorAgentes();
                        $guardar->ctrAgregarAgente();
                        ?>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-outline-dark btnVolver" pag="agentes"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button>
                                        <button type="button" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> <!-- container-fluid -->

<script>
// Función para guardar el id en el campo oculto y 
// seleccionar automaticamente la mejor coincidencia en datalist

//                  input         opciones      campo oculto
autoSelectBestMatch("dlInstituciones", "OpcInstituciones", "id_autocompletar");
autoSelectBestMatch("dlZonas", "OpcZonas", "id_autocompletar");
</script>
