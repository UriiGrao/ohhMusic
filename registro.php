<!DOCTYPE html>

<?php
session_start();
ob_start();
require_once './bbdd.php'
?>
<html id="html">
    <head>
        <meta charset="UTF-8">
        <link rel="shprtcut icon" href="picturesMusic/iconx24.png"/>

        <script src="PlugIn's/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="PlugIn's/jquery-validation-1.17.0/dist/jquery.validate.min.js" type="text/javascript"></script>
        <script src="PlugIn's/jquery-validation-1.17.0/dist/additional-methods.min.js" type="text/javascript"></script>

        <script src="PlugIn's/slick-1.8.0/slick/slick.min.js" type="text/javascript"></script>
        <link href="PlugIn's/slick-1.8.0/slick/slick.css" rel="stylesheet" type="text/css"/>
        <link href="slick/slick-theme.css" rel="stylesheet" type="text/css"/>

        <link href="style.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Quicksand|Rozha+One" rel="stylesheet">  
        <script src="funciones.js" type="text/javascript"></script>
        <title>Ohh Music</title>
    </head>

    <body>

        <div class="fview">

            <div id="content">

                <div id="pub">
                    <img src="picturesMusic/sample.png" alt=""/>
                    <div id="your-class">
                        <div><img src="picturesMusic/iniBig2.png" alt="" width="246px" height="434px"/></div>
                        <div><img src="picturesMusic/iniBig3.png" alt="" width="246px" height="434px"/></div>
                        <div><img src="picturesMusic/iniBig.png" alt="" width="246px" height="434px"/></div>
                    </div> 
                    <div id="imgini">
                        <img src="picturesMusic/iniSmall.png" alt=""/>
                    </div>
                </div> <!-- pub -->

                <div id="log">

                    <div class="divForm">

                        <h1 class="h11" >Ohh Music</h1>
                        <h2 id="h21">Únete hoy a Ohh Music</h2>

                        <div id="regis">

                            <form id="form1" action="" method="post">

                                <div id="fff">
                                    <input placeholder="Nombre" type="text" name="name" id="nameR" ><br>
                                    <input placeholder="Apellidos" type="text" name="surname" id="surnameR"><br>
                                    <input placeholder="Nombre de usuario" type="text" name="username" id="usernameR"><br>
                                    <input placeholder="Contraseña" type="password" name="code" id="passwordR"><br>
                                    <input placeholder="Confirma tu contraseña" type="password" name="surecode" id="passwordR2"><br>
                                    <input placeholder="E-Mail" type="mail" name="mail" value="" id="mailR"><br>
                                    <input placeholder="Telefono" type="tel" name="phone" id="phoneR"><br>
                                    Ciudad: <select name="provincia">
                                        <?php
                                        $provincia = selectProvinciaReal(); /* Tindria Que Anar Ciutat */
                                        while ($option1 = mysqli_fetch_assoc($provincia)) {
                                            echo "<option value='" . $option1['idciudad'] . "'>" . utf8_encode($option1['ciudad']) . "</option>";
                                        }
                                        ?>
                                    </select><br>
                                    ¿Que tipo de usuario seras?
                                    <select id="tipoU" name="type" required>
                                        <option value="3">Fan</option>
                                        <option value="1">Musico</option>
                                        <option value="2">Local</option>
                                    </select><br>

                                    <input id="buttonIni1" type="button" name="registro1" value="Siguiente paso" required><br>

                                </div> <!--fff-->


                                <div id="formFan">
                                    <p>Genero *</p>
                                    <select class="sex" name="sex" >
                                        <option value="m">Hombre</option>
                                        <option value="w">Mujer</option>
                                        <option value="o">Otro</option>
                                    </select><br>
                                    <p>Fecha de nacimiento *</p>
                                    <input type="date" name="bday" value=""><br>

                                </div>  <!-- formFan -->

                                <div id="formMusico">

                                    <p>El ultimo paso</p>

                                    Genero de Musica: <select name="genM" >
                                        <?php
                                        $genero = selectGenero();
                                        while ($option1 = mysqli_fetch_assoc($genero)) {
                                            echo "<option>" . $option1['nombre'] . "</option>";
                                        }
                                        ?>
                                    </select><br>
                                    <input placeholder="Nombre Artistico *" type="text" name="nomArtM"><br>
                                    <input placeholder="Pagina Web *" type="text" name="webM" value=""><br>
                                    <input placeholder="Nº de componentes *" type="number" name="compM"><br>                                  
                                </div> <!-- formMusico -->

                                <div id="formLocal">

                                    <input placeholder="Aforo *" type="number" name="aforoL"><br>
                                    <input placeholder="Direccion del local *" type="text" name="dirL"><br>

                                </div> <!-- formLocal -->

                                <input id="buttonIni3" type="submit" name="registro3" value="Registrar">
                            </form> <!--form1-->

                            <?php
                            if (isset($_POST['registro3'])) {
                                $name = $_POST['name'];
                                $surname = $_POST['surname'];
                                $user = $_POST['username'];
                                $code = $_POST['code'];
                                $surecode = $_POST['surecode'];
                                $mail = $_POST['mail'];
                                $phone = $_POST['phone'];
                                $city = $_POST['provincia'];
                                $type = $_POST['type'];

                                if ($type == 3) {
                                    $genero = $_POST['sex'];
                                    $fechaNacimiento = $_POST['bday'];

                                    if (!selectUser($user)) {
                                        if ($code != $surecode) {
                                            echo "<script> alert('Contraseña Diferente'); </script>";
                                        } else {
                                            $insertUser = insertUserFan($name, $surname, $user, $code, $city, $phone, $mail, $type, $fechaNacimiento, $genero);
                                            if ($insertUser == "ok") {
                                                echo "<script> alert('Registrado Correctamente'); </script>";
                                            } else {
                                                echo "<script> alert('$insertUser'); </script>";
                                            }
                                        }
                                    } else {
                                        echo "<script> alert('Usuario Ya Registrado'); </script>";
                                    }
                                } elseif ($type == 1) {
                                    $genM = $_POST['genM'];
                                    $idGenM = selectIdGenero($genM);
                                    $nomArtM = $_POST['nomArtM'];
                                    $webM = $_POST['webM'];
                                    $compM = $_POST['compM'];
                                    if (!selectUser($user)) {
                                        if ($code != $surecode) {
                                            echo "<script> alert('Contraseña Diferente'); </script>";
                                        } else {
                                            $insertUser = insertUserMusico($name, $surname, $user, $code, $city, $phone, $mail, $type, $idGenM, $nomArtM, $webM, $compM);
                                            $insertUser;
                                            if ($insertUser == "ok") {
                                                echo "<script> alert('Registrado Correctamente'); </script>";
                                            } else {
                                                echo "<script> alert('$insertUser'); </script>";
                                            }
                                        }
                                    } else {
                                        echo "<script> alert('Usuario Ya Registrado'); </script>";
                                    }
                                } elseif ($type == 2) {
                                    $aforoL = $_POST['aforoL'];
                                    $dirL = $_POST['dirL'];
                                    if (!selectUser($user)) {
                                        if ($code != $surecode) {
                                            echo "<script> alert('Contraseña Diferente'); </script>";
                                        } else {
                                            $insertUser = insertUserLocal($name, $surname, $user, $code, $city, $phone, $mail, $type, $aforoL, $dirL);
                                            if ($insertUser == "ok") {
                                                echo "<script> alert('Registrado Correctamente'); </script>";
                                            } else {
                                                echo "<script> alert('$insertUser'); </script>";
                                            }
                                        }
                                    } else {
                                        echo "<script> alert('Usuario Ya Registrado'); </script>";
                                    }
                                }
                            }
                            ?>

                        </div> <!-- regis-->

                        <div id="logy">

                            <form method="POST">
                                <input placeholder="Nombre de usuario" type="text" name="user" value="" required><br>
                                <input placeholder="Password" type="password" name="pass" value="" required><br>

                                <input id="buttonIni2" type="submit" name="registro" value="Entrar"><br>
                                1234

                            </form>

                        </div> <!-- logy -->

                        <?php
                        if (isset($_POST['registro'])) {
                            $user = $_POST['user'];
                            $pass = $_POST['pass'];


                            if (validarUser($user, $pass)) {
                                echo "Has entrat be!";
                                $tipo = selectTipoValidar($user);
                                if ($tipo == 3) {
                                    $_SESSION["user"] = $user;
                                    $_SESSION["tipo"] = $tipo;
                                    $idSession = selectIdUsuario($user);
                                    $_SESSION["idUsuario"] = $idSession;
                                    header("Location: AA_Homes/menuFan.php");
                                    ob_end_flush();
                                } else if ($tipo == 1) {
                                    $_SESSION["user"] = $user;
                                    $_SESSION["tipo"] = $tipo;
                                    $idSession = selectIdUsuario($user);
                                    $_SESSION["idUsuario"] = $idSession;
                                    header("Location: AA_Homes/menuMusico.php");
                                    ob_end_flush();
                                } else if ($tipo == 2) {
                                    $_SESSION["user"] = $user;
                                    $_SESSION["tipo"] = $tipo;
                                    $idSession = selectIdUsuario($user);
                                    $_SESSION["idUsuario"] = $idSession;
                                    header("Location: AA_Homes/menuLocal.php");
                                    ob_end_flush();
                                }
                            } else {
                                echo "<script> alert('Usuario O Contraseña Erroneo'); </script>";
                            }
                        }
                        ?>

                    </div> <!-- divForm -->

                    <div id="divForm2">
                        ¿Tienes una cuenta? <a class="butt" onclick="funcHideRegis()">Entrar</a><br>

                    </div> <!-- divForm2 -->

                    <div id="divForm3" >
                        ¿No tienes cuenta? <a class="butt" onclick="funcHideRegis()">Registrate</a><br>

                    </div> <!-- divForm3 -->

                </div> <!-- log -->

                <div id="footer"></div> <!-- footer -->

            </div>  <!--content-->

        </div> <!-- fview -->

    </body>

</html>
