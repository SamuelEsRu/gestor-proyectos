<?php
session_start();

$nombreservidor = "localhost";
$nombreusuario = "root";
$contrasena = "";
$nombredb = "gestorproyectos";

$conn = new mysqli($nombreservidor, $nombreusuario, $contrasena, $nombredb);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_SESSION['id'];

$sql = "SELECT imgperfil FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($imgperfil);
$stmt->fetch();

if ($imgperfil) {
    header("Content-type: image/png"); // Cambia esto si usas otro tipo de imagen (image/png, image/gif, etc.)
    echo $imgperfil;
} else {
    $rutaImagenDefecto = '../imgs/charles.png';
    header("Content-type: image/png");
    readfile($rutaImagenDefecto);
}

$stmt->close();
$conn->close();
?>