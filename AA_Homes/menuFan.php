<!DOCTYPE html>

<?php
session_start();
require_once '../bbdd.php';
require_once 'function.php';

$userSession = $_SESSION["user"];
$tipoSession = $_SESSION["tipo"];
$idSession = $_SESSION["idUsuario"];
?>
<html>

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../picturesMusic/iconx24.png">
        <title>Fan | Ohh Music</title>
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Quicksand|Rozha+One" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet"> 
        <link href="../style.css" rel="stylesheet" type="text/css"/>
        <link href="menuStyle.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>

        <?php if ($tipoSession == 3) { ?>

            <div class="fview">

                <div class="navy">

                    <div class="divy">

                        <div class="headimglog">

                            <a href="menuFan.php">
                                <h1 class="h11">Ohh Music</h1>
                            </a>

                        </div>    <!-- headimglog -->

                        <div class="searchy">

                            <input class="searchyx" placeholder="Buscar" type="text" name="search" value="">
                            <input class="buttony" type="submit" name="search" value="">
                            <img class="buttonyx" src="../picturesMusic/search.png" height="20px" width="20px" alt="">

                        </div> <!-- searchy -->

                        <div class="menuy">

                            <a href="../AA_Perfils/perfilFan.php" title="Perfil"><img class="imgy" src="../picturesMusic/man.png" alt="" height="24px" width="24px"/></a>
                            <a href="../logOut.php" title="Log Out"><img class="imgy" src="../picturesMusic/logout.png" alt="" height="24px" width="24px"/></a>

                        </div>   <!-- menuy -->

                    </div>   <!-- divy -->

                </div>   <!-- navy -->

                <div class="contenty">

                    <?php
                    // if issets.
                    if (isset($_POST['Votar'])) {
                        $idFan = $_POST['idFan'];
                        $idMusico = $_POST['idMusico'];

                        if (insertFanMu($idFan, $idMusico)) {
                            echo "<script> alert('Votado correctamente'); </script>";
                        } else {
                            echo "<script> alert('Error al votar'); </script>";
                        }
                    }
                    if (isset($_POST['Desvotar'])) {
                        $idFan = $_POST['idFan'];
                        $idMusico = $_POST['idMusico'];

                        if (borrarFanMusico($idFan, $idMusico)) {
                            echo "<script> alert('Voto quitado correctamente'); </script>";
                        } else {
                            echo "<script> alert('Error al quitar voto'); </script>";
                        }
                    }
                    if (isset($_POST['VotarCon'])) {
                        $idFan = $_POST['idFan'];
                        $idCon = $_POST['idConcierto'];

                        if (insertFanCon($idFan, $idCon)) {
                            echo "<script> alert('Votado correctamente'); </script>";
                        } else {
                            echo "<script> alert('Error al votar'); </script>";
                        }
                    }
                    if (isset($_POST['DesvotarCon'])) {
                        $idFan = $_POST['idFan'];
                        $idCon = $_POST['idConcierto'];

                        if (borrarFanCon($idFan, $idCon)) {
                            echo "<script> alert('Voto quitado correctamente'); </script>";
                        } else {
                            echo "<script> alert('Error al quitar voto'); </script>";
                        }
                    }
                    ?>

                    <div class="wilkommen"><p>Hello <div class="welcome"><?php echo $userSession; ?></div><br>
                    </div>

                    <div class="votarMusico">

                        <h2>Votar a Musicos!</h2>

                        <form method="POST">
                            Elegir genero: <select name="generoVotar" value="" required>
                                <?php
                                $musicoGen = selectGenMusic();
                                while ($option1 = mysqli_fetch_assoc($musicoGen)) {
                                    echo "<option>" . $option1['nombre'] . "</option>";
                                }
                                ?>
                            </select>

                            <input type="submit" id="buttonVotarMusico" name="buttonVotarMusico" value="Seleccionar">

                        </form><!--form-->
                        <?php
                        $generoMusico = "1";
                        if (isset($_GET["contador"])) {
                            $contador = $_GET["contador"];
                            $generoMusico = $_GET['generoVotarGET'];
                        } else {
                            $contador = 0;
                        }
                        if (isset($_POST['buttonVotarMusico'])) {
                            $generoMusico = $_POST['generoVotar'];
                            $contador = 0;
                        }
                        if ($generoMusico != "1") {
                            $filasPorPagina = 3; 

                            $total = totalMusicos($generoMusico);


                            $listaMusicos = verMusicos($generoMusico, $contador, $filasPorPagina);

                            $valid = selectMusicoGeneroVotar($generoMusico); // para mirar si existen musicos con ese genero.

                            if ($valid) {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th class='tableTitle'>Nombre Artistico</th><th class='tableTitle'>Web</th>";
                                while ($fila = mysqli_fetch_array($listaMusicos)) {
                                    echo "<tr>";
                                    extract($fila);
                                    echo "<td class='tableData'>$nombreArtistico</td><td class='tableData'>$web</td><td>";
                                    $mufan = selectTablaFanMu($idSession, $userMusico);
                                    if (!$mufan) {
                                        ?>
                                        <form method="POST">
                                            <input type="hidden" name="idFan" value="<?php echo $idSession ?>">
                                            <input type="hidden" name="idMusico" value="<?php echo $userMusico ?>">
                                            <input class="tableButtInput" type="submit" name="Votar" value="Like">
                                        </form>
                                        <?php
                                    } else {
                                        ?>
                                        <form method="POST">
                                            <input type="hidden" name="idFan" value="<?php echo $idSession ?>">
                                            <input type="hidden" name="idMusico" value="<?php echo $userMusico ?>">
                                            <input class="tableButtInput" type="submit" name="Desvotar" value="Dislike">
                                        </form>
                                        <?php
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tr>";
                                echo "</table>";
                                if ($contador > 0) {
                                    echo "<a href='menuFan.php?contador=" . ($contador - $filasPorPagina) . "&generoVotarGET=" . $generoMusico . "'>Anterior </a>";
                                }
                                // Mostrando mensaje de los resultados actuales
                                if (($contador + $filasPorPagina) <= $total) {
                                    echo "Mostrando de " . ($contador + 1) . " a " . ($contador + $filasPorPagina) . " de $total";
                                } else {
                                    echo "Mostrando de " . ($contador + 1) . " a $total de $total";
                                }
                                // Mostrar el siguiente (en cado de que lo haya)
                                if (($contador + $filasPorPagina) < $total) {
                                    echo "<a href='menuFan.php?contador=" . ($contador + $filasPorPagina) . "&generoVotarGET=" . $generoMusico . "'>Siguiente</a>";
                                }
                            } else {
                                if (isset($_POST['buttonVotarMusico'])) {
                                    echo "<script> alert('No Hay Musicos con Este Genero'); </script>";
                                }
                            }
                        } else {
                            echo '<b class="beforeSelect">Para votar, selecciona un genero</b>';
                        }
                        ?>
                    </div> <!-- votarMusico -->

                    <div class="votarConcierto">

                        <h2>Votar a Conciertos!</h2>

                        <?php
                        echo "<table>";
                        echo "<tr>";
                        echo "<th class='tableTitle'>Nº de Concierto</th><th class='tableTitle'>Fecha del Concierto</th><th class='tableTitle'>Hora</th><th class='tableTitle'>NombreMusico</th><th class='tableTitle'>Genero</th>";
                        echo "</tr>";
                        $filasPorPaginaC = 5;
                        if (isset($_GET["contadorC"])) {
                            $contadorC = $_GET["contadorC"];
                        } else {
                            $contadorC = 0;
                        }
                        $totalC = totalConciertos();

                        $fanConcierto = selectTablaFanCon($contadorC, $filasPorPaginaC);
                        while ($fila = mysqli_fetch_array($fanConcierto)) {
                            echo "<tr>";
                            extract($fila);
                            echo "<td class='tableData'>$idConcierto</td><td class='tableData'>$fecha_concierto</td><td class='tableData'>$hora</td><td class='tableData'>$nombreArtistico</td><td class='tableData'>$nombre</td><td>";
                            $conFan = tablaFanCon($idSession, $idConcierto);
                            if (!$conFan) {
                                ?>
                                <form method="POST">
                                    <input class="vote" type="hidden" name="idFan" value="<?php echo $idSession ?>">
                                    <input class="vote" type="hidden" name="idConcierto" value="<?php echo $idConcierto ?>">
                                    <input class="vote" type="submit" name="VotarCon" value="Like">
                                </form>
                                <?php
                            } else {
                                ?>
                                <form method="POST">
                                    <input class="vote" type="hidden" name="idFan" value="<?php echo $idSession ?>">
                                    <input class="vote" type="hidden" name="idConcierto" value="<?php echo $idConcierto ?>">
                                    <input class="vote" type="submit" name="DesvotarCon" value="DisLike">
                                </form>
                                <?php
                            }
                        }
                        echo "</td></tr>";
                        echo "</table>";
                        if ($contadorC > 0) {
                            echo "<a href='menuFan.php?contador=" . ($contadorC - $filasPorPaginaC) . "'>Anterior </a>";
                        }
                        // Mostrando mensaje de los resultados actuales
                        if (($contadorC + $filasPorPaginaC) <= $totalC) {
                            echo "Mostrando de " . ($contadorC + 1) . " a " . ($contadorC + $filasPorPaginaC) . " de $totalC";
                        } else {
                            echo "Mostrando de " . ($contadorC + 1) . " a $totalC de $totalC";
                        }
                        // Mostrar el siguiente (en cado de que lo haya)
                        if (($contadorC + $filasPorPaginaC) < $totalC) {
                            echo "<a href='menuFan.php?contadorC=" . ($contadorC + $filasPorPaginaC) . "'> Siguiente</a>";
                        }
                        ?>

                    </div> <!--votarConcierto -->

                </div>   <!-- contenty -->

            </div>   <!-- fview -->

            <?php
        } else {
            echo 'No eres un fan! No puedes ver esta paguina!';
        }
        ?>
    </body>

</html> 
