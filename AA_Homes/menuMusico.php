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
      <title>Musico | Ohh Music</title>
      <link href="https://fonts.googleapis.com/css?family=Pacifico|Quicksand|Rozha+One" rel="stylesheet">  
      <link href="https://fonts.googleapis.com/css?family=Montserrat:300" rel="stylesheet"> 
      <link href="../style.css" rel="stylesheet" type="text/css"/>
      <link href="menuStyle.css" rel="stylesheet" type="text/css"/>

   </head>

   <body>

      <?php if ($tipoSession == 1) { ?>

         <div class="fview">

            <div class="navy">

               <div class="divy">

                  <div class="headimglog">

                     <a href="menuMusico.php" >
                        <h1 class="h11">Ohh Music</h1>

                     </a>

                  </div>   <!-- headimglog -->

                  <div class="searchy">
                     <input class="searchyx" placeholder="Buscar" type="text" name="search" value="">
                     <input class="buttony" type="submit" name="search" value="">
                     <img class="buttonyx" src="../picturesMusic/search.png" height="20px" width="20px" alt="" />

                  </div> <!-- searchy -->

                  <div class="menuy">
                     <a href="../AA_Perfils/perfilMusico.php" title="Perfil"><img class="imgy" src="../picturesMusic/man.png" alt="" height="24px" width="24px"/></a>
                     <a href="../logOut.php" title="Log Out"><img class="imgy" src="../picturesMusic/logout.png" alt="" height="24px" width="24px"/></a>
                  </div> <!-- menuy -->

               </div> <!-- divy -->

            </div> <!-- navy -->

            <div class="contenty">
               
               <?php
               // if isset.
               if (isset($_POST['desapuntar'])) {
                  $borrarIdCon = $_POST['borrarMusico'];

                  $borrarMusCon = borrarMusicocon($borrarIdCon, $idSession);

                  if ($borrarMusCon) {
                     echo "<script> alert('Borrado del Concierto Correctamente'); </script>";
                  } else {
                     echo "<script> alert('Error al Borrar del Concierto'); </script>";
                  }
               }
               if (isset($_POST['apuntar'])) {
                  $apuntarMusico = $_POST['apuntarMusico'];

                  $insertMuCo = insertMusicocon($apuntarMusico, $idSession);

                  if ($insertMuCo == "ok") {
                     echo "<script> alert('Registro al Concierto Correctamente'); </script>";
                  } else {
                     echo "<script> alert('Error del Registro al Concierto'); </script>";
                  }
               }
               ?>
               
               <div class="wilkommen"><p>Hello <div class="welcome"><?php echo $userSession; ?></div><br>
               </div>

               <div class="viewsy">

                  <div class="conciertosP">
                     
                     <h2>Conciertos Pendientes</h2>

                     <?php
                     $tablaConMusico = selectConciertosPGenero(selectGeneroMusico($idSession));
                     echo "<table>";
                     echo "<tr>";
                     echo "<th class='tableTitle'>Direccion</th><th class='tableTitle'>Fecha</th><th class='tableTitle'>Hora</th><th class='tableTitle'>Pago</th><th class='tableTitle'>Estado del concierto</th>";
                     while ($fila = mysqli_fetch_array($tablaConMusico)) {
                        echo "<tr>";
                        extract($fila);
                        echo "<td>$direccion</td><td>$fecha_concierto</td><td>$hora</td><td>$pago</td><td>Pendiente</td><td>";
                        $tablaMuCo = selectTablaMuCo($idConcierto, $idSession);
                        $tablaMuCo1 = selectTablaMuCo1($idConcierto, $idSession);
                        if ($tablaMuCo) {
                           ?> 
                           <form method="POST">
                              <input type="hidden" name="borrarMusico" value="<?php echo $idConcierto ?>">
                              <input type="submit" name="desapuntar" value="desapuntar">  
                           </form> 
                           <?php
                        } else if (!$tablaMuCo1) {
                           ?>
                           <form method="POST">
                              <input type="hidden" name="apuntarMusico" value="<?php echo $idConcierto ?>">
                              <input type="submit" name="apuntar" value="apuntar">  
                           </form>
                           <?php
                        }
                        echo "</td>";
                        echo "</tr>";
                     }
                     echo "</tr>";
                     echo "</table>";
                     ?>
                  </div> <!-- ConciertosP -->
                  
                  <div class="conciertosA">
                     
                     <h2>Conciertos Aceptados</h2>
                     <?php
                     $selectConAcep = selConciertosAceptados($idSession);
                     echo "<table>";
                     echo "<tr>";
                     echo "<th class='tableTitle'>Direccion</th><th class='tableTitle'>Fecha</th><th class='tableTitle'>Hora</th><th class='tableTitle'>Estado del concierto</th>";
                     while ($fila = mysqli_fetch_array($selectConAcep)) {
                        echo "<tr>";
                        extract($fila);
                        echo "<td>$direccion</td><td>$fecha_concierto</td><td>$hora</td><td>Aceptado</td>";
                     }
                     echo "</tr>";
                     echo "</table>";
                     ?>
                  </div> <!--conciertosA-->
                  
                  <div id="verConciertoDenegados">

                     <h2>Conciertos Denegados</h2>
                     <?php
                     $concierto1 = selConciertosDenegados($idSession);
                     echo "<table>";
                     echo "<tr>";
                     echo "<th class='tableTitle'>Concierto nº</th><th class='tableTitle'>Fecha</th><th class='tableTitle'>Hora</th><th class='tableTitle'>Estado del concierto</th>";
                     while ($fila = mysqli_fetch_array($concierto1)) {
                        echo "<tr>";
                        extract($fila);

                        echo "<td>$idConcierto</td><td>$fecha_concierto</td><td>$hora</td><td>rechazado</td>";
                     }
                     echo "</tr>";
                     echo "</table>";
                     ?>
                  </div> <!--verConciertosDenegados-->
                  
               </div> <!-- viewsy -->

            </div> <!-- contenty -->

         </div> <!-- fview -->

         <?php
      } else {
         echo 'No eres un musico! No puedes ver esta paguina!';
      }
      ?>

   </body>
   
</html>

