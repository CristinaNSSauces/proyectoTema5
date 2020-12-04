<?php
    /**
        *@author: Cristina Núñez
        *@since: 26/11/2020
    */
    session_start();//Reanudamos la sesion existente
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {//Si el usuario no se ha autentificado
        header('Location: ejercicio02.php');//Redirigimos al usuario al ejercicio02.php para que se autentifique
        exit;
    }
    
    if(isset($_REQUEST['detalles'])){//Si pulsa el botón de detalles
        header('Location: detallesEjercicio2.php');//Redirigimos al usuario a la ventana de detalles
        exit;
    }
    
    if(isset($_REQUEST['salir'])){//Si el usuario pulsa el botón de salir
        session_destroy();//Destruimos toda la información registrada en la sesión
        header('Location: ../indexProyectoTema5.php');//Redirigimos al usuario al index del tema 5
        exit;
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 01</title>         
    </head>
    <body>
        <h1>Hola <?php echo $_SESSION['usuario']?></h1>
        <form  name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <button type="submit" name='detalles' value="detalles" class="volver">DETALLES</button>
            <button type="submit" name='salir' value="salir" class="volver">SALIR</button>
        </form>
    </body>
</html>