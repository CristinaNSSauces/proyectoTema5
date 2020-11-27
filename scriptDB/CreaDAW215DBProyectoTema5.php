<?php
        /**
            *@author: Cristina Núñez
            *@since: 26/11/2020
        */ 
            
        require_once "../config/confDBPDO.php";//Incluimos el archivo confDBPDO.php para poder acceder al valor de las constantes de los distintos valores de la conexión 
        
            try {
                $miDB = new PDO(DNS,USER,PASSWORD);//Instanciamos un objeto PDO y establecemos la conexión
                $miDB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Configuramos las excepciones
                
                $sql = <<<EOD
                        CREATE TABLE IF NOT EXISTS T02_Departamento(
                            T02_CodDepartamento VARCHAR(3) PRIMARY KEY,
                            T02_DescDepartamento VARCHAR(255) NOT NULL,
                            T02_FechaCreacionDepartamento INT NOT NULL,
                            T02_VolumenNegocio FLOAT NOT NULL,
                            T02_FechaBajaDepartamento INT DEFAULT NULL
                        )ENGINE=INNODB;

                        CREATE TABLE IF NOT EXISTS T01_Usuario(
                            T01_CodUsuario VARCHAR(10) PRIMARY KEY,
                            T01_Password VARCHAR(64) NOT NULL,
                            T01_DescUsuario VARCHAR(255) NOT NULL,
                            T01_NumConexiones INT DEFAULT 0,
                            T01_FechaHoraUltimaConexion INT,
                            T01_Perfil enum('administrador', 'usuario') DEFAULT 'usuario',
                            T01_ImagenUsuario mediumblob NULL
                        )ENGINE=INNODB;
EOD;
                
                $miDB->exec($sql);
                
                echo "<h3> <span style='color: green;'>"."Tablas creadas correctamente</span></h3>";//Si no se ha producido ningún error nos mostrará "Conexión establecida con éxito"
            }
            catch (PDOException $excepcion) {//Código que se ejecutará si se produce alguna excepción
                $errorExcepcion = $excepcion->getCode();//Almacenamos el código del error de la excepción en la variable $errorExcepcion
                $mensajeExcepcion = $excepcion->getMessage();//Almacenamos el mensaje de la excepción en la variable $mensajeExcepcion
                
                echo "<span style='color: red;'>Error: </span>".$mensajeExcepcion."<br>";//Mostramos el mensaje de la excepción
                echo "<span style='color: red;'>Código del error: </span>".$errorExcepcion;//Mostramos el código de la excepción
            } finally {
                unset($miDB);
            }
?>