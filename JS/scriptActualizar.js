

/* ----- VINCULACION A API PARA ACTUALIZAR Y TRAER PROVINCIA-----*/

fetch("https://apis.datos.gob.ar/georef/api/provincias")
    .then(function (res) {
    return res.json();
})
    .then(function (datos){
    let inputSelect = document.querySelector("#provincia");

    datos.provincias.forEach((provincia) => {
        if (Provincia == provincia.id){
            inputSelect.innerHTML += `<option value="${provincia.id}" selected>${provincia.nombre}</option>`;
        } else {
            inputSelect.innerHTML += `<option value="${provincia.id}">${provincia.nombre}</option>`;
        }
        
    });
})
.catch(function (err) {
    console.log(err);
})




/* ----- TRAER SELECTS A ACTUALIZAR.PHP -----*/

// function datosEspecies (){
//     let inputSelectespecie = document.querySelector("#especie");

//     datosEspecies.especies.forEach((especie) => {
//         if (Especie == $mascota ['especie']){
//             inputSelectespecie.innerHTML += `<option value="${$mascota ['especie']}" selected>${$mascota ['especie']}</option>`;
//         } else {
//             inputSelectespecie.innerHTML += `<option value="${$mascota ['especie']}">${$mascota ['especie']}</option>`;
//         }
//     })
//     .catch(function (err) {
//         console.log(err);
//         });
// };


/* A PRUEBA

// function ShowSelected()
// {
// /* Para obtener el valor */
// var cod = document.getElementById("especie").value;

// /* Para obtener el texto */
// var combo = document.getElementById("especie");
// var selected = combo.options[combo.selectedIndex].text;

// document.getElementById("especie").value = selected;

// document.getElementById("especie").innerHTML = selected;
// }
