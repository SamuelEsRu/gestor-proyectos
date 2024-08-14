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

//obtener el nombre de usuario de formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){


    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $usuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];
    $codAdmin = $_POST["codAdmin"];
    $proy = $_POST["proy"];

    if (strlen($telefono) !== 9 || !ctype_digit($telefono)) {
        header("Location: formularioRegistro.php?error=invalid_phone");
        exit();
    }
    //? para una cantidad elevada de archivos hacerlo con rutas al almacenamiento
    
    if (!empty($_FILES['imgPerfil']['tmp_name'])) {

        $imagen = $_FILES['imgPerfil']['tmp_name'];
        $imagenContenido = addslashes(file_get_contents($imagen));
    } else {
        $rutaImagenDefecto = 'imgs/charles.png';
        $imagenContenido = addslashes(file_get_contents($rutaImagenDefecto));
    }


    
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt =  $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        //existe
        header("Location: formularioRegistro.php?error=email_exists");

    }else{
        $sql_insert = "INSERT INTO usuarios(nombre, email, telefono, usuario, contrasena, codigocoordinador, imgperfil, id_proyecto) VALUES ('$nombre','$email','$telefono','$usuario','$contrasena','$codAdmin','$imagenContenido', '$proy')"; 

                        if($conn->query($sql_insert) === TRUE){
                            echo "usuario registrado";
                            echo "<br><a href='ingresar.php'>Ir a la pag de inicio<a/>";

                        } else{
                            echo "Error al registrar usuario: " . $conexion -> error;
                        }

    }
    $stmt->close();
    $conn->close();

}

?>