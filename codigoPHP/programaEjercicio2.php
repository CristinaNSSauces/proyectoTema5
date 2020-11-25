<?php
    /**
        *@author: Cristina Núñez
        *@since: 25/11/2020
    */
    session_start();
    if(isset($_REQUEST['detalles'])){
        header('Location: detalles.php');
        exit;
    }
    if(isset($_REQUEST['salir'])){
        session_destroy();
        unset($_COOKIE['PHPSESSID']);
        header('Location: ../indexProyectoTema5.php');
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