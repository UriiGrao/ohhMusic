<?php

function conectar() {
    $conexion = mysqli_connect("localhost", "root", "", "volcado");
    if (!$conexion) {
        die("No se ha podido establecer la conexión con el servidor");
    }
    return $conexion;
}

function conectar2() {
    $conexion = mysqli_connect("localhost", "root", "", "ohhmusic");
    if (!$conexion) {
        die("No se ha podido establecer la conexión con el servidor");
    }
    return $conexion;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}

function selectProvincia($limit) {
    $c = conectar();
    $select = "select provincias.provincia as Provincia, municipios.nombre as Ciudad from municipios inner join provincias on municipios.id_provincia = provincias.id_provincia limit $limit, 1000;";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function volcadoDatos($ciudad, $provincia) {
    $c = conectar2();
    $ciudadOk = mysqli_escape_string($c, $ciudad);
    $provinciaOk = mysqli_escape_string($c, $provincia);
    $insert = "INSERT INTO `ohhmusic`.`ciudad` ( provincia , ciudad ) VALUES (' $provinciaOk ',' $ciudadOk ');";
    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}
