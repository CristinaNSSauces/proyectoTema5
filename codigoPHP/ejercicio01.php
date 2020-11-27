<?php
    /**
        *@author: Cristina Núñez
        *@since: 26/11/2020
    */ 
    if ($_SERVER['PHP_AUTH_USER'] != 'admin' || $_SERVER['PHP_AUTH_PW'] != 'paso') {//Si el usuario es distinto de admin y la contraseña distinta de paso volveremos a pedir que se autentifique
        header('WWW-Authenticate: Basic Realm="Contenido restringido"');
        header('HTTP/1.0 401 Unauthorized');
        exit;
    }
    
    header('Location: programaEjercicio1.php');//Si se ha autentificado correctamente le redirigiremos al programa

?>
