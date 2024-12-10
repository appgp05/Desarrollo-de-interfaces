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
                document.getElementById('tr0').outerHTML = '';
            }

            document.getElementById('newTr' + newTr).outerHTML = '';
            
            
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
    document.querySelector("#tr" + tr + " > .id").innerHTML = id;
}