<?php

$zonas = ControladorZonas::ctrMostrarZonas();
$instituciones = ControladorInstituciones::ctrMostrarInstituciones(null, null);
$rol = ControladorAgentes::ctrMostrorRolAgentes();

$validador = new validador();

$controlador  = new ControladorAgentes();
$resultado = $controlador->ctrAgregarAgente();
$errores = $resultado['errores'] ?? [];
$validado = $resultado['validado'] ?? '';

?>

<div class="container-xxl">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-22 fw-bold m-0">Nuevo Agente</h4>
        </div>
    </div>
    <form method="POST" class="needs-validation <?php echo $validado; ?>" novalidate>
        <div class="row"> <!-- Floating Labels -->
            <div class="col-12">
                <div class="card">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Datos del Agente</h5>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control <?php echo isset($errores['dni']) ? 'is-invalid' : ''; ?>" id="dni" name="dni" placeholder="DNI" value="<?= $_POST["dni"] ?? '' ?>" required>
                                    <label for="dni">Número de DNI sin puntos</label>
                                    <div class="invalid-feedback"><?php echo $errores['dni'] ?? 'Por favor, complete este campo.'; ?></div> 
                                </div>

                            </div>
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control <?php echo isset($errores['apellido']) ? 'is-invalid' : ''; ?>" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo htmlspecialchars($_POST['apellido'] ?? ''); ?>" required>
                                    <label for="apellido">Apellido completo</label>
                                    <div class="invalid-feedback"><?php echo $errores['apellido'] ?? 'Por favor, complete este campo.'; ?></div>    
                                </div>
                            </div>

                            <div class="col-lg-5">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre" value="<?= $_POST["nombre"] ?? '' ?>" required>
                                    <label for="nombre">Nombre completo</label>
                                    <div class="invalid-feedback"><?php echo $errores['nombre'] ?? 'Por favor, complete este campo.'; ?></div> 
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control <?php echo isset($errores['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="nombre@ejemplo.com" value="<?= $_POST["email"] ?? '' ?>" required>
                                    <label for="email">Email</label>
                                    <div class="invalid-feedback"><?php echo $errores['email'] ?? 'Por favor, complete este campo.'; ?></div> 
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control <?php echo isset($errores['direccion']) ? 'is-invalid' : ''; ?>" id="direccion" name="direccion" placeholder="Direccion" value="<?= $_POST["direccion"] ?? '' ?>">
                                    <label for="direccion">Dirección</label>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control <?php echo isset($errores['telefono']) ? 'is-invalid' : ''; ?>" id="telefono" name="telefono" placeholder="Telefono" value="<?= $_POST["telefono"] ?? '' ?>">
                                    <label for="telefono">Teléfono sin 0 ni 15</label>
                                    <div class="invalid-feedback"><?php echo $errores['telefono'] ?? ''; ?></div>    
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
                                            <select class="form-select <?php echo isset($errores['rol']) ? 'is-invalid' : ''; ?>" id="rol" name="rol" aria-label="Floating label select example" required>
                                                <option selected></option>
                                                <?php
                                                foreach ($rol as $key => $value) {
                                                ?>
                                                    <option value="<?php echo $value["idrol"]; ?>"><?php echo $value["rol"];?> </option>
                                                <?php } ?>
                                            </select>
                                            <label for="rol">Elegir rol</label>
                                            <div class="invalid-feedback"><?php echo $errores['rol'] ?? 'Por favor, complete este campo.'; ?></div> 

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
                                                    <input type="password" class="form-control <?php echo isset($errores['contrasena']) ? 'is-invalid' : ''; ?>" id="contrasena" name="contrasena" placeholder="Contraseña" value="<?= $_POST["contraseña"] ?? '' ?>" required>
                                                    <label for="contrasena">Contraseña</label>
                                                    <div class="invalid-feedback"><?php echo $errores['contrasena'] ?? 'Por favor, complete este campo.'; ?></div> 

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

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                                    <div class="d-flex flex-wrap gap-2">
                                        <button type="button" class="btn btn-outline-dark btnVolver" pag="agentes"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button>
                                        <button type="submit" class="btn btn-primary btnGuardar" pag="nuevo_agentes"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
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

<!-- Script js específico para modificaciones dinámicas de formulario -->
<script src="<?php echo $url; ?>vistas/assets/js/agente.js"></script>
