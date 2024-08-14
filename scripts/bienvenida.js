window.addEventListener("load", iniciar, false);

function iniciar(e){

    setInterval(generar, 1000);
 
}
function generar(e){
        
   
    function borrar(){
        cuadrado.remove()
        cuadrado2.remove()
    }
    let cuadrado = document.createElement("div");
    let cuadrado2 = document.createElement("div");

    cuadrado.classList.toggle("cuadrado")
    cuadrado2.classList.toggle("cuadrado")

    let x = Math.floor(Math.random() * (window.innerHeight - 200)); // Ajuste para mantener dentro de la ventana
    let y = Math.floor(Math.random() * (window.innerWidth - 200)); // Ajuste para mantener dentro de la ventana

    
    cuadrado.style.marginTop = (`${x}px`)
    cuadrado.style.marginLeft = (`${y}px`)

    cuadrado2.style.marginTop = (`${y}px`)
    cuadrado2.style.marginLeft = (`${x}px`)

    document.querySelector(".contenedorCuadrados").appendChild(cuadrado);
    document.querySelector(".contenedorCuadrados").appendChild(cuadrado2);

    cuadrado.addEventListener("animationend", borrar, false);
    cuadrado2.addEventListener("animationend", borrar, false);
}

