<?php
    /**
        *@author: Cristina Núñez
        *@since: 26/11/2020
    */
    if(isset($_REQUEST['detalles'])){
        header('Location: detallesEjercicio1.php');
        exit;
    }
    
    if ($_SERVER['PHP_AUTH_USER'] != 'admin' || $_SERVER['PHP_AUTH_PW'] != 'paso') {
        header('Location: ejercicio01.php');
        exit;
    }
    
    require_once '../core/201109libreriaValidacion.php';
    $errorIdioma = null;
    $entradaOK = true;
    
    if(isset($_REQUEST['aceptar'])){ //Comprobamos que el usuario haya enviado el formulario
        $errorIdioma = validacionFormularios::validarElementoEnLista($_REQUEST['idioma'], ['es','en','fr']);
        if ($errorIdioma != null) {
            $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario                             
        }         
    }else{
        $entradaOK = false; // Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
    }
    if($entradaOK){ // Si el usuario ha rellenado el formulario correctamente rellenamos el array aFormulario con las respuestas introducidas por el usuario
        if($_REQUEST['idioma']=='es'){
            setcookie("idioma", 'es');
            setcookie('saludo','Hola');
        }
        if($_REQUEST['idioma']=='en'){
            setcookie("idioma", 'en');
            setcookie('saludo','Hello');
        }
        if($_REQUEST['idioma']=='fr'){
            setcookie("idioma", 'fr');
            setcookie('saludo','Salut');
        }
        header('location: ejercicio01.php');
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
        <?php
            if(isset($_COOKIE['idioma']) && isset($_COOKIE['saludo'])){
                if($_COOKIE['idioma']=='es'){
            ?>  
                    <h3><?php echo $_COOKIE['saludo'].": ".$_SERVER['PHP_AUTH_USER'];?></h3>
                    <h3>Idioma: <?php echo $_COOKIE['idioma'];?></h3>
            <?php
                }
                if($_COOKIE['idioma']=='en'){
            ?>   
                    <h3><?php echo $_COOKIE['saludo'].": ".$_SERVER['PHP_AUTH_USER'];?></h3>
                    <h3>Language: <?php echo $_COOKIE['idioma'];?></h3>
            <?php
                }
                if($_COOKIE['idioma']=='fr'){
            ?>   
                    <h3><?php echo $_COOKIE['saludo'].": ".$_SERVER['PHP_AUTH_USER'];?></h3>
                    <h3>Langage: <?php echo $_COOKIE['idioma'];?></h3>
            <?php
                }
            }else{
        ?>
                <h3>Hola: <?php echo $_SERVER['PHP_AUTH_USER'];?></h3>
        <?php
            }
        ?>
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label for="idioma">Seleccione Idioma:</label>
                <select id="idioma" name="idioma">
                  <option value="es" <?php 
                    if(isset($_COOKIE['idioma'])){
                        if($_COOKIE['idioma']=='es'){
                            echo 'selected';
                        }
                    }
                    ?>>Español</option>
                  <option value="en" <?php
                    if(isset($_COOKIE['idioma'])){
                        if($_COOKIE['idioma']=='en'){
                            echo 'selected';
                        }
                    }
                    ?>>English</option>
                  <option value="fr" <?php
                    if(isset($_COOKIE['idioma'])){
                        if($_COOKIE['idioma']=='fr'){
                            echo 'selected';
                        }
                    }     
                    ?>>Français</option>
                </select>
                <input type="submit" value="aceptar" name="aceptar">
                <br><br>
            <button type="submit" name='detalles' value="detalles" class="volver">DETALLES</button>
            <button type="submit" name='salir' value="salir" class="volver">SALIR</button>
        </form>
    </body>
</html>