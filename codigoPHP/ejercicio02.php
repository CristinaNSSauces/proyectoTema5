<?php
    /**
        *@author: Cristina Núñez
        *@since: 26/11/2020
    */
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {//Si el usuario no ha rellenado el usuario y la contraseña
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    exit;
}
    require_once "../config/confDBPDO.php";//Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexión 
    try{//validamos que la CodUsuario sea correcta
            $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexión
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones

            $sql = "Select T01_CodUsuario, T01_Password from T01_Usuario where T01_CodUsuario=:CodUsuario";
            $consulta = $miDB->prepare($sql);//Preparamos la consulta
            $parametros = [":CodUsuario" => $_SERVER['PHP_AUTH_USER']];

            $consulta->execute($parametros);//Pasamos los parámetros a la consulta
            
            if($consulta->rowCount()>0){//Si la consulta nos devuelve algo
                $resultado = $consulta->fetchObject();//Obtenemos el primer registro de la consulta y avanzamos el puntero al siguiente registro
                $passwordEncriptado=hash("sha256", ($_SERVER['PHP_AUTH_USER'].$_SERVER['PHP_AUTH_PW']));//Almacenamos en $passwordEncriptado el valor resultante de la encriptacion del codigo de usuario junto a la contraseña
                if($resultado->T01_CodUsuario==$_SERVER['PHP_AUTH_USER'] && $resultado->T01_Password==$passwordEncriptado){//Si se da esta condición el usuario y la contraseña son correctos
                    session_start();//Iniciamos una sesión o si ya existía la reanudamos
                    $_SESSION['usuario']=$_SERVER['PHP_AUTH_USER'];//Asignamos el valo de el codigo de usuario a la variable creada $_SESSION['usuario]
                    header('Location: programaEjercicio2.php'); //Redirigimos al usuario al programa
                    exit;
                }
            }else{
                header('WWW-Authenticate: Basic Realm="Contenido restringido"');
                header('HTTP/1.0 401 Unauthorized');
                echo "Usuario incorrecto";
                echo '<a href="../indexProyectoTema5.php"><button type="button" name="volver" value="volver" class="volver">VOLVER</button></a>';
                exit;
            }
        }catch(PDOException $excepcion){
            $errorExcepcion = $excepcion->getCode();//Almacenamos el código del error de la excepción en la variable $errorExcepcion
            $mensajeExcepcion = $excepcion->getMessage();//Almacenamos el mensaje de la excepción en la variable $mensajeExcepcion

            echo "<span style='color: red;'>Error: </span>".$mensajeExcepcion."<br>";//Mostramos el mensaje de la excepción
            echo "<span style='color: red;'>Código del error: </span>".$errorExcepcion;//Mostramos el código de la excepción
        } finally {
           unset($miDB); //cerramos la conexion con la base de datos
        }
?>