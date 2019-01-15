<?php

/* SELECT para ver cosas */

function selectConcierto($userL) {
    $c = conectar();
    $select = "SELECT idConcierto FROM concierto WHERE userLocal = '$userL'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

/* funciones insert en Altas */

function insertConcierto($userLocal, $hora, $fecha, $genero, $pago) {
    $c = conectar();
    $insert = "insert into concierto (userLocal, hora, fecha_concierto, pago, estado, genero)"
            . "values ($userLocal, '$hora', '$fecha', $pago, 0, $genero);";
    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}
