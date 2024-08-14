
<?php 
include './common/header.php';



?>
<link rel="stylesheet" href="./styles/bienvenida.css">
    <div class="contenedorCuadrados"></div>
    <main>

      

        <div class="formularioInicio">
            <div class="maquinaEscribir">
                <span >
                    <h1>Gestiona tu plantilla</h1>
                </span>
            </div>
            <form action="iniciarSesion.php" method = "POST">
                <label for="nombreUsuario">Nombre de usuario</label>
                <input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="SAMUELER" required>

                <label for="pwUsuario">Contraseña</label>
                <input type="password" name="pwUsuario" id="pwUsuario" required>

                


                <input type="submit" value="Ingresar" name="" id="" >

                <div class="links">
                    <a href="formularioRegistro.php">Regístrate</a>
                    <a href="#">¿Has olvidado tu contraseña?</a>
                    
                </div>

            </form>

        </div>


        
        
    </main>
    <?php 
    
    include "./common/footer.php";
    
    ?>
  <script src="./scripts/bienvenida.js"></script>  
</body>
</html>