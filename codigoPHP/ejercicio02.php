<?php
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    header('WWW-Authenticate: Basic Realm="Contenido restringido"');
    header('HTTP/1.0 401 Unauthorized');
    echo "Usuario incorrecto";
    exit;
}else{
    require_once '../core/201109libreriaValidacion.php';
    require_once "../config/confDBPDO.php";//Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexión 
    try{//validamos que la CodUsuario sea correcta
            $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexión
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones

            $sql = "Select CodUsuario, Password from Usuario where CodUsuario=:CodUsuario";
            $consulta = $miDB->prepare($sql);//Preparamos la consulta
            $parametros = [":CodUsuario" => $_SERVER['PHP_AUTH_USER']];

            $consulta->execute($parametros);//Pasamos los parámetros a la consulta
            $resultado = $consulta->fetchObject();
            if($consulta->rowCount()>0){
                $CodigoUsuario = $resultado->CodUsuario;
                $Password = $resultado->Password;
                
                $passwordEncriptado=hash("sha256", ($_SERVER['PHP_AUTH_USER'].$_SERVER['PHP_AUTH_PW']));
                if($CodigoUsuario==$_SERVER['PHP_AUTH_USER'] && $Password==$passwordEncriptado){
                    header('Location: programa.php'); 
                    exit;
                }
            }else{
                echo "<h3>Usuario incorrecto</h3>";
                echo '<a href="../indexProyectoTema5.php"><button type="button" name="volver" value="volver" class="volver">VOLVER</button></a>';
            }
        }catch(PDOException $excepcion){
            $errorExcepcion = $excepcion->getCode();//Almacenamos el código del error de la excepción en la variable $errorExcepcion
            $mensajeExcepcion = $excepcion->getMessage();//Almacenamos el mensaje de la excepción en la variable $mensajeExcepcion

            echo "<span style='color: red;'>Error: </span>".$mensajeExcepcion."<br>";//Mostramos el mensaje de la excepción
            echo "<span style='color: red;'>Código del error: </span>".$errorExcepcion;//Mostramos el código de la excepción
        } finally {
           unset($miDB); //cerramos la conexion con la base de datos
        }
}
?>