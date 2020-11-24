<?php
    if(isset($_REQUEST['detalles'])){
        header('Location: detalles.php'); 
    }else{
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 01</title>         
    </head>
    <body>
        <h1>Hola <?php echo $_SERVER['PHP_AUTH_USER']?></h1>
        <form  name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <button type="submit" name='detalles' value="detalles" class="volver">DETALLES</button>
            <a href="../indexProyectoTema5.php"><button type="button" name='salir' value="salir" class="volver">SALIR</button></a>
        </form>
    </body>
</html>
<?php
}
?>