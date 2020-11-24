<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 00</title>         
    </head>
    <body>
        <?php
        /**
            *@author: Cristina Núñez
            *@since: 23/11/2020
        */
       
        
            echo "<h3>\"GLOBALS\"</h3>";
            echo "<pre>";
            print_r($GLOBALS);
            echo "</pre>";

            echo "<h3>\"_SERVER\"</h3>";
            echo "<pre>";
            print_r($_SERVER);
            echo "</pre>";

            echo "<h3>\"_GET\"</h3>";
            echo "<pre>";
            print_r($_GET);
            echo "</pre>";

            echo "<h3>\"_POST\"</h3>";
            echo "<pre>";
            print_r($_POST);
            echo "</pre>";

            echo "<h3>\"_FILES\"</h3>";
            echo "<pre>";
            print_r($_FILES);
            echo "</pre>";

            echo "<h3>\"_COOKIE\"</h3>";
            echo "<pre>";
            print_r($_COOKIE);
            echo "</pre>";

            echo "<h3>\"_SESSION\"</h3>";
            echo "<pre>";
            print_r($_SESSION);
            echo "</pre>";

            echo "<h3>\"_REQUEST\"</h3>";
            echo "<pre>";
            print_r($_REQUEST);
            echo "</pre>";

            echo "<h3>\"_ENV\"</h3>";
            echo "<pre>";
            print_r($_ENV);
            echo "</pre>";
            phpinfo();
        ?>
        
    </body>
</html>