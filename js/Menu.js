function añadirFila(id, originalTrId){
    if(document.getElementById("newTr" + id) !== null && document.getElementById("newTr" + id) !== ''){
        document.getElementById("newTr" + id).outerHTML = '';
    }

    console.log("llego " + id + " " + originalTrId);
    const tablaMenu = document.getElementById("tablaMenu");
    const originalTr = document.getElementById('tr' + originalTrId);

    const newTr = document.createElement("tr");

    if(id==0){
        newTr.id = "tr" + id;
    } else {
        newTr.id = "newTr" + id;
    }

    if(id==0){

        newTr.innerHTML = `
        <td class="id">'.$fila['id'].'</td>
        <td class="titulo">'.$fila['titulo'].'</td>
        <td class="url">'.$fila['url'].'</td>
        <td class="nivel">'.$fila['nivel'].'</td>
        <td class="padre_id">'.$fila['padre_id'].'</td>
        <td class="orden">'.$fila['orden'].'</td>
        <td class="es_dropdown">'.$fila['es_dropdown'].'</td>
        <td class="controladorMenu">'.$fila['controladorMenu'].'</td>
        <td class="metodoMenu">'.$fila['metodoMenu'].'</td>
        <td class="destinoMenu">'.$fila['destinoMenu'].'</td>
        `;
    }

    tablaMenu.insertBefore(newTr, originalTr.nextSibling);
}

function añadirFilaPermisos(id, originalTrId){
    // if(document.getElementById("newPermissionTr" + id) !== null && document.getElementById("newPermissionTr" + id) !== ''){
    //     document.getElementById("newPermissionTr" + id).outerHTML = '';
    // }

    console.log("llego " + id + " " + originalTrId);
    const tablaMenu = document.getElementById("tablaMenu");
    const originalTr = document.getElementById('tr' + originalTrId);

    const newTr = document.createElement("tr");

    newTr.id = "permissionTr" + id;
    newTr.innerHTML = `<td><input type="text" placeholder="Permiso"><input type="text" placeholder="Código permiso"><button>Añadir permiso</button></td>`;

    tablaMenu.insertBefore(newTr, originalTr.nextSibling);
}

function obtenerVista_EditarCrearMenu(controlador, metodo, destino, id, nivel, padre_id, orden){
    // console.log("llegooo");
    let opciones = { method: "GET", };
    let parametros = "controlador=" + controlador + "&metodo=" + metodo+"&id="+id + "&nivel=" + nivel + "&padre_id=" + padre_id + "&orden=" + orden;
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.text();
            }
            throw new Error(res.status);
        })
        .then(vista=>{
            document.getElementById(destino).innerHTML = vista;
        })
        .catch(err=>{
            console.error("Error al pedir vista", err.message);
        })
}

function obtenerVista_EditarCrearMenuFila(controlador, metodo, destino, id, nivel, padre_id, orden, newTr){
    // console.log("llegooo");
    // console.log("ID: " + id);
    let opciones = { method: "GET", };
    let parametros = "controlador=" + controlador + "&metodo=" + metodo+"&id="+id + "&nivel=" + nivel + "&padre_id=" + padre_id + "&orden=" + orden + "&newTr=" + newTr;
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.text();
            }
            throw new Error(res.status);
        })
        .then(vista=>{
            document.getElementById(destino).innerHTML = vista;
        })
        .catch(err=>{
            console.error("Error al pedir vista", err.message);
        })
}

// function obtenerVista_EditarCrearMenu(controlador, metodo, destino, id, hijo, orden){
//     // console.log("llegooo");
//     let opciones = { method: "GET", };
//     let parametros = "controlador=" + controlador + "&metodo=" + metodo+"&id="+id + "&hijo=" + hijo + "&orden=" + orden;
//     fetch("C_Frontal.php?" + parametros, opciones)
//         .then(res=>{
//             if(res.ok){
//                 return res.text();
//             }
//             throw new Error(res.status);
//         })
//         .then(vista=>{
//             document.getElementById(destino).innerHTML = vista;
//         })
//         .catch(err=>{
//             console.error("Error al pedir vista", err.message);
//         })
// }

function guardarOpcionMenu(){
    console.log('guardando');
    let opciones = { method: "GET", };
    let parametros = "controlador=Menu&metodo=guardarOpcionMenu";
    parametros+='&'+new URLSearchParams(
                    new FormData(document.getElementById('formularioEdicion'))).toString();
                    console.log("FormData: " + new URLSearchParams(
                        new FormData(document.getElementById('formularioEdicion'))).toString());
    console.log("Parametros: " + parametros);
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.json();
            }
            throw new Error(res.status);
        })
        .then(resultado=>{
            if (resultado.correcto=='S') {
                document.getElementById('capaEditarCrear').innerHTML=resultado.msj;
            } else {
                document.getElementById('msjError').innerHTML=resultado.msj;
            }
            // document.getElementById(destino).innerHTML = vista;
        })
        .catch(err=>{
            console.log("Error al guardar", err.message);
        })
}

function guardarOpcionMenuFila(newTr){
    console.log('guardando');
    let opciones = { method: "GET", };
    let parametros = "controlador=Menu&metodo=guardarOpcionMenuFila";
    const formularios = document.querySelectorAll('#newTr' + newTr + ' .formularioEdicion');
    formularios.forEach(formulario => {
        parametros+='&'+new URLSearchParams(
            new FormData(formulario)).toString();
            console.log("FormData: " + new URLSearchParams(
                new FormData(formulario)).toString());
    });
    // parametros = decodeURIComponent(parametros);
    console.log("Parametros: " + parametros);
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.json();
            }
            throw new Error(res.status);
        })
        .then(resultado=>{
            // if (resultado.correcto=='S') {
            //     document.getElementById('capaEditarCrear').innerHTML=resultado.msj;
            // } else {
            //     document.getElementById('msjError').innerHTML=resultado.msj;
            // }
            // document.getElementById(destino).innerHTML = vista;

            var editar = false;

            if(document.querySelector('#newTr' + newTr + ' .formularioEdicion > #id')){
                console.log("editarA")
                editar = true;
                const id = document.querySelector('#newTr' + newTr + ' .formularioEdicion > #id');
            } else {
                console.log("crearA")
                editar = false;
            }

            if(editar){
                actualizarOpcionMenuFila(newTr, newTr);
            } else {
                // añadirFila(0, newTr);

                let id = 0;
                let originalTrId = newTr;

                if(document.getElementById("newTr" + id) !== null && document.getElementById("newTr" + id) !== ''){
                    document.getElementById("newTr" + id).outerHTML = '';
                }
            
                console.log("llego " + id + " " + originalTrId);
                const tablaMenu = document.getElementById("tablaMenu");
                const originalTr = document.getElementById('tr' + originalTrId);
            
                const newTrr = document.createElement("tr");
            
                if(id==0){
                    newTrr.id = "tr" + id;
                } else {
                    newTrr.id = "newTr" + id;
                }
            
                if(id==0){
            
                    newTrr.innerHTML = `
                    <td class="id">'.$fila['id'].'</td>
                    <td class="titulo">'.$fila['titulo'].'</td>
                    <td class="url">'.$fila['url'].'</td>
                    <td class="nivel">'.$fila['nivel'].'</td>
                    <td class="padre_id">'.$fila['padre_id'].'</td>
                    <td class="orden">'.$fila['orden'].'</td>
                    <td class="es_dropdown">'.$fila['es_dropdown'].'</td>
                    <td class="controladorMenu">'.$fila['controladorMenu'].'</td>
                    <td class="metodoMenu">'.$fila['metodoMenu'].'</td>
                    <td class="destinoMenu">'.$fila['destinoMenu'].'</td>
                    `;
                }
            
                tablaMenu.insertBefore(newTrr, originalTr.nextSibling);

                console.log(0, newTr);
                actualizarOpcionMenuFila(0, newTr);
                actualizarIdFila(resultado, 0);
                // document.getElementById('tr0').outerHTML = '';
            }

            document.getElementById('newTr' + newTr).outerHTML = '';
            
            
        })
        .catch(err=>{
            console.log("Error al guardar", err.message);
        })
}

function guardarPermisoOpcionMenuFila(newPermisoTr, accion){
    console.log('guardando');
    let opciones = { method: "GET", };
    let parametros = "controlador=Menu&metodo=guardarPermisoOpcionMenuFila&accion=" + accion;
    
    if(accion !== 'eliminar'){
        const formularios = document.querySelectorAll('#permissionTr' + newPermisoTr + ' .formularioEdicion');
        formularios.forEach(formulario => {
            parametros+='&'+new URLSearchParams(
                new FormData(formulario)).toString();
                // console.log("FormData: " + new URLSearchParams(
                //     new FormData(formulario)).toString());
            console.log(parametros);
        });
    } else {
        parametros += '&id=' + newPermisoTr;
    }
    console.log("Parametros: " + parametros);
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.json();
            }
            throw new Error(res.status);
        })
        .then(resultado=>{

            // var editar = false;

            // if(document.querySelector('#newTr' + newTr + ' .formularioEdicion > #id')){
            //     console.log("editarA")
            //     editar = true;
            //     const id = document.querySelector('#newTr' + newTr + ' .formularioEdicion > #id');
            // } else {
            //     console.log("crearA")
            //     editar = false;
            // }

            // if(editar){
            //     actualizarOpcionMenuFila(newTr, newTr);
            // } else {
            //     // añadirFila(0, newTr);

            //     let id = 0;
            //     let originalTrId = newTr;

            //     if(document.getElementById("newTr" + id) !== null && document.getElementById("newTr" + id) !== ''){
            //         document.getElementById("newTr" + id).outerHTML = '';
            //     }
            
            //     console.log("llego " + id + " " + originalTrId);
            //     const tablaMenu = document.getElementById("tablaMenu");
            //     const originalTr = document.getElementById('tr' + originalTrId);
            
            //     const newTrr = document.createElement("tr");
            
            //     if(id==0){
            //         newTrr.id = "tr" + id;
            //     } else {
            //         newTrr.id = "newTr" + id;
            //     }
            
            //     if(id==0){
            
            //         newTrr.innerHTML = `
            //         <td class="id">'.$fila['id'].'</td>
            //         <td class="titulo">'.$fila['titulo'].'</td>
            //         <td class="url">'.$fila['url'].'</td>
            //         <td class="nivel">'.$fila['nivel'].'</td>
            //         <td class="padre_id">'.$fila['padre_id'].'</td>
            //         <td class="orden">'.$fila['orden'].'</td>
            //         <td class="es_dropdown">'.$fila['es_dropdown'].'</td>
            //         <td class="controladorMenu">'.$fila['controladorMenu'].'</td>
            //         <td class="metodoMenu">'.$fila['metodoMenu'].'</td>
            //         <td class="destinoMenu">'.$fila['destinoMenu'].'</td>
            //         `;
            //     }
            
            //     tablaMenu.insertBefore(newTrr, originalTr.nextSibling);

            //     console.log(0, newTr);
            //     actualizarOpcionMenuFila(0, newTr);
            //     actualizarIdFila(resultado, 0);
            //     // document.getElementById('tr0').outerHTML = '';
            // }

            // document.getElementById('newTr' + newTr).outerHTML = '';
            
            
        })
        .catch(err=>{
            console.log("Error al guardar", err.message);
        })
}

function actualizarOpcionMenuFila(tr, newTr){
    // parametros = '';
    // const formularios = document.querySelectorAll('#newTr' + tr + ' .formularioEdicion');
    // formularios.forEach(formulario => {
    //     parametros+=''+new URLSearchParams(
    //         new FormData(formulario)).toString();
    // });


    // document.querySelector("#tr" + tr + " > .id").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formId").value;
    document.querySelector("#tr" + tr + " > .titulo").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formTitulo").value;
    document.querySelector("#tr" + tr + " > .url").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formUrl").value;
    document.querySelector("#tr" + tr + " > .nivel").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formNivel").value;
    document.querySelector("#tr" + tr + " > .padre_id").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formPadre_id").value;
    document.querySelector("#tr" + tr + " > .orden").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formOrden").value;
    document.querySelector("#tr" + tr + " > .es_dropdown").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formEs_dropdown").value;
    document.querySelector("#tr" + tr + " > .controladorMenu").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formControladorMenu").value;
    document.querySelector("#tr" + tr + " > .metodoMenu").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formMetodoMenu").value;
    document.querySelector("#tr" + tr + " > .destinoMenu").innerHTML = document.querySelector("#newTr" + newTr + " > td > form > .formDestinoMenu").value;
}

function actualizarIdFila(id, tr){
    console.log("Tr a actualizar: " + tr + ", Nuevo id: " + id);
    document.querySelector("#tr" + tr + " > .id").innerHTML = id;
    document.querySelector("#tr" + tr).id = "tr" + id;
}

function mostrarPermisosOpcionesMenuFila(){
    console.log("llego");
    const opcionesMenu = document.querySelectorAll('#tablaMenu > tr');
    opcionesMenu.forEach(opcionMenu => {
        console.log("Opcion: " + opcionMenu.id)
        const id = opcionMenu.id.substring(2);
        console.log("id: " + id);
        añadirFilaPermisos(id, id)
    });
}

