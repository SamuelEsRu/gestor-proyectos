'use strict'
// function comprobarValidacion(event){
//     const nombre = document.getElementById("nombre")
//     const fecha = document.getElementById("fecha")
//     const precio = document.getElementById("precio")
     // el valor de la imagen se recoge con .files, es el array de las imagenes
//     const imagen = document.getElementById("imagen").files[0]
//     console.log("hola")
//     if(!nombre.checkValidity()){
//         console.log("holaif")
//         nombre.setCustomValidity("Introduce un nombre, este campo no puede estar vacío")
//     }else{
//         console.log("holaelse")
//        creaObra(event) 
//     }
    
// }
function creaObra(event){

    // Le introduzco un event que es el que manejará cuando hagas submit
    //esta linea previenen el comportamiento por defecto de los formularios, para que no recargue la página
    event.preventDefault()
    
    const nombre = document.getElementById("nombre").value
    const fecha = document.getElementById("fecha").value
    const descripcion = document.getElementById("descripcion").value
    const precio = document.getElementById("precio").value
    // el valor de la imagen se recoge con .files, es el array de las imagenes
    const imagen = document.getElementById("imagen").files[0]

    //Contenedor de las obras
    let contenedorTrabajadores = document.getElementById("trabajadores")

    //trabajador
    const divObra = document.createElement("a")
    divObra.classList.add("trabajador")
    divObra.href  = "#"

    //contenido
    const divContenido = document.createElement("div")
    divContenido.classList.add("contenido")

    //imagen
    const divImagen = document.createElement("div")
    divImagen.classList.add("imagen")

    //info
    const divInfo = document.createElement("div")
    divInfo.classList.add("info")

    //datosObra
    const divDatosObra = document.createElement("div")
    divDatosObra.classList.add("datosObra")

    //!crear el elemento img con src: -> la ruta por defecto sale oculta, por lo tanto para que salga hace falta transformarla a base64
    //imagen
    const imgObra = document.createElement("img")

    // una vez que tenemos el array de imágenes leidas con .file (en este caso estoy obteniendo por defecto la primera),
    // creo un fileReader para poder leer las propiedades de la imagen con el readAsDataURL(imagen)
    // cuando ha terminado (onloadend) ejecuto la función anónima que asocia el path correspondiente leido con el fileReader,
    // event.target.result obtiene la url de la imagen


    if(imagen.type.startsWith("image")){

        let reader = new FileReader()
        reader.readAsDataURL(imagen)
        reader.onloadend = function(event){
            imgObra.src = event.target.result;
        }
    } 

    //nombre obra
    const nombreObra =  document.createElement("h3");
    nombreObra.innerText = nombre;
    

    //descripción de la obra
    const descripcionObra =  document.createElement("p");
    descripcionObra.innerText = descripcion;

    //fecha de la obra
    const fechaObra =  document.createElement("p");
    fechaObra.innerText = fecha;

    //precio
    const precioObra =  document.createElement("p");
    precioObra.innerText = precio + " euros";

    //!Al empezar a organizar hay que hacerlo en orden
   

    divInfo.appendChild(imgObra)
    divInfo.appendChild(nombreObra)
    divInfo.appendChild(descripcionObra)

    divDatosObra.appendChild(fechaObra)
    divDatosObra.appendChild(precioObra)

    divObra.append(divInfo, divDatosObra)
    contenedorTrabajadores.append(divObra)

    alert("creado con exito")
    
}

//reset

function resetear(){
    const imagen = document.getElementById("outputImagen");
    imagen.src = "";
    imagen.style.width = "0";
    imagen.style.height = "0"
    imagen.style.margin = "0"; // Centra horizontalmente
    
    document.getElementById("formulario").reset();
}

//reset imagen
    

// previsualización
let loadFile = function(event) {

    let reader = new FileReader();
    let previsualizarImagen = document.getElementById("previsualizarImagen")
    reader.onload = function(){

        let output = document.getElementById('outputImagen');
        output.src = reader.result;
        output.style.width = "auto";
        output.style.height = "350px"
        output.style.margin = "10px auto"; // Centra horizontalmente
        output.style.display = "block"; // Asegura que la imagen se muestre como un bloque
    };

    reader.readAsDataURL(event.target.files[0]);

    
    // previsualizarImagen.style.width ="400px";
    // previsualizarImagen.style.height ="400px";
   

}

