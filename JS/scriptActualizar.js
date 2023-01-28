

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


