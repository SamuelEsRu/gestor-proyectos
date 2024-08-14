


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="styles/styles.css"> -->

    <link rel="stylesheet" href="styles/styleHeader.css">
    
</head>
<body>

    <header>
        <h1>GESTOR DE PROYECTOS</h1>

        
   
            <?php if(isset($_SESSION['usuario'])){?>

                <nav>
                    <?php if(!empty($_SESSION['codigocoordinador'])){?>
                    <a href="vistaCoordinador.php">PROYECTOS</a>
                    <a href="formularioRegistro.php">CREAR TRABAJADOR</a>
                    
                    <?php }?>
                    <a href="vistaUsuario.php">MI PERFIL</a>
                    <a href="scripts/logout.php">CERRAR SESIÓN</a>
                </nav>

            <?php }?>
           
    </header>
