

if (localStorage.getItem('modo')==="oscuro"){
    var cuerpoweb = document.querySelector("body"); 
    cuerpoweb.classList.add("oscuro"); 
}
function cambiarModo() { 
    var cuerpoweb = document.querySelector("body"); 
    cuerpoweb.classList.toggle("oscuro"); 
    if(cuerpoweb.classList.contains("oscuro")){
        localStorage.setItem('modo', "oscuro");
    } else {
        localStorage.setItem('modo', "claro");
    }
}

