a<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 00</title>         
    </head>
    <body>
        <table style="margin:auto; ">
        
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_SERVER</td>
        </tr>
            <?php
            /**
                *@author: Cristina Núñez
                *@since: 23/11/2020
            */ 
            foreach ($_SERVER as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_GET</td>
        </tr>
            <?php
            foreach ($_GET as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_POST</td>
        </tr>
            <?php
            foreach ($_POST as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_FILES</td>
        </tr>
            <?php
            foreach ($_FILES as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_REQUEST</td>
        </tr>
            <?php
            foreach ($_REQUEST as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_SESSION</td>
        </tr>
            <?php
            if(isset($_SESSION)){
                foreach ($_SESSION as $key => $value) {
                ?>
                    <tr>
                        <td style="background-color:#7be4cf;"><?php echo $key?></td>
                        <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                    </tr>
                <?php
                }
            }
            
            ?>
            
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_ENV</td>
        </tr>
        
            <?php
            foreach ($_ENV as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
            
        
        <tr>
            <td colspan="2" style="font-weight: bold; text-align: center; background-color: #6dc4b3">$_COOKIE</td>
        </tr>
            <?php
            foreach ($_COOKIE as $key => $value) {
            ?>
                <tr>
                    <td style="background-color:#7be4cf;"><?php echo $key?></td>
                    <td style="background-color:#d6d6d6;"><?php echo $value?></td>
                </tr>
            <?php
            }
            ?>
        <tr>
            <td colspan="2" style="width: 100%;height: 100%;background-color: #efcb84; text-align: center;"><a style="text-decoration: none; background-color: #efcb84" href="../indexProyectoTema5.php">SALIR</a></td>
        </tr>
    </table> 
        <?php
        phpinfo();
        ?>
    </body>
</html>