function guardarUsuario(){
    console.log('guardando');
    let opciones = { method: "GET", };
    let parametros = "controlador=Usuarios&metodo=guardarUsuario";
    parametros+='&'+new URLSearchParams(
                    new FormData(document.getElementById('formularioEdicion'))).toString();
    fetch("C_Frontal.php?" + parametros, opciones)
        .then(res=>{
            if(res.ok){
                return res.json();
            }
            throw new Error(res.status);
        })
        .then(resultado=>{
            console.log("llego")
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

// function editarUsuario(){
//     console.log('editando');
//     let opciones = { method: "GET", };
//     let parametros = "controlador=Usuarios&metodo=editarUsuario";
//     parametros+='&'+new URLSearchParams(
//                     new FormData(document.getElementById('formularioEdicion'))).toString();
//     fetch("C_Frontal.php?" + parametros, opciones)
//         .then(res=>{
//             if(res.ok){
//                 return res.json();
//             }
//             throw new Error(res.status);
//         })
//         .then(resultado=>{
//             if (resultado.correcto=='S') {
//                 document.getElementById('capaEditarCrear').innerHTML=resultado.msj;
//             } else {
//                 document.getElementById('msjError').innerHTML=resultado.msj;
//             }
//             // document.getElementById(destino).innerHTML = vista;
//         })
//         .catch(err=>{
//             console.log("Error al guardar", err.message);
//         })
// }

function cambiarEstadoUsuario($id_Usuario){
    console.log($id_Usuario);

    console.log('cambiando estado');
    let opciones = { method: "GET", };
    let parametros = "controlador=Usuarios&metodo=cambiarEstadoUsuario&id_Usuario="+$id_Usuario;
    // parametros+='&'+new URLSearchParams(
    //                 new FormData(document.getElementById('formularioEdicion'))).toString();
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

    if(document.getElementById("activoFila" + $id_Usuario).textContent === 'Inactivo'){
        document.getElementById("activoFila" + $id_Usuario).textContent = '';
        document.getElementById("nombreApellidoFila" + $id_Usuario).style = "";
    } else {
        document.getElementById("activoFila" + $id_Usuario).textContent = 'Inactivo';
        document.getElementById("nombreApellidoFila" + $id_Usuario).style = "color:red;";
    }

}