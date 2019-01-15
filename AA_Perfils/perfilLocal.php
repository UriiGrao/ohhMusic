<!DOCTYPE html>
<?php
session_start();
require_once '../bbdd.php';
require_once './bbdd_Perfils.php';

$userSession = $_SESSION["user"];
$tipoSession = $_SESSION["tipo"];
?>
<html>

    <head>

        <title>Local | Perfil </title>
        <link rel="shortcut icon" href="../picturesMusic/iconx24.png">
        <link href="../style.css" rel="stylesheet" type="text/css"/>
        <link href="https://fonts.googleapis.com/css?family=Pacifico|Quicksand|Rozha+One" rel="stylesheet">  
        <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet"> 
        <link href="stylePerfil.css" rel="stylesheet" type="text/css"/>
        <script src="../PlugIn's/jquery-3.2.1.js" type="text/javascript"></script>
        <script src="js.js" type="text/javascript"></script>

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

                        </div> <!-- headimglog-->

                        <div class="searchy">

                            <input class="searchyx" placeholder="Buscar" type="text" name="search" value="">
                            <input class="buttony" type="submit" name="search" value="">
                            <img class="buttonyx" src="../picturesMusic/search.png" height="20px" width="20px" alt="" />

                        </div> <!-- searchy -->

                        <div class="menuy">

                            <a href="../AA_Perfils/perfilLocal.php" title="Perfil"><img class="imgy" src="../picturesMusic/man.png" alt="" height="24px" width="24px"/></a>
                            <a href="../logOut.php" title="Log Out"><img class="imgy" src="../picturesMusic/logout.png" alt="" height="24px" width="24px"/></a>

                        </div><!--menuy-->

                    </div> <!-- divy -->

                </div> <!-- navy -->

                <div class="contenty">
                    <?php
                    // if isset para modificar pagina
                    if (isset($_POST['modify'])) {
                        $newName = $_POST['name'];
                        $newSurname = $_POST['surname'];
                        $newEmail = $_POST['email'];
                        $newTelf = $_POST['phone'];

                        $updateName = updateNombre($userSession, $newName);
                        $updateSurname = updateSurname($userSession, $newSurname);
                        $updateMail = updateEmail($userSession, $newEmail);
                        $updateTelf = updateTelf($userSession, $newTelf);
                    }
                    ?>
                    <div class="topPerfil">

                        <div class="imgPerf">

                            <p class="usu"><?php echo " @$userSession"; ?></p>
                            <input type="button" value="Editar Perfil" class="editShow">   

                        </div> <!-- imgPerf -->

                        <div class="modify">
                            <b>Nombre Usuario:</b> <?php echo $userSession; ?> <br>
                            <b>Nombre Completo:</b> 
                            <?php
                            echo selectNombreS($userSession);
                            echo ' ';
                            echo selectApellidoS($userSession);
                            ?> <br>
                            <b>Email:</b> <?php echo selectEmailS($userSession); ?> <br>
                            <b>Ciudad:</b> <?php echo utf8_encode(selectCiudadTotal(selectCiudadS($userSession))); ?><br>
                            <b>Numero telf:</b> <?php echo selectTelfS($userSession); ?> <br>

                        </div><!--modify-->

                    </div> <!--topPerfil-->

                    <?php
                    $nameUser = selectNombreS($userSession);
                    $surnameUser = selectApellidoS($userSession);
                    $mailUser = selectEmailS($userSession);
                    $numberUser = selectTelfS($userSession);
                    ?>

                    <form class="formFanC" action="" method="post">

                        <b>Nombre</b>
                        <input value="<?php echo $nameUser ?>" type="text" name="name" /><br>
                        <b>Apellidos</b>
                        <input value="<?php echo $surnameUser ?>" type="text" name="surname" /><br>
                        <b>Email</b>
                        <input value="<?php echo $mailUser ?>" type="text" name="email" /><br>
                        <b>Telefono</b>
                        <input value="<?php echo $numberUser ?>" type="number" minlength="9" maxlength="9" name="phone" /><br>

                        <img class="imgClose" height="15px" src="../picturesMusic/cancel.png" alt=""/>
                        <input class="doneBut" type="submit" name="modify" value="Hecho">

                    </form> <!--formFanC-->

                </div> <!-- contenty -->

            </div> <!-- fview-->

            <?php
        } else {
            echo 'No eres un Local! No puedes ver esta paguina!';
        }
        ?>

    </body>

</html>
