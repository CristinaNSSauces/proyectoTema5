<?php
    /**
        *@author: Cristina Núñez
        *@since: 26/11/2020
    */
    if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {//Si el usuario no se ha autentificado
        header('Location: ejercicio01.php');//Redirigimos al usuario al ejercicio01.php para que se autentifique
        exit;
    }
        
    if(isset($_REQUEST['detalles'])){//Si pulsa el botón de detalles
        header('Location: detallesEjercicio1.php');//Redirigimos al usuario a la ventana de detalles
        exit;
    }
    
    if(isset($_REQUEST['salir'])){//Si el usuario pulsa el botón de salir
        header('Location: ../indexProyectoTema5.php');//Redirigimos al usuario al index del tema 5
        exit;
    }
    
    
    
    require_once '../core/libreriaValidacion.php';//Importamos la librería de validación para validar los campos del formulario necesarios
    $errorIdioma = null;//Creamos e inicializamos $errorIdioma a null, en ella almacenaremos (si hay) los errores al validar el campo idioma del formulario
    $entradaOK = true;//Creamos e inicializamos $entradaOK a true
    
    if(isset($_REQUEST['aceptar'])){ //Comprobamos que el usuario haya enviado el formulario
        $errorIdioma = validacionFormularios::validarElementoEnLista($_REQUEST['idioma'], ['es','en','fr']);//Validamos el elemento lista del formulario, de tener error almacenamos el mensaje en la variable $errorIdioma
        if ($errorIdioma != null) {
            $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario                             
        }         
    }else{
        $entradaOK = false; // Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
    }
    if($entradaOK){ // Si el usuario ha rellenado el formulario correctamente rellenamos el array aFormulario con las respuestas introducidas por el usuario
        if($_REQUEST['idioma']=='es'){//Si el idioma seleccionado por el usuario es español
            setcookie("idioma", 'es');//Creamos o cambiamos la cookie idioma al valor 'es'
            setcookie('saludo','Hola');//Creamos o cambiamos la cookie saludo al valor 'del idioma seleccionado por el usuario'Hola'
        }
        if($_REQUEST['idioma']=='en'){//Si el idioma seleccionado por el usuario es ingles
            setcookie("idioma", 'en');//Creamos o cambiamos la cookie idioma al valor 'en'
            setcookie('saludo','Hello');//Creamos o cambiamos la cookie saludo al valor 'del idioma seleccionado por el usuario'Hello'
        }
        if($_REQUEST['idioma']=='fr'){//Si el idioma seleccionado por el usuario es francés
            setcookie("idioma", 'fr');//Creamos o cambiamos la cookie idioma al valor 'fr'
            setcookie('saludo','Salut');//Creamos o cambiamos la cookie saludo al valor 'del idioma seleccionado por el usuario'Salut'
        }
        header('location: ejercicio01.php');//Volvemos a cargar el ejercicio01.php para que se recargue el valor de las cookies
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
            if(isset($_COOKIE['idioma']) && isset($_COOKIE['saludo'])){//Comprobamos que existe $_COOKIE['idioma'] y ($_COOKIE['saludo']
                if($_COOKIE['idioma']=='es'){//Si el idioma almacenado en la cookie idioma es español
            ?>  
                    <h3><?php echo $_COOKIE['saludo'].": ".$_SERVER['PHP_AUTH_USER']; //Mostramos el saludo del español?></h3>
                    <h3>Idioma: <?php echo $_COOKIE['idioma']; //Mostramos el idioma seleccionado en español?></h3>
            <?php
                }
                if($_COOKIE['idioma']=='en'){//Si el idioma almacenado en la cookie idioma es ingles
            ?>   
                    <h3><?php echo $_COOKIE['saludo'].": ".$_SERVER['PHP_AUTH_USER']; //Mostramos el saludo del ingles?></h3>
                    <h3>Language: <?php echo $_COOKIE['idioma']; //Mostramos el idioma seleccionado en ingles?></h3>
            <?php
                }
                if($_COOKIE['idioma']=='fr'){//Si el idioma almacenado en la cookie idioma es francés
            ?>   
                    <h3><?php echo $_COOKIE['saludo'].": ".$_SERVER['PHP_AUTH_USER']; //Mostramos el saludo del frances?></h3>
                    <h3>Langage: <?php echo $_COOKIE['idioma']; //Mostramos el idioma seleccionado en francés?></h3>
            <?php
                }
            }else{
        ?>
                <h3>Hola: <?php echo $_SERVER['PHP_AUTH_USER']; //Por defecto el saludo en español?></h3>
        <?php
            }
        ?>
        <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
            <label for="idioma">Seleccione Idioma:</label>
                <select id="idioma" name="idioma">
                  <option value="es" <?php 
                    if(isset($_COOKIE['idioma'])){//si existe la cookie idioma
                        if($_COOKIE['idioma']=='es'){//Si el idioma almacenado es español
                            echo 'selected';//Será el valor seleccionado en nuestra lista
                        }
                    }
                    ?>>Español</option>
                  <option value="en" <?php
                    if(isset($_COOKIE['idioma'])){//si existe la cookie idioma
                        if($_COOKIE['idioma']=='en'){//Si el idioma almacenado es ingles
                            echo 'selected';//Será el valor seleccionado en nuestra lista
                        }
                    }
                    ?>>English</option>
                  <option value="fr" <?php
                    if(isset($_COOKIE['idioma'])){//si existe la cookie idioma
                        if($_COOKIE['idioma']=='fr'){//Si el idioma almacenado es frances
                            echo 'selected';//Será el valor seleccionado en nuestra lista
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