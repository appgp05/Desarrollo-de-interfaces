<?php
    $usuarios = [];
    $roles = [];
    extract($datos);
?>

<h2>Mtto. de Menu</h2>
<div class="container-fluid" id="capaFiltrosBusqueda">
    <form id="formularioBuscar" name="formularioBuscar">
        <div class="form-group col-md-6 col-sm-12">
            <label for="">Nombre/texto:</label>
            <input type="text" id="ftexto" name="ftexto"
                class="form-control" placeholder="Texto a buscar" value="">
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for="">Usuario:</label>
            <select type="text" id="ftextoUsuario" name="ftextoUsuario"
                class="form-control" placeholder="Usuario" value="">
                <option value="0">-</option>
                <?php
                    foreach($usuarios as $key => $usuario){
                        echo '<option>'.$usuario['nombre'].'</option>';
                    };
                ?>
            </select>
        </div>
        <div class="form-group col-md-6 col-sm-12">
            <label for="">Rol:</label>
            <select type="text" id="ftextoRol" name="ftextoRol"
                class="form-control" placeholder="Rol" value="">
                <option value="0">-</option>
                <?php
                    foreach($roles as $key => $rol){
                        echo '<option>'.$rol['rol'].'</option>';
                    };
                ?>
            </select>
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
    <div class="row">
        <div class="col-lg-12">
            <button type="button" class="btn btn-outline-primary"
            onclick="buscar('Menu', 'getVistaListadoOpcionesMenu', 'formularioBuscar', 'capaResultadoBusqueda', '')">Buscar</button>
            <!-- <button type="button" class="btn btn-outline-secondary"
            onclick="obtenerVista_EditarCrear('Usuarios', 'getVistaNuevoEditar', 'capaEditarCrear', '')">Nuevo</button> -->
        </div>
    </div>
</div>
<div class="container-fluid" id="capaEditarCrear"></div>
<div class="container-fluid" id="capaResultadoBusqueda"></div>