<?php

session_start();
require_once './bbdd.php';

$userSession = $_SESSION["user"];
$tipoSession = $_SESSION["tipo"];


if ($_SESSION["user"]) {
    session_destroy();
    header("Location: ./index.php");
}