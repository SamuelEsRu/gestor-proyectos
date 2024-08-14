<?php 

session_start();


$nombreservidor = "localhost";
$nombreusuario="root";
$contrasena = "";
$nombredb = "gestorproyectos";


//conexión

$conn = new mysqli($nombreservidor, $nombreusuario, $contrasena, $nombredb);

if($conn->connect_error){
    die("Conexión fallida" . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["pwUsuario"];


    //ver si existe

    $sql = "SELECT id, codigocoordinador FROM usuarios WHERE usuario = ? AND contrasena = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $usuario, $contrasena);
    $stmt->execute();
    $stmt->store_result();
    // $result = $stmt->get_result();

    if($stmt->num_rows ==1){

        //se guarda el usuario del usuario en la sesion
        $_SESSION['usuario'] = $usuario;


        $stmt->bind_result($id,$codCoordinador);
        //fetch de la consulta, hace la consulta recuperando la 
        //id y codigocoordinador y los bindea en ese orden a las 
        //variables $id, $codCoordinador
        $stmt->fetch();

        $_SESSION['codigocoordinador'] = $codCoordinador;
        $_SESSION['id'] = $id;
        
            if(empty($codCoordinador)){
                header("Location: vistaUsuario.php ");
        } else {
            header("Location: vistaCoordinador.php");
        }

    
        
    } else {
        echo "Usuario o contraseña incorrectos, intentalo de nuevo";
        echo "<br><a href='ingresar.php'> volver a formulario</a>";
    }

}

$conn->close();
?>