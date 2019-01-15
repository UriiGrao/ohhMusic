<!DOCTYPE html>

<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>        <title></title>
    </head>
    <body>
        <?php
        require_once 'functest.php';
        $ciudades = selectProvincia(8116);
        $cont = 0;
        ini_set('max_execution_time', 60);
        while ($fila = mysqli_fetch_assoc($ciudades)) {
            extract($fila);
            
            echo "$Provincia     -      $Ciudad<br>";
            $insert = volcadoDatos($Provincia, $Ciudad);
            if ($insert == "ok") {
                $cont++;
                echo "Añadido: $cont <br>";
                continue;
            } else {
                echo "Algo ha ocurrido: $insert<br>";
                
            }
        }
?>


    </body>
</html>
