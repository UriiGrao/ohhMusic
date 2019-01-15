<!DOCTYPE html>

<?php
session_start();
require_once '../bbdd.php';
require_once './function.php';

$userSession = $_SESSION["user"];
$tipoSession = $_SESSION["tipo"];
$idSession = $_SESSION["idUsuario"];
?>
<html>

    <head>

        <meta charset="UTF-8">
        <link rel="shortcut icon" href="../picturesMusic/iconx24.png">
        <title>Local | Ohh Music</title>
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Quicksand|Rozha+One" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet"> 
        <link href="../style.css" rel="stylesheet" type="text/css"/>
        <link href="menuStyle.css" rel="stylesheet" type="text/css"/>

    </head>

    <body>

        <?php if ($tipoSession == 2) { ?>

            <div class="fview">

                <div class="navy">

                    <div class="divy">

                        <div class="headimglog">

                            <a href="menuLocal.php" >
                                <h1 class="h11">Ohh Music</h1>

                            </a>

                        </div> <!-- headimglog -->

                        <div class="searchy">
                            <input class="searchyx" placeholder="Buscar" type="text" name="search" value="">
                            <input class="buttony" type="submit" name="search" value="">
                            <img class="buttonyx" src="../picturesMusic/search.png" height="20px" width="20px" alt="" />

                        </div> <!-- searchy -->

                        <div class="menuy">
                            <a href="../AA_Perfils/perfilLocal.php" title="Perfil"><img class="imgy" src="../picturesMusic/man.png" alt="" height="24px" width="24px"/></a>
                            <a href="../logOut.php" title="Log Out"><img class="imgy" src="../picturesMusic/logout.png" alt="" height="24px" width="24px"/></a>
                        </div> <!-- menuy -->

                    </div> <!-- divy -->

                </div> <!-- navy -->
                <?php
                // if isset para formularios actualizados
                if (isset($_POST['darBaja'])) {
                    $idCo = $_POST['bajaCo'];
                    if (deleteConcierto($idCo)) {
                        echo "<script> alert('Borrado Concierto'); </script>";
                        header("Location: ../AA_Homes/menuLocal.php");
                        ob_end_flush();
                    } else {
                        echo "<script> alert('Error al Eliminar'); </script>";
                    }
                }
                if (isset($_POST['aceptarMusico'])) {
                    $idCo = $_POST['idCo'];
                    $idMusico = $_POST['idMusico'];

                    $insertConAceptado = updateAceptado($idCo, $idMusico);
                }
                if (isset($_POST['rechazarMusico'])) {
                    $idCO = $_POST['idCo'];
                    $idMusico = $_POST['idMusico'];
                    echo "<script> alert('Musico Rechazado'); </script>";
                    $rechazoMusico = rechazoMusico($idCO, $idMusico);
                }
                ?>

                <div class="contenty">

                    <div class="wilkommen"><p>Hello <div class="welcome"><?php echo $userSession; ?></div><br>
                    </div>

                    <div class="viewsy">

                        <div id="altaConcierto">
                            <a href="../AA_AltasBajas/ConciertoAlta.php" title="conciertoAlta">Dar de alta Concierto</a>
                        </div>

                        <div class="verConciertoPendientes">

                            <h2>Conciertos Pendientes</h2>

                            <?php
                            $concierto = selectConciertoPendientes($idSession);
                            echo "<table>";
                            echo "<tr>";
                            echo "<th class='tableTitle'>Nº concierto</th><th class='tableTitle'>Fecha</th><th class='tableTitle'>Hora</th><th class='tableTitle'>Pago</th><th class='tableTitle'>Genero de Musica</th><th class='tableTitle'>Estado</th>";
                            while ($fila = mysqli_fetch_array($concierto)) {
                                echo "<tr>";
                                extract($fila);
                                echo "<td>$idConcierto</td><td>$fecha_concierto</td><td>$hora</td><td>$pago</td><td>$gen</td><td>pendiente</td><td>";
                                ?> 
                                <form method="POST">
                                    <input class="upDownBut" type="hidden" name="bajaCo" value="<?php echo $idConcierto ?>">
                                    <input class="upDownBut" type="submit" name="darBaja" value="darBaja">  
                                </form>
                                <?php
                                echo "</td><td>";
                                ?>
                                <form method="POST">
                                    <input class="upDownBut" type="hidden" name="verMusicosCO" value="<?php echo $idConcierto ?>">
                                    <input class="upDownBut" type="submit" name="verMusicos" value="verMusicos">
                                </form>
                                <?php
                                echo "</tr>";
                            }
                            echo "</td>";
                            echo "</tr>";
                            echo "</table>";
                            ?>
                        </div><!--verConciertosPendientes-->

                        <?php
                        if (isset($_POST['verMusicos'])) {
                            $idCO = $_POST['verMusicosCO'];

                            $musicosC = selectMusicoConcierto($idCO);

                            $valid = selectMusicosAltaConciertos($idCO);
                            if ($valid) {
                                echo "<table>";
                                echo "<tr>";
                                echo "<th  class='tableTitle'>Nombre Artistico</th><th  class='tableTitle'>Web</th>";
                                while ($fila = mysqli_fetch_array($musicosC)) {
                                    echo "<tr>";
                                    extract($fila);
                                    echo "<td>$nombreArtistico</td><td>$web</td><td>";
                                    ?>
                                    <form method="POST">
                                        <input type="hidden" name="idMusico" value="<?php echo $userMusico ?>">
                                        <input type="hidden" name="idCo" value="<?php echo $idConcierto ?>">
                                        <input type="submit" name="aceptarMusico" value="Aceptar">  
                                    </form>
                                    <?php
                                    echo "</td><td>";
                                    ?>
                                    <form method="POST">
                                        <input type="hidden" name="idMusico" value="<?php echo $userMusico ?>">
                                        <input type="hidden" name="idCo" value="<?php echo $idConcierto ?>">
                                        <input type="submit" name="rechazarMusico" value="Rechazar">  
                                    </form>
                                    <?php
                                    echo "</td>";
                                }
                                echo "</tr>";
                                echo "</table>";
                            } else {
                                echo "<script> alert('No Hay Musicos en Este Concierto'); </script>";
                            }
                        }
                        ?>
                        <div class="verConciertoAceptados">

                            <h2>Conciertos Aceptados</h2>
                            <?php
                            $concierto1 = selectConciertoAceptados($idSession);
                            echo "<table>";
                            echo "<tr>";
                            echo "<th class='tableTitle'>Nº Concierto</th><th class='tableTitle'>Fecha</th><th class='tableTitle'>Hora</th><th class='tableTitle'>Pago</th><th class='tableTitle'>Musico</th><th class='tableTitle'>Genero</th><th class='tableTitle'>Estado</th>";
                            while ($fila = mysqli_fetch_array($concierto1)) {
                                echo "<tr>";
                                extract($fila);
                                echo "<td>$idConcierto</td><td>$fecha_concierto</td><td>$hora</td><td>$pago</td><td>$nombreArtistico</td><td>$gen</td><td>aceptado</td>";
                            }
                            echo "</tr>";
                            echo "</table>";
                            ?>
                        </div>

                    </div> <!-- viewsy -->

                </div> <!-- contenty -->

            </div> <!-- fview -->
            <?php
        } else {
            echo 'No eres un Local! No puedes ver esta paguina!';
        }
        ?>
    </body>
</html>
