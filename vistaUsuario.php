<?php 
session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: ingresar.php");
    exit();
}
$id = $_SESSION['id'];

// echo "esta es la id del usuario que entra: " . $id;

$nombreservidor = "localhost";
$nombreusuario="root";
$contrasena = "";
$nombredb = "gestorproyectos";

$conn = new mysqli($nombreservidor, $nombreusuario, $contrasena, $nombredb);

if($conn->connect_error){
    die("Conexión fallida" . $conn->connect_error);
}


$sql = "SELECT nombre, email, telefono, usuario, imgperfil, id_proyecto FROM usuarios WHERE id = $id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($nombre, $email, $telefono, $usuario, $imgperfil, $idProyecto);
$stmt->fetch();
$stmt->close();

//sql del proyecto

$sql_proyecto = "SELECT * FROM proyectos WHERE id = $idProyecto";
$stmt_proyecto = $conn->prepare($sql_proyecto);
$stmt_proyecto->execute();
$stmt_proyecto->store_result();
$stmt_proyecto->bind_result($id_proy, $nombre_proy, $descripcion_proy, $fecha_proy);
$stmt_proyecto->fetch();
$stmt_proyecto->close();

//sql del los compañeros de equipo
$sql_team = "SELECT id , nombre, imgperfil, codigocoordinador FROM usuarios WHERE id_proyecto = $id_proy ORDER BY codigocoordinador DESC";
$stmt_team = $conn->prepare($sql_team);
$stmt_team->execute();
$stmt_team->store_result();
$stmt_team->bind_result($id_equipo, $nombre_equipo, $img_equipo, $codcoordinador);

include './common/header.php';

?>

<link rel="stylesheet" href="styles/stylesUsuario.css">

<?php
    if (isset($_SESSION['mensaje'])) {
        echo '<div class="mensajeOK">' . $_SESSION["mensaje"] . '</div>';
        unset($_SESSION['mensaje']);
    }
?>
    
    <main>


        <div id="usuario">
            <div class="ficha">
                <h2>Ficha del usuario: <?php echo $nombre ?></h2>
                <a href="modificarUsuario.php?id=<?php echo $id ?>">Modificar datos &#x270E;</a>
            </div>

            <div class="contenedorTrabajador">
                
                <div class="contenedorImagenPerfil">
                    <img src="scripts/mostrarImagen.php">  
                </div>

                
                <div class="datosTrabajador">
                    <div class="">
                        <h3>Datos</h3>
                        <h4>Número de empleado: <?php echo $id?></h4>
                        <h4>Turno: Mañana</h4>  
                        <h4>Proyecto al que pertenece: <?php echo $nombre_proy?></h4>

                        
                        <div class="compProy">
                    
                            <p>Compañeros de proyecto:</p>
                            <ul>
                            <?php 
                                while ($stmt_team->fetch()) {
                                    if ($id_equipo != $_SESSION['id']){
                                        // Dependiendo del tipo de usario tendra un estilo u otro
                                        $clase = ($codcoordinador != '') ? 'comp coord' : 'comp';
                                        echo '
                                            <li class="' . $clase . '">
                                                <a href="#">
                                                    <img src="scripts/mostrarImagenEquipo.php?id='. $id_equipo .'" alt="Imagen de '. $nombre_equipo .'">
                                                    <p> ' . $nombre_equipo . '  </p>
                                                </a>
                                            </li>
                                        '; 
                                    }
                                }
                                $stmt_team->close();
                            ?>


                            </ul> 
                        </div>
                    </div>
                    <div>
                        <h3>Contacto</h3>
                        <h4 class="telefono">Teléfono: <?php echo $telefono?></h4>
                        <h4 class="email">Email:  <a href="mailto:<?php echo $email ?>"><?php echo $email?></a></h4>

                       
                    </div>

                </div>

            </div>

           


          


        </div>

        <div class="infoProyecto">
            <h2>Proyecto: <?php echo $nombre_proy?></h2>
            <h3>Fecha de comienzo: <?php echo $fecha_proy?></h3>
            <p><?php echo $descripcion_proy?></p><br>
            <div class="novedadesProyecto">

                <div class="nov novedadBaja">
                    <p><b>Nombre usuario:</b></p>
                    <p>He añadido texto explicativo para los usuarios en la sección "más información"</p>
                </div>
                <div class="nov novedadMedia">
                    <p><b>Nombre usuario:</b></p>
                    <p>He añadido texto explicativo para los usuarios en la sección "más información"</p>
                </div>
                <div class="nov novedadUrgente">
                    <p><b>Nombre usuario:</b></p>
                    <p>He añadido texto explicativo para los usuarios en la sección "más información"</p>
                </div>

            </div>


        </div>
            
            
        

    </main>
    <?php 
    
    include './common/footer.php';
    ?>
    
    <script>
        // Código JavaScript
        document.addEventListener('DOMContentLoaded', (event) => {
            console.log('Hola desde JavaScript');
            
        });
    </script>                         
</body>
</html>