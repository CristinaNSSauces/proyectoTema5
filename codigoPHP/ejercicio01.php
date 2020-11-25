<?php
    /**
        *@author: Cristina Núñez
        *@since: 25/11/2020
    */ 
if ($_SERVER['PHP_AUTH_USER'] != 'admin' || $_SERVER['PHP_AUTH_PW'] != 'paso') {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario incorrecto";
    exit;
}else{
    if (!isset($_COOKIE['idioma'])) {
        setcookie("idioma", "Castellano");
    }
    header('Location: programaEjercicio1.php'); 
}
?>
