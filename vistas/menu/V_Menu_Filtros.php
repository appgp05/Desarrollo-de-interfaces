<?php
    $usuarios = [];
    $roles = [];
    extract($datos);
    // echo '<pre>';
    // print_r($roles);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($usuarios);
    // echo '</pre>';
?>

<h2>Mtto. de Menu</h2>
<div class="container-fluid" id="capaFiltrosBusqueda">
    <form id="formularioBuscar" name="formularioBuscar">
        <div class="form-group col-md-6 col-sm-12">
            <label for="">Nombre/texto:</label>
            <input type="text" id="ftexto" name="ftexto"
                class="form-control" placeholder="Texto a buscar" value="">
        </div>
        <div class="form-group col-md-3 col-sm-3">
            <label for="">Usuario:</label>
            <select type="text" id="ftextoUsuario" name="ftextoUsuario"
                class="form-control" placeholder="Usuario" value=""
                onchange="controlarFiltrosMenu('usuario', value)">
                <option value="0">-</option>
                <?php
                    foreach($usuarios as $key => $usuario){
                        echo '<option value="'.$usuario['id_Usuario'].'">'.$usuario['nombre'].'</option>';
                    };
                ?>
            </select>
        </div>
        <div style="display: flex;">
            <div class="form-group col-md-3 col-sm-3">
                <label for="">Rol:</label>
                <select type="text" id="ftextoRol" name="ftextoRol"
                    class="form-control" placeholder="Rol" value=""
                    onchange="controlarFiltrosMenu('rol', value)">
                    <option value="0">-</option>
                    <?php
                        foreach($roles as $key => $rol){
                            echo '<option value="'.$rol['id'].'">'.$rol['rol'].'</option>';
                        };
                    ?>
                </select>
            </div>

            
        </div>
        <!-- <div class="form-group col-md-6 col-sm-12">
            <label for="factivo">Estado:</label>
            <select id="factivo" name="factivo" class="form-control">
                <option value="">Todos</option>
                <option value="S">Activos</option>
                <option value="N">No activos</option>
            </select>
        </div> -->
    </form>

    <div id="campoGestionRoles" style="padding-top: 24px; display: flex;">
        <form id="formularioGestionarRol" name="formularioGestionarRol">
            <div class="form-group col-md-4 col-sm-4">
                <!-- <label for="">Nombre del rol:</label> -->
                <input type="text" id="rol" name="rol"
                class="form-control" placeholder="Texto a buscar" value="">
            </div>
        </form>
        
        <!-- <div>
            <button type="button" class="btn btn-outline-primary"
            onclick="guardarRol(0, 'editar')">Editar</button>
        </div>

        <div>
            <button type="button" class="btn btn-outline-primary"
            onclick="guardarRol(0, 'eliminar')">Eliminar</button>
        </div> -->

        <div>
            <button type="button" class="btn btn-outline-primary"
            onclick="guardarRol(0, 'crear')">Crear</button>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-outline-primary"
            onclick="guardarRol('Menu', 'getVistaListadoOpcionesMenu', 'formularioGestionarRol', 'capaResultadoBusqueda', '')">Buscar</button>
            <!-- <button type="button" class="btn btn-outline-secondary"
            onclick="obtenerVista_EditarCrear('Usuarios', 'getVistaNuevoEditar', 'capaEditarCrear', '')">Nuevo</button> -->
        </div>
    </div>
</div>
<div class="container-fluid" id="capaEditarCrear"></div>
<div class="container-fluid" id="capaResultadoBusqueda"></div>