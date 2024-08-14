<?php 
include('conexion.php');
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $id = $_POST['id_usuario'];

    $nombre = $_POST["nombre"];
    $email = $_POST["email"];
    $telefono = $_POST["telefono"];
    $usuario = $_POST["nombreUsuario"];
    $contrasena = $_POST["contrasena"];
    $proy = $_POST["proy"];
    $imagen = $_FILES['imgPerfil']['tmp_name'];
    // $imagenContenido = addslashes(file_get_contents($imagen));
    

    

    $query = "UPDATE usuarios SET nombre = '$nombre', email = '$email', telefono = '$telefono', usuario = '$usuario', contrasena = '$contrasena', id_proyecto = '$proy'";    

    if (!empty($imagen)) {
        $imagenContenido = addslashes(file_get_contents($imagen));
        $query .= ", imgperfil = '$imagenContenido'";
    }

    $query .= " WHERE id= $id";
    $query_run = mysqli_query($conn, $query);


    if($query_run){
        $_SESSION['mensaje'] = "Actualizado Correctamente";
        header("Location: ../vistaUsuario.php ");
    }else{
        $_SESSION['mensaje'] = "Error al actualizar";
        header("Location: ../modificarUsuario.php");
    }
}
?>