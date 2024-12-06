<?php
// Función para opciones de select días
function generarOpcionesDias()
{
    $dias = ControladorSolSuplente::ctrMostrarDatosSol("dias", "*", null);
    $opciones = '<option value="">...</option>';
    foreach ($dias as $value) {
        $opciones .= "<option>{$value['nombre']}</option>";
    }
    return $opciones;
}

?>

<div class="container-xxl">
    <form method="POST">
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-22 fw-bold m-0">Nuevo Cargo</h4>
            </div>
        </div>

        <div class="col-12"> <!-- Floating Labels -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="col-lg-12">
                        <div class="card">

                            <div class="card-header">
                                <h5 class="card-title mb-0">Institución Sede</h5>
                            </div><!-- end card header -->

                            <div class="card-body">

                                <fieldset class="row mb-2 mt-1">
                                    <!-- Escuela Sede -->
                                    <!-- Debe completarse automaticamente dependiendo desde que institucion ingresa al sistema -->
                                    <div>

                                        <label for="institucionSede" id="lblinstitucion1" class="form-label">Institución Sede</label>
                                        <input 
                                            class="form-control" 
                                            list="OpcionesInstitucion" 
                                            id="institucionSede" 
                                            name="institucionSede" 
                                            placeholder="Escriba para buscar..."
                                            oninput="actualizarIdInstitucion(this, 'idInstitucion1')"
                                            required
                                        >

                                        <!-- <input type="text" class="form-control" id="nombreInstitucion1" value=""> -->
                                    </div>
                                </fieldset>

                            </div>
                        </div> <!-- card datos sede -->
                    </div> <!-- col -->


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos del Cargo</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="row mt-1">
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" list="numeroPlaza" name="numeroPlaza" placeholder="N° Plaza" required>
                                        <label for="plaza">N° Plaza</label>
                                    </div>
                                </div>


                                <div class="col-lg-9">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="id_NombreCargo" name="id_NombreCargo" aria-label="Floating label select example" required>
                                            <option value="" selected></option>
                                            <?php

                                            $cargos = ControladorSolSuplente::ctrMostrarDatosSol("nombres_cargos", "*", null);
                                            foreach ($cargos as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value['id_NombreCargo']; ?>"><?php echo $value['nombreCargo']; ?></option>

                                            <?php } ?>

                                        </select>
                                        <label for="cargo">Cargo</label>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="turnos" name="id_Turno" aria-label="Floating label select example" required>
                                            <option value="" selected></option>
                                            <?php
                                            $turno = ControladorSolSuplente::ctrMostrarDatosSol("turnos", "*", null);
                                            foreach ($turno as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value["id_Turno"] ?>"><?php echo $value["turno"]  ?></option>

                                            <?php } ?>

                                        </select>
                                        <label for="turno">Turno</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="grados" name="id_Grado" aria-label="Floating label select example">
                                            <option value="" selected></option>
                                            <?php
                                            $grado = ControladorSolSuplente::ctrMostrarDatosSol("grados", "*", null);
                                            foreach ($grado as $key => $value) {
                                            ?>
                                                <option value="<?php echo $value["id_Grado"] ?>"><?php echo $value["grado"]  ?></option>
                                            <?php } ?>
                                        </select>


                                        <label for="anio">Año</label>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-floating mb-3">
                                        <select class="form-select" id="divisiones" name="id_Division" aria-label="Floating label select example">
                                            
                                            <option value="" selected <?php echo empty($_POST['rol']) ? 'selected' : ''; ?>></option>

                                            <!-- Opciones dinámicas -->
                                            <?php 
                                            $division = ControladorSolSuplente::ctrMostrarDatosSol("divisiones", "*", null);
                                            foreach ($division as $key => $value): 
                                            ?>
                                                <option 
                                                    value="<?php echo $value["id_Division"]; ?>" 
                                                    <?php echo (isset($_POST['division']) && $_POST['division'] == $value["id_Division"]) ? 'selected' : ''; ?>>
                                                    <?php echo htmlspecialchars($value["division"]); ?>
                                                </option>
                                            <?php endforeach; ?>

                                        </select>

                                        <label for="division">División</label>
                                    </div>
                                </div>
                                <div class="col-lg-1">
                                    <div class="form-floating mb-3">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" id="hsCatedra" name="hsCatedra" placeholder="hsCat">
                                            <label for="hsCatedra">Hs. Cát.</label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div> <!-- col -->
            </div> <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Datos del Agente</h5>
                        </div><!-- end card header -->

                        <div class="card-body">

                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="nombreDocente" name="nombreDocente" placeholder="Nombre">
                                        <label for="nombreDocente">Nombre</label>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-floating mb-1">
                                        <input type="text" class="form-control" id="apellidoDocente" name="apellidoDocente" placeholder="Apellido">
                                        <label for="apellidoDocente">Apellido</label>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <!-- <h6 class="fs-15 mb-3">DNI</h6> -->
                                    <div class="form-floating mb-1">
                                        <input type="number" class="form-control" id="dniDocente" name="dniDocente" placeholder="DNI">
                                        <label for="dniDocente">Número de DNI sin puntos</label>
                                    </div>
                                </div>

                            </div> <!-- row -->

                        </div> <!-- card body -->
                    </div> <!-- card -->
                </div> <!-- col -->



            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">¿Comparte con otra institución?</h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <fieldset class="row ">
                                <!-- <legend class="col-form-label pt-0 fs-14">¿Comparte con otra institución?</legend> -->
                                <div class="row row-cols-lg-auto g-2 align-items-center">
                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="noComparte" name="noComparte" value="option1" checked>
                                        <label class="form-check-label" for="noComparte">
                                            No comparte
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte1" name="comparte1" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte1">
                                            Comparte con 1 institución
                                        </label>
                                    </div>
                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte2" name="comparte2" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte2">
                                            Comparte con 2 instituciones
                                        </label>
                                    </div>

                                    <div class="form-check mb-2 mx-2">
                                        <input class="form-check-input" type="radio" name="gridRadiosComparte" id="comparte3" name="comparte3" value="option1" unchecked>
                                        <label class="form-check-label" for="comparte3">
                                            Comparte con 3 instituciones
                                        </label>
                                    </div>

                                </div>
                            </fieldset>
                        </div>
                    </div> <!-- card comparte -->
                </div> <!-- col -->

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Instituciones</h5>
                        </div><!-- end card header -->


                        <!-- Opciones Datalist Instituciones        -->
                        <datalist id="OpcionesInstitucion">
                            <?php 
                            $institucion = ControladorInstituciones::ctrMostrarInstituciones(null, null);
    
                            foreach ($institucion as $key => $value) { ?>
                                <option 
                                    value="<?php echo $value["tipo"] . ' N°' . $value["numero"] . ' ' . $value["institucion"] . ' CUE: ' . $value["cue"]; ?>" 
                                    data-id="<?php echo $value["id_institucion"]; ?>">
                                </option>
                            <?php } ?>
                        </datalist>


                        <div class="card-body">

                            <div class="row" id='Est1'> <!-- Est 1 -->
                                <div class="pb-2"> <!-- Datalist Instituciones 1 -->
                                    <label for="instituciones[0][id_Institucion]" id="lblinstitucion1" name="lblinstitucion1" class="form-label">Institución Sede</label>
                                    <input 
                                        class="form-control" 
                                        list="OpcionesInstitucion" 
                                        id="institucion1" 
                                        name="instituciones[0][id_Institucion]" 
                                        placeholder="Escriba para buscar..."
                                        oninput="actualizarIdInstitucion(this, 'idInstitucion1')"
                                    >
                                    <input 
                                        type="hidden" 
                                        id="idInstitucion1" 
                                        name="instituciones[0][id_Institucion]" 
                                        value=""
                                    >
                                    
                                </div>
                            </div> <!-- Fin Hs Establecimiento 1 -->

                            <div class="row" id='Est2'><!-- Est 2 -->
                                <div class="pb-2"> <!-- Datalist Instituciones 2 -->
                                    <label for="instituciones[1][id_Institucion]" id="lblinstitucion2" name="lblinstitucion2" class="form-label">Segunda Institución</label>
                                    <input 
                                        class="form-control" 
                                        list="OpcionesInstitucion" 
                                        id="institucion2" 
                                        name="instituciones[1][id_Institucion]" 
                                        placeholder="Escriba para buscar..."
                                        oninput="actualizarIdInstitucion(this, 'idInstitucion2')"
                                    >
                                    <input 
                                        type="hidden" 
                                        id="idInstitucion2" 
                                        name="instituciones[1][id_Institucion]" 
                                        value=""
                                    >
                                </div>
                            </div> <!-- Fin Hs Establecimiento 2 -->

                            <div class="row" id='Est3'><!-- Est 3 -->
                                <div class="pb-3"> <!-- Datalist Instituciones 3 -->
                                    <label for="instituciones[2][id_Institucion]" id="lblinstitucion3" class="form-label">Tercera Institución</label>
                                    <input 
                                        class="form-control" 
                                        list="OpcionesInstitucion" 
                                        id="institucion3" 
                                        name="instituciones[2][id_Institucion]" 
                                        placeholder="Escriba para buscar..."
                                        oninput="actualizarIdInstitucion(this, 'idInstitucion3')"
                                    >
                                    <input 
                                        type="hidden" 
                                        id="idInstitucion3" 
                                        name="instituciones[2][id_Institucion]" 
                                        value=""
                                    >
                                </div>
                            </div> <!-- Fin Establecimiento 3 -->

                            <div class="row" id='Est4'><!-- Est 4 -->
                                <div class="pb-3"> <!-- Datalist Instituciones 4 -->
                                    <label for="instituciones[3][id_Institucion]" id="lblinstitucion4" class="form-label">Cuarta Institución</label>
                                    <input 
                                        class="form-control" 
                                        list="OpcionesInstitucion" 
                                        id="institucion4" 
                                        name="instituciones[3][id_Institucion]" 
                                        placeholder="Escriba para buscar..."
                                        oninput="actualizarIdInstitucion(this, 'idInstitucion4')"
                                    >
                                    
                                    <input 
                                        type="hidden" 
                                        id="idInstitucion4" 
                                        name="instituciones[3][id_Institucion]" 
                                        value=""
                                    >
                                </div>
                            </div> <!-- Fin Hs Establecimiento 4 -->
                        </div>
                    </div>
                </div> <!-- col -->

                <?php
                $guardar = new ControladorCargos();
                $guardar->ctrAgregarCargo();
                
               ?>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="px-2 py-2 d-flex align-items-sm-center flex-sm-row flex-column">
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline-dark btnVolver" pag="cargos"> <i class="fa-solid fa-caret-left"></i> &nbsp; Cancelar</button>
                            <button type="button" class="btn btn-primary btnGuardar"><i class="fa-solid fa-floppy-disk"></i> &nbsp; Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> <!-- container-fluid -->

<!-- Script para habilitar las opciones segun la cantidad de instituciones  -->
<script>
    // Selecciona los radio buttons
    const radios = document.getElementsByName("gridRadiosComparte");
    // Selecciona los contenedores de instituciones usando querySelector
    const institucion2 = document.getElementById("institucion2");
    const institucion3 = document.getElementById("institucion3");
    const institucion4 = document.getElementById("institucion4");
    
    // Función para mostrar u ocultar campos según la opción seleccionada
    function toggleInstituciones() {
        // Institucion 2
        institucion2.style.display = radios[1].checked || radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion2.style.display = institucion2.style.display;
        
        // Institucion 3
        institucion3.style.display = radios[2].checked || radios[3].checked ? "block" : "none";
        lblinstitucion3.style.display = institucion3.style.display;
        
        // Institucion 4
        institucion4.style.display = radios[3].checked ? "block" : "none";
        lblinstitucion4.style.display = institucion4.style.display;
        
    }

    // Función para sincronizar el valor de la institucion sede en horario
    function syncFields(source, target) {
        target.value = source.value;
    }

    // Obtener los elementos de los campos
    const institucionSede = document.getElementById("institucionSede");
    const institucion1 = document.getElementById("institucion1");

    // Agregar event listeners para sincronizar los valores en ambos sentidos
    institucionSede.addEventListener("input", function() {
        syncFields(institucionSede, institucion1);
    });

    institucion1.addEventListener("input", function() {
        syncFields(institucion1, institucionSede);
    });
    //----- Fin sincronizar el valor de la institucion sede en horario -------

    // Añade el evento de cambio a cada radio button para ejecutar la función cuando cambie la selección
    radios.forEach(radio => {
        radio.addEventListener("change", toggleInstituciones);
    });

    // Oculta inicialmente todos los campos extra
    toggleInstituciones();

    function actualizarIdInstitucion(input, hiddenInputId) {
        const datalist = document.getElementById('OpcionesInstitucion');
        const hiddenInput = document.getElementById(hiddenInputId);
        
        // Obtén el valor ingresado en el input
        const valorIngresado = input.value;

        // Busca la opción seleccionada en el datalist
        const opcionSeleccionada = Array.from(datalist.options).find(
            (option) => option.value === valorIngresado
        );

        // Si se encuentra la opción, actualiza el hidden input con el ID
        if (opcionSeleccionada) {
            hiddenInput.value = opcionSeleccionada.getAttribute('data-id');
        } else {
            // Si el valor ingresado no coincide, limpia el hidden input
            hiddenInput.value = '';
        }
    }

</script>