<<<<<<< Updated upstream
function actualizarPermisosOpcionMenuFila(){
    
}
=======
function controlarFiltrosMenu(filtro, valor){
    // const campoGestionRoles = document.getElementById("campoGestionRoles");
    // campoGestionRoles.innerHTML = `
    //     <form id="formularioGestionarRol" name="formularioGestionarRol">
    //         <div class="form-group col-md-4 col-sm-4">
    //             <!-- <label for="">Nombre del rol:</label> -->
    //             <input type="text" id="rol" name="rol"
    //             class="form-control" placeholder="Texto a buscar" value="">
    //         </div>
    //     </form>
        
    //     <div>
    //         <button type="button" class="btn btn-outline-primary"
    //         onclick="guardarRol(${valor}, 'editar')">Editar</button>
    //     </div>

    //     <div>
    //         <button type="button" class="btn btn-outline-primary"
    //         onclick="guardarRol(${valor}, 'eliminar')">Eliminar</button>
    //     </div>

    //     <div>
    //         <button type="button" class="btn btn-outline-primary"
    //         onclick="guardarRol(${valor}, 'crear')">Crear</button>
    //     </div>
    // `;

    console.log("llego", filtro, valor);
    if(filtro === 'usuario'){
        if(valor == 0){
            document.getElementById('ftextoRol').disabled=false;
        } else {
            document.getElementById('ftextoRol').disabled=true;
        }
    } else if(filtro === 'rol') {
        if(valor == 0){
            const campoGestionRoles = document.getElementById("campoGestionRoles");
            campoGestionRoles.innerHTML = `
            <form id="formularioGestionarRol" name="formularioGestionarRol">
                <div class="form-group col-md-4 col-sm-4">
                    <!-- <label for="">Nombre del rol:</label> -->
                    <input type="text" id="rol" name="rol"
                    class="form-control" placeholder="Texto a buscar" value="">
                </div>
            </form>

            <div>
                <button type="button" class="btn btn-outline-primary"
                onclick="guardarRol(${valor}, 'crear')">Crear</button>
            </div>
            `;

            document.getElementById('ftextoUsuario').disabled=false;
        } else {
            const campoGestionRoles = document.getElementById("campoGestionRoles");
            campoGestionRoles.innerHTML = `
            <form id="formularioGestionarRol" name="formularioGestionarRol">
                <div class="form-group col-md-4 col-sm-4">
                    <!-- <label for="">Nombre del rol:</label> -->
                    <input type="text" id="rol" name="rol"
                    class="form-control" placeholder="Texto a buscar" value="">
                </div>
            </form>
            
            <div>
                <button type="button" class="btn btn-outline-primary"
                onclick="guardarRol(${valor}, 'editar')">Editar</button>
            </div>

            <div>
                <button type="button" class="btn btn-outline-primary"
                onclick="guardarRol(${valor}, 'eliminar')">Eliminar</button>
            </div>
            `;



            // var select = document.getElementById('ftextoRol');
            // var selectedText = select.options[select.selectedIndex].text;

            document.getElementById('rol').value = document.getElementById('ftextoRol').options[document.getElementById('ftextoRol').selectedIndex].text;
            document.getElementById('ftextoUsuario').disabled=true;
        }

        fetch("C_Frontal.php?controlador=Menu&metodo=getRoles?id="+document.getElementById("ftextoUsuario").value)
            .then((response) => response.json())
            .then((roles) => {
            Array.from(document.getElementById("ftextoRol").options).forEach((option) => {
                if (roles.includes(option.text)) {
                    option.classList.add("assigned-role")
                } else {
                    option.classList.remove("assigned-role")
                }
            });
            })
            .catch((error) => {
            })
    }
}

function actualizarUsuarioORolPorPermiso(usuarioORol, usuarioORolId, permiso){
    console.log("Acción: " + usuarioORol + ", Permiso: " + permiso);

    let opciones = { method: "GET", };
    let parametros = "controlador=Menu&metodo=actualizarUsuarioORolPorPermiso&usuarioORol="+usuarioORol+"&usuarioORolId="+usuarioORolId+"&permiso="+permiso;

    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.json();
            }
            throw new Error(res.status);
        })
}

function guardarRol(id, accion){
    let opciones = { method: "GET", };
    let parametros = "controlador=Menu&metodo=guardarRol&id="+id+"&accion="+accion;
    parametros+='&'+new URLSearchParams(
                    new FormData(document.getElementById('formularioGestionarRol'))).toString();
                    console.log("FormData: " + new URLSearchParams(
                        new FormData(document.getElementById('formularioGestionarRol'))).toString());
    console.log("Parametros: " + parametros);
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
                fetch("C_Frontal.php?controlador=Menu&metodo=getRoles")
                  .then((response) => response.json())
                  .then((roles) => {
                    const roleSelect = document.getElementById("ftextoRol")
                    roleSelect.innerHTML = '<option value="0">-</option>'
                    roles.forEach((role) => {
                      const option = document.createElement("option")
                      option.value = role.id
                      option.textContent = role.rol
                      roleSelect.appendChild(option)
                    })

                    controlarFiltrosMenu('rol', 0);
                  })
                  .catch((error) => {
                    console.error("Error updating role select:", error)
                  })


            if(res.ok){
                return res.json();
            }
            throw new Error(res.status);
        })
        .catch(err=>{
            console.log("Error al guardar", err.message);
        })
}

>>>>>>> Stashed changes
