<?php 

session_start();
if(!isset($_SESSION['usuario'])){
    header("Location: ingresar.php");
    exit();
}
$nombreservidor = "localhost";
$nombreusuario="root";
$contrasena = "";
$nombredb = "gestorproyectos";

$conn = new mysqli($nombreservidor, $nombreusuario, $contrasena, $nombredb);

if($conn->connect_error){
    die("Conexión fallida" . $conn->connect_error);
}
include './common/header.php';

?>
    <link rel="stylesheet" href="styles/styles.css">


    <main>

        <div id="proyectos">
            
            <div class="leyenda">
                <div class="leycoord">
                    <h4>
                        COORDINADOR
                    </h4>
                        
                </div>
                <div class="leytrab">
                    <h4>
                        TRABAJADOR
                    </h4>
                </div>
            </div>

            <?php 
            
                //sql proyectos

                $sql_proyecto = "SELECT * FROM proyectos";
                $stmt_proyecto = $conn->prepare($sql_proyecto);
                $stmt_proyecto->execute();
                $stmt_proyecto->store_result();
                $stmt_proyecto->bind_result($id_proy, $nombre_proy, $descripcion_proy, $fecha_proy);


                while ($stmt_proyecto->fetch()) {

                    //sql del los compañeros de equipo
                    $sql_team = "SELECT id, nombre, email, telefono, usuario, codigocoordinador, imgperfil FROM usuarios WHERE id_proyecto = $id_proy ORDER BY codigocoordinador DESC";
                    $stmt_team = $conn->prepare($sql_team);
                    $stmt_team->execute();
                    $stmt_team->store_result();
                    $stmt_team->bind_result($id_equipo, $nombre_equipo, $email_equipo,$telefono_equipo, $usuario_equipo,$codCoord, $img_equipo);


                    echo '
                    <div class="proyecto">
                        <h3>Proyecto: '. $nombre_proy .'</h3>
                        <div class="detallesProyecto">
                            <p>'. $descripcion_proy . '</p>  
                        </div>
                        <div id="trabajadores">
                    '; 

                    while($stmt_team->fetch()){
                        $clase = ($codCoord != '') ? 'coord trabajador' : 'trabajador';
                        echo'
                        <div class="'. $clase  .'">    
                            <div class="contenedorInfo">
                                <img src="scripts/mostrarImagenEquipo.php?id='. $id_equipo .'" alt="Imagen de '. $usuario_equipo .'">
                                <div class="info">
                                    <h4>'. $nombre_equipo.'</h4>
                                    <p>Email: '. $email_equipo .'</p>
                                    <p>Teléfono: '.$telefono_equipo.'</p>
                                </div>  
                            </div>     
                        </div>
                        ';      
                    }
                    $stmt_team->close();
                    echo '
                        </div>
                    
                    ';
                    ?>
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
                    <?php 
                    echo '
                    
                    </div>
                ';
                }   
                
                $stmt_proyecto->close();
                
            
            ?>
    </main>

<?php 
    include './common/footer.php';

?>
