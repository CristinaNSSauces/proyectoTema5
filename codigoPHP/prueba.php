<?php
require_once "../config/confLocation.php"; //Incluimos el archivo de configuración para poder acceder a la constante de la url del header Location
    
if(isset($_REQUEST['cancelar'])){//Si pulsa el botón de cancelar
    header('Location: '.URL.'/proyectoMtoDepartamentosTema4/codigoPHP/mtoDepartamentos.php');//Redirigimos al usuario a la página inicial
}
    /**
        *@author: Cristina Núñez
        *@since: 17/11/2020
    */
    require_once '../core/201109libreriaValidacion.php';//Incluimos la librería de validación para comprobar los campos del formulario
    require_once "../config/confDBPDO.php";//Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexión 

    //declaracion de variables universales
    define("OBLIGATORIO", 1);
    define("OPCIONAL", 0);
    $entradaOK = true;


    //Declaramos el array de errores y lo inicializamos a null
    $aErrores = ['CodUsuario' => null,
                 'Password' => null];

    //Declaramos el array del formulario y lo inicializamos a null
    $aFormulario = ['CodUsuario' => null,
                    'Password' => null];

    if(isset($_REQUEST['aceptar'])){ //Comprobamos que el usuario haya enviado el formulario
        $aErrores['CodUsuario'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['CodUsuario'], 15, 3, OBLIGATORIO);
        try{//validamos que la CodUsuario sea correcta
            $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexión
            $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones

            $sqlUsuario = "Select CosUsuario from Usuario where CodUsuario=:CodUsuario";
            $consultaUsuario = $miDB->prepare($sqlUsuario);//Preparamos la consulta
            $parametrosUsuario = [":CodUsuario" => $_REQUEST['CodUsuario']];

            $consultaUsuario->execute($parametrosUsuario);//Pasamos los parámetros a la consulta
            

            if($consultaUsuario->rowCount()<=0){
                $aErrores['CodUsuario'] = "Usuario incorrecto";//Añadimos un mensaje de error al array de errores
            }
        }catch(PDOException $excepcion){
            $errorExcepcion = $excepcion->getCode();//Almacenamos el código del error de la excepción en la variable $errorExcepcion
            $mensajeExcepcion = $excepcion->getMessage();//Almacenamos el mensaje de la excepción en la variable $mensajeExcepcion

            echo "<span style='color: red;'>Error: </span>".$mensajeExcepcion."<br>";//Mostramos el mensaje de la excepción
            echo "<span style='color: red;'>Código del error: </span>".$errorExcepcion;//Mostramos el código de la excepción
        } finally {
           unset($miDB); //cerramos la conexion con la base de datos
        }
        
        if($aErrores['CodUsuario']==null){
            try{//validamos que la contraseña sea correcta
                $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexión
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones

                $sqlPassword = "Select Password from Usuario where CodUsuario=:CodUsuario";
                $consultaPassword = $miDB->prepare($sqlPassword);//Preparamos la consulta
                $parametrosPassword = [":CodUsuario" => $_REQUEST['CodUsuario']];

                $consultaPassword->execute($parametrosPassword);//Pasamos los parámetros a la consulta
                $resultadoPassword = $consultaPassword->fetchObject();//Obtenemos el primer registro de la consulta y avanzamos el puntero al siguiente
                $password = $resultadoPassword->Password;
                $passwordUsuario=hash("sha256", $_REQUEST('CodUsuario').$_REQUEST('Password'));

                if($passwordUsuario!=$password){//Si el código de departamento ya existe
                    $aErrores['Password'] = "Contraseña incorrecta";
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
        // Recorremos el array de errores
        foreach ($aErrores as $campo => $error){
            if ($error != null) { // Comprobamos que el campo no esté vacio
                $entradaOK = false; // En caso de que haya algún error le asignamos a entradaOK el valor false para que vuelva a rellenar el formulario      
                $_REQUEST[$campo] = "";//Limpiamos el campo
            }
        }
    }else{
        $entradaOK = false; // Si el usuario no ha enviado el formulario asignamos a entradaOK el valor false para que rellene el formulario
    }
    if($entradaOK){ // Si el usuario ha rellenado el formulario correctamente rellenamos el array aFormulario con las respuestas introducidas por el usuario
        $aFormulario['CodUsuario'] = $_REQUEST['CodUsuario'];
        $aFormulario['Password'] = $_REQUEST['Password'];
        echo "Bienvenido";
    }else{//Si el usuario no ha rellenado el formulario correctamente volvera a rellenarlo
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mto Departamentos</title>
    <link href="../webroot/css/style.css" rel="stylesheet"> 
</head>
<body>
    <header>
        <div class="logo">Mantenimiento de Departamentos - Alta Departamento</div>
    </header>
    <main class="mainEditar">
        <div class="contenido">
            <form name="formulario" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="formularioAlta">
                <div>
                    <label style="font-weight: bold;" class="CodigoDepartamento" for="CodDepartamento">Código de departamento: </label>
                    <input type="text" style="background-color: #D2D2D2" id="CodDepartamento" name="CodDepartamento" value="<?php echo(isset($_REQUEST['CodDepartamento']) ? $_REQUEST['CodDepartamento'] : null); ?>">
                    <?php echo($aErrores['CodDepartamento']!=null ? "<span style='color:red'>".$aErrores['CodDepartamento']."</span>" : null); ?>
                    <br><br>

                    <label style="font-weight: bold;" class="DescripcionDepartamento" for="DescDepartamento">Descripción de departamento: </label>
                    <input type="text" style="background-color: #D2D2D2" id="DescDepartamento" name="DescDepartamento" value="<?php echo(isset($_REQUEST['DescDepartamento']) ? $_REQUEST['DescDepartamento'] : null);?>">
                    <?php echo($aErrores['DescDepartamento']!=null ? "<span style='color:red'>".$aErrores['DescDepartamento']."</span>" : null); ?>
                    <br><br>
                </div> 
                <div>
                    <input type="submit" style="background-color: #a3f27b;" value="Aceptar" name="aceptar" class="aceptar">
                    <input type="submit" style="background-color: #f27b7b;" value="Cancelar" name="cancelar" class="cancelar">
                </div>
            </form>
        </div>
    </main>
</body>
</html>
<?php
    }
?>