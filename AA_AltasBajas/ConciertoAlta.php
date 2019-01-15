<!DOCTYPE html>

<?php
session_start();
ob_start();
require_once '../bbdd.php';
require_once './bbdd_altas.php';

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
        <link href="altaStyle.css" rel="stylesheet" type="text/css"/>
        <link href="../AA_Homes/menuStyle.css" rel="stylesheet" type="text/css"/>
    </head>

    <body>

        <?php if ($tipoSession == 2) { ?>

            <div class="fview">

                <div class="navy">

                    <div class="divy">

                        <div class="headimglog">

                            <a href="../AA_Homes/menuLocal.php" >
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
                            <a href="#" title="Settings"><img class="imgy" src="../picturesMusic/settings.png" alt="" height="24px" width="24px"/></a>
                            <a href="../logOut.php" title="Log Out"><img class="imgy" src="../picturesMusic/logout.png" alt="" height="24px" width="24px"/></a>
                        </div> <!-- menuy -->

                    </div> <!-- divy -->

                </div> <!-- navy -->

                <div class="contenty">

                    <div id="registroConcierto">

                        <h2>Dar de alta un concierto</h2>
                        <form id="formConcierto" action="" method="POST">

                            <p>Hora del Concierto: </p><input type="time" name="hora"><br>
                            <p>Fecha del Concierto: </p><input type="date" name="fecha"><br>
                            <p>Genero </p>
                            <select name="gener">
                                <?php
                                $genero = selectGenero();
                                while ($option1 = mysqli_fetch_assoc($genero)) {
                                    echo "<option value='" . $option1['idGenero'] . "'>" . $option1['nombre'] . "</option>";
                                }
                                ?>
                            </select><br>
                            <p> Sueldo del Musico: </p><input type="number" name="pago"><br>
                            <input type="submit" id="registroBut" name="registroConcierto" value="Registrar">
                        </form>

                        <?php
                        if (isset($_POST['registroConcierto'])) {
                            $horaC = $_POST["hora"];
                            $fechaC = $_POST["fecha"];
                            $generoC = $_POST["gener"];
                            $pago = $_POST["pago"];
                            $validFecha = date("Y-m-d");

                            if ($validFecha < $fechaC) {
                                $insertarConcierto = insertConcierto($idSession, $horaC, $fechaC, $generoC, $pago);
                                if ($insertarConcierto == "ok") {
                                    header("Location: ../AA_Homes/menuLocal.php");
                                    ob_end_flush();
                                } else {
                                    echo "$insertarConcierto";
                                }
                            } else {
                                echo "<script> alert('Error al Registrar Concierto Pon Una Fecha Correcta'); </script>";
                            }
                        }
                        ?>
                    </div>
                </div> <!-- contenty -->

            </div> <!-- fview -->

    <?php
} else {
    echo 'No eres un Local! No puedes ver esta paguina!';
}
?>

    </body>

</html>


