<?php
$agente = "id_agente";
$valor = $rutas[1];


$agente_selec = ControladorAgentes::ctrMostrarAgentes($agente, $valor);
$zonas = ControladorZonas::ctrMostrarZonas(null, null);
$instituciones = ControladorInstituciones::ctrMostrarInstituciones(null, null);
$rol = ControladorAgentes::ctrMostrarRolAgentes();

$validador = new validador();

$controlador  = new ControladorAgentes();
$resultado = $controlador->ctrEditarAgente();
$errores = $resultado['errores'] ?? [];
$validado = $resultado['validado'] ?? '';

if (isset($_SESSION["autorizacion"])) {
    $rol = $_SESSION["autorizacion"];
}
if ($rol == 1){
    if ($agente_selec) {
    ?>

        <div class="container-xxl">

            <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
                <div class="flex-grow-1">
                    <h4 class="fs-22 fw-bold m-0">Editar Agente</h4>
                </div>
            </div>
            <form method="POST" novalidate>
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
                                            <input type="number" class="form-control <?php echo isset($errores['dni']) ? 'is-invalid' : ''; ?>" id="dni" name="dni" placeholder="DNI" value="<?php echo $_POST['dni'] ?? $agente_selec['dni']; ?>" required>
                                            <label for="dni">Número de DNI sin puntos</label>
                                            <div class="invalid-feedback"><?php echo $errores['dni'] ?? 'Por favor, complete este campo.'; ?></div>
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control <?php echo isset($errores['apellido']) ? 'is-invalid' : ''; ?>" id="apellido" name="apellido" placeholder="Apellido" value="<?php echo $_POST['apellido'] ?? $agente_selec['apellido']; ?>" required>
                                            <label for="apellido">Apellido completo</label>
                                            <div class="invalid-feedback"><?php echo $errores['apellido'] ?? 'Por favor, complete este campo.'; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-5">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" id="nombre" name="nombre" placeholder="Nombre" value="<?php echo $_POST['nombre'] ?? $agente_selec['nombre']; ?>" required>
                                            <label for="nombre">Nombre completo</label>
                                            <div class="invalid-feedback"><?php echo $errores['nombre'] ?? 'Por favor, complete este campo.'; ?></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="email" class="form-control <?php echo isset($errores['email']) ? 'is-invalid' : ''; ?>" id="email" name="email" placeholder="nombre@ejemplo.com" value="<?php echo $_POST['email'] ?? $agente_selec['email']; ?>" required>
                                            <label for="email">Email</label>
                                            <div class="invalid-feedback"><?php echo $errores['email'] ?? 'Por favor, complete este campo.'; ?></div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control <?php echo isset($errores['direccion']) ? 'is-invalid' : ''; ?>" id="direccion" name="direccion" placeholder="Direccion" value="<?php echo $_POST['direccion'] ?? $agente_selec['direccion']; ?>">
                                            <label for="direccion">Dirección</label>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-floating mb-3">
                                            <input type="tel" class="form-control <?php echo isset($errores['telefono']) ? 'is-invalid' : ''; ?>" id="telefono" name="telefono" placeholder="Telefono" value="<?php echo $_POST['telefono'] ?? $agente_selec['telefono']; ?>">
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

                                    <div class="col-lg-6">
                                        <h6 class="fs-15 mb-3">Rol</h6>
                                        <div class="form-floating mb-3">
                                            <select
                                                class="form-select <?php echo isset($errores['rol']) ? 'is-invalid' : ''; ?>"
                                                id="rol"
                                                name="rol"
                                                aria-label="rol"
                                                required>
                                                <!-- Opción predeterminada no válida -->
                                                <option value="" disabled <?php echo empty($_POST['rol']) && empty($agente_selec["id_Rol"]) ? 'selected' : ''; ?>>
                                                    Seleccione un rol
                                                </option>

                                                <!-- Opciones dinámicas -->
                                                <?php foreach ($rol as $key => $value): ?>
                                                    <option
                                                        value="<?php echo $value["idrol"]; ?>"
                                                        <?php
                                                        // Priorizar selección del formulario si fue enviado
                                                        if (isset($_POST['rol']) && $_POST['rol'] == $value["idrol"]) {
                                                            echo 'selected';
                                                        }
                                                        // Si no hay envío, mostrar el rol actual del agente
                                                        elseif (!isset($_POST['rol']) && $agente_selec["id_Rol"] == $value["idrol"]) {
                                                            echo 'selected';
                                                        }
                                                        ?>>
                                                        <?php echo htmlspecialchars($value["rol"]); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                            <label for="rol">Elegir rol</label>
                                            <div class="invalid-feedback">
                                                <?php echo $errores['rol'] ?? 'Por favor, seleccione un rol válido.'; ?>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <h6 class="fs-15 mb-3">Usuario y Contraseña</h6>
                                        <div class="row g-2">
                                            <div class="col-md">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" id="usuario" name="usuario" disabled="" placeholder="usuario" value="<?php echo $_POST['usuario'] ?? $agente_selec['usuario']; ?>" required>
                                                    <label for="usuario">Usuario: correo electrónico</label>
                                                </div>
                                            </div>
                                            <div class="col-md">
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control <?php echo isset($errores['contrasena']) ? 'is-invalid' : ''; ?>" id="contrasena" name="contrasena" placeholder="Contraseña" value="<?php echo $_POST['contrasena'] ?? $agente_selec['contrasena'] ?? 'Sin cambios'; ?>" required>
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
                                            foreach ($zonas as $key => $value) { ?>
                                                
                                                <option data-id="<?php echo $value["id_ZonaSupervision"] ?>"><?php echo $value["zona"] ?>
                                                </option>


                                            <?php } ?>
                                        </datalist>

                                        <div class="pb-3"> <!-- Datalist Zonas
                                                                                                                                                ?> </option>-->

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
                                        <input type="hidden" name="id_Agente" value="<?php echo $agente_selec["id_Agente"]; ?>">

                                        <a class="btn btn-outline-dark btnVolver" pag="<?php echo ControladorPlantilla::url(); ?>agentes"><i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</a>
                                        <button type="submit" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> <!-- container-fluid -->
    <?php } else { ?>
        <?php include 'no_disponible.php'; ?>
    <?php } 
}else { ?>
    <?php include 'acceso_denegado.php'; ?>
    <script>
    Swal.fire({
        title: "Error",
        text: "Permisos Insuficientes.",
        icon: "error",
        confirmButtonColor: "#3085d6",
        confirmButtonText: "OK",
    }).then(function (result) {
    });
  </script>
<?php } ?>

<!-- Script js específico para modificaciones dinámicas de formulario -->
<script src="<?php echo $url; ?>vistas/assets/js/agente.js"></script>