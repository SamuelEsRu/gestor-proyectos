window.addEventListener("load", iniciar, false);

let pw1;
let pw2;
let errores;
let botonEnviar;

function iniciar(){
    pw1 = document.getElementById("contrasena");
    pw2 = document.getElementById("confirmarContrasena");
    errores = document.querySelectorAll(".error.inv");
    botonEnviar = document.getElementById("confirmar");

    pw1.addEventListener("input", comprobar, false);
    pw2.addEventListener("input", comprobar, false);
    
}

function comprobar(){

   

    if(pw1.value != pw2.value){
        
        botonEnviar.disabled = true;
        for (let index = 0; index < errores.length; index++) {
            errores[index].classList.remove("inv")
            
        }
        console.log("son diferentes")
    }else{

        botonEnviar.disabled = false;
        for (let index = 0; index < errores.length; index++) {
            errores[index].classList.add("inv")
            
        }
        console.log("son iguales")
    }


    
}