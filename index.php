<!DOCTYPE html>
<?php
session_start();
ob_start();
require_once 'inibbdd.php';
require_once './bbdd.php';
?>

<html>

    <head>

        <title>Ohh Music</title>
        <meta charset="UTF-8">
        <link rel="shprtcut icon" href="picturesMusic/iconx24.png"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="PlugIn's/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="PlugIn's/jquery-validation-1.17.0/dist/additional-methods.min.js" type="text/javascript"></script>
        <script src="PlugIn's/jquery-validation-1.17.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <link href="PlugIn's/slick-1.8.0/slick/slick.css" rel="stylesheet" type="text/css"/>
        <script src="PlugIn's/slick-1.8.0/slick/slick.min.js" type="text/javascript"></script>
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Quicksand|Rozha+One" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet"> 
        <link href="style2.css" rel="stylesheet" type="text/css"/>
        <script src="js.js" type="text/javascript"></script>

    </head>

    <body>

        <div class="all">

            <div class="navy">

                <h1>Ohh Music</h1>

                <div id="but">

                    <a href="registro.php"><input type="button" value="Contactanos"></a>

                </div><!--but-->

            </div>   <!-- nav -->

            <div class="content">

                <div id="your-class">

                    <div class="prom" id="prom1">

                        <img src="picturesMusic/conciert.jpg" alt=""/>

                        <div class="pint">

                            <p>La herramienta para Músicos, Fans y Locales</p>

                        </div> <!--pint-->

                    </div> 

                    <div class="prom" id="prom2">

                        <img src="picturesMusic/conciert.jpg" alt=""/>
                        <p class="titl">¿Que nos hace diferentes?</p>

                        <div class="promM">

                            <h5>Oportunidades Exclusivas</h5>
                            <p class="secn">- Encuentra los mejores locales para actuar</p>

                        </div> <!--promM-->

                        <div class="promM">

                            <h5>Los mejores servicios</h5>
                            <p class="secn">- Administramos todo lo que se necesita y mas</p>

                        </div> <!--promM-->

                    </div> <!--prom2-->

                </div> <!--your-class-->

                <div id="ty">

                    <p class="pas">Empieza ahora a</p> 

                    <div class="slick">
                        <div class="pass">conocer a artistas</div>
                        <div class="pass">encontrar locales en los que actuar</div>
                        <div class="pass">patrocinar tus locales </div>
                    </div>

                    <p class="pas">Con Ohh Music</p>

                </div> <!--ty-->

                <div id="tables">

                    <div class="plantiTable">

                        <h2>Musicos</h2>

                        <?php
                        $musicos = listamusico();
                        echo "<table class= 'table'>";
                        echo "<tr>";
                        echo "<th class='th'>Artista</th><th class='th'>Genero</th><th class='th'>Web</th><th class='th'>Numero de componentes</th><th class='th'>Votos Obtenidos</th>";
                        while ($fila = mysqli_fetch_array($musicos)) {
                            echo "<tr>";
                            extract($fila);
                            echo "<td class='td'>$nombreArtistico</td><td class='td'>$nombre</td><td class='td'>$web</td><td class='td'>$num_componentes</td><td class='td'>$voto</td>";
                            echo "</tr>";
                        }
                        echo "</tr>";
                        echo "</table>";
                        ?>
                    </div> <!--musicos-->

                </div><!--tables-->

                <div id="conciertos">

                    <div class="plantiTable">

                        <h3>Conciertos</h3>

                        <?php
                        echo "<table>";
                        echo "<tr>";
                        echo "<th class='thy'>Fecha concierto</th><th class='thy'>Hora</th><th class='thy'>Direccion</th><th class='thy'>Artista</th><th class='thy'>Genero musical</th>";
                        echo "</tr>";
                        $filasPorPagina = 5;
                        if (isset($_GET["contador"])) {
                            $contador = $_GET["contador"];
                        } else {
                            $contador = 0;
                        }
                        $total = totalConciertos();

                        $concierto = selectConciertoAceptadosIndex($contador, $filasPorPagina);
                        while ($fila = mysqli_fetch_array($concierto)) {
                            echo "<tr>";
                            extract($fila);
                            echo "<td class='tdy'>$fecha_concierto</td><td class='tdy'>$hora</td><td class='tdy'>$direccion</td><td class='tdy'>$nombreArtistico</td><td class='tdy'>$nombre</td>";
                            echo "</tr>";
                        }
                        echo "</table>";

                        if ($contador > 0) {
                            echo "<a href='index.php?contador=" . ($contador - $filasPorPagina) . "'>Anterior </a>"; 
                        }
                        // Mostrando mensaje de los resultados actuales
                        if (($contador + $filasPorPagina) <= $total) {
                            echo "Mostrando de " . ($contador + 1) . " a " . ($contador + $filasPorPagina) . " de $total";
                        } else {
                            echo "Mostrando de " . ($contador + 1) . " a $total de $total";
                        }
                        // Mostrar el siguiente (en cado de que lo haya)
                        if (($contador + $filasPorPagina) < $total) {
                            echo "<a href='index.php?contador=" . ($contador + $filasPorPagina) . "'> Siguiente</a>";
                        }
                        ?>

                    </div><!--plantiTable-->

                </div> <!--conciertos-->

            </div> <!--content-->

            <div id="footer">

                <p>¿Listo para probar Ohh Music? ¡Es gratis!</p><br>
                <a href="registro.php"><input type="button" value="Contactanos"></a><br> 

                <p id="marcaDeAgua">@2018 OhhMusic</p>

            </div> <!--footer-->

        </div> <!-- all -->

    </body>

</html>
