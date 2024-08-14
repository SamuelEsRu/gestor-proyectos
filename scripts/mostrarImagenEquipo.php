<?php
$nombreservidor = "localhost";
$nombreusuario = "root";
$contrasena = "";
$nombredb = "gestorproyectos";

$conn = new mysqli($nombreservidor, $nombreusuario, $contrasena, $nombredb);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql = "SELECT imgperfil FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($imgperfil);
    $stmt->fetch();
    
    if ($imgperfil) {
        header("Content-type: image/png"); // Cambiar esto si es otro tipo de imagen (image/jpeg, image/gif, etc.)
        echo $imgperfil;
    } else {
        $rutaImagenDefecto = '../imgs/charles.png';
        header("Content-type: image/png");
        readfile($rutaImagenDefecto);
    }
    
    $stmt->close();
} else {
    echo "ID de usuario inválido.";
}

$conn->close();
?>
