<?php 
session_start();
$nombreservidor = "localhost";
$nombreusuario="root";
$contrasena = "";
$nombredb = "gestorproyectos";

$conn = new mysqli($nombreservidor, $nombreusuario, $contrasena, $nombredb);

if($conn->connect_error){
    die("Conexión fallida" . $conn->connect_error);
}

$titulo = (isset($_SESSION['usuario']) && $_SESSION['usuario']) ? "Crear trabajador" : "Regístrate";


$proyectos_query = "SELECT id ,nombre FROM proyectos";
$stmt_team = $conn->prepare($proyectos_query);
$stmt_team->execute();
$stmt_team->store_result();
$stmt_team->bind_result($id_proy, $nombre_proy);
include "./common/header.php";

?>
<link rel="stylesheet" href="styles/styleFormulario.css">
    <?php
        if (isset($_GET['error'])) {

            switch($_GET['error']){
                case 'email_exists' :
                echo '<h2 class="error">Este correo ya existe</h2>';
                break;

                case 'invalid_phone':
                echo '<h2 class="error">El telefono ha de tener  tener 9 dígitos</h2>';
                break;

                default:
                echo '<h2> Algo salio mal, intentalo de nuevo </h2>';
                break;
            }
            
        }
    ?>

    <main>
      

    <form action="registrarUsuario.php" method="POST" enctype="multipart/form-data">
            <h2><?php echo $titulo ?></h2>
            <label for="nombre">Nombre completo:</label><br>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="email">Email:</label><br>
            <input type="text" id="email" name="email" required><br>

            <label for="telefono">Teléfono:</label><br>
            <input type="text" id="telefono" name="telefono" max required><br>

            <label for="nombreUsuario">Usuario:</label><br>
            <input type="text" id="nombreUsuario" name="nombreUsuario" required><br>
            
            <label for="contrasena">Contraseña:</label><br>
            <input type="password" id="contrasena" name="contrasena" required><br>

            <label for="codAdmin">Código de coordinardor: (Si no tienes déjalo en blanco)</label><br>
            <input type="text" id="codAdmin" name="codAdmin"><br>
            
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
            
            <input id="imgPerfil" name="imgPerfil" type="file" onchange = "loadFile(event)"/>

            <div id="previsualizarImagen">
                <img id="outputImagen"/> 
            </div>

            <input type="submit" value="Registrarse">

            
           
            <?php if(!isset($_SESSION['usuario']) || !$_SESSION['usuario']){ ?>
                <a href="ingresar.php">¿Ya tienes una cuenta? Pulsa aquí</a>
            <?php } ?>
        </form>


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
                // output.style.margin = "auto 0";

                output.style.borderRadius = "10px";

            };

        reader.readAsDataURL(event.target.files[0]);
        };
    </script>
</body>
</html>