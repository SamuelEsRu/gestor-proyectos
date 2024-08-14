<?php 
session_start();

$id = $_SESSION['id'];

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

$trabajador_query = "SELECT id ,nombre, email, telefono, usuario, contrasena, imgperfil FROM usuarios WHERE id = $id";
$trabajador_run = mysqli_query($conn, $trabajador_query);

$proyectos_query = "SELECT id ,nombre FROM proyectos";
$stmt_team = $conn->prepare($proyectos_query);
$stmt_team->execute();
$stmt_team->store_result();
$stmt_team->bind_result($id_proy, $nombre_proy);

include "./common/header.php";
?>
<link rel="stylesheet" href="styles/styleFormulario.css">

    <main>

    <?php 

        foreach($trabajador_run as $trabajador){

    
    ?>

    <form action="./scripts/actualizarUsuario.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo $trabajador["id"] ?>">
            <h2>Modifica tus datos:</h2>
            <label for="nombre">Nombre completo:</label><br>
            <input type="text" id="nombre" name="nombre" value="<?php echo $trabajador["nombre"] ?>" required><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" value="<?php echo $trabajador["email"] ?>" required><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" value="<?php echo $trabajador["telefono"] ?>" required><br>

            <label for="nombreUsuario">Usuario:</label><br>
            <input type="text" id="nombreUsuario" name="nombreUsuario" value="<?php echo $trabajador["usuario"] ?>" required><br>
            
            <label for="contrasena">Contraseña:</label><p class="error inv">Las contraseñas no coinciden</p><br>
            <input type="password" id="contrasena" name="contrasena" value="<?php echo $trabajador["contrasena"] ?>" required><br>
            

            <label for="confirmarContrasena">Confirma contraseña:</label><p class="error inv">Las contraseñas no coinciden</p><br>
            <input type="password" id="confirmarContrasena" name="confirmarContrasena" value="<?php echo $trabajador["contrasena"] ?>" required><br>
            
            <label for="proy">Proyecto al que pertenece:</label>
            <select name="proy" id="proy">

                <?php 
                    while ($stmt_team->fetch()) {
                    
                        echo'
                            <option value="'. $id_proy .'">'.  $nombre_proy.'</option>
                            
                        ';                    
                                                    
                    }
                ?>

            </select>

            <label for="">Imagen de perfil:</label><br>

            <label for="imgPerfil" class="custom-file-upload" accept="image/*">
                Imagen de perfil
            </label>

            <input id="imgPerfil" name="imgPerfil" type="file"  onchange = "loadFile(event)"/>

            <div id="previsualizarImagen">
                
                <img id="outputImagen" src="scripts/mostrarImagenEquipo.php?id=<?php echo $trabajador['id']; ?>"/> 
            </div>

            <input type="submit" id="confirmar" value="Modificar datos" >

        </form>

        <?php } ?>

    </main>

    <?php 
    
    include "./common/footer.php"
    
    ?>
    <script>

        let loadFile = function(event) {

            let reader = new FileReader();
            reader.onload = function(){
                let output = document.getElementById('outputImagen');
                output.src = reader.result;
                output.style.width = "auto";
                output.style.height = "200px";
                

                output.style.borderRadius = "10px";

            };

        reader.readAsDataURL(event.target.files[0]);
        };
    </script>
    <script src="scripts/comprobarContrasenas.js"></script>
</body>
</html>
