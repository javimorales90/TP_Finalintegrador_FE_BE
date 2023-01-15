
/* ----- VINCULACION A API-----*/

fetch("https://apis.datos.gob.ar/georef/api/provincias")
 .then(function (res) {
    return res.json();
})
.then(function (datos){
    let inputSelect = document.querySelector("#provincia");

    datos.provincias.forEach((provincia) => {
        inputSelect.innerHTML += `<option value="${provincia.id}">${provincia.nombre}</option>`;
    });
})
.catch(function (err) {
    console.log(err);
})



