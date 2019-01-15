<?php

function selectMusicosAltaConciertos($Con) {
    $c = conectar();
    $select = "SELECT * FROM musico INNER JOIN conciertomusico ON musico.userMusico = conciertomusico.userMusico 
        INNER JOIN genero ON musico.genero = genero.idgenero WHERE idConcierto = $Con AND estado = 0;";
    $resultado = mysqli_query($c, $select);
    $filas = mysqli_num_rows($resultado);
    if ($filas != 0) {
        $result = true;
    } else {
        $result = false;
    }
    desconectar($c);
    return $result;
}

function totalMusicos($gen) {
    $c = conectar();
     $select = "SELECT count(*) AS cantidad FROM musico INNER JOIN genero ON genero.idGenero = musico.genero WHERE genero.nombre = '$gen'";
    $result = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($result);
    desconectar($c);
    return $fila["cantidad"];
}

function totalConciertos() {
    $c = conectar();
    $select = "select count(*) as cantidad from concierto WHERE estado = 1 AND fecha_Concierto > CURDATE()";
    $result = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($result);
    desconectar($c);
    return $fila["cantidad"];
}

// borrar apuntar voto 
function borrarFanCon($idFAN, $idCon) {
    $c = conectar();
    $delete = "DELETE FROM fanconcierto WHERE userFan = $idFAN AND idConcierto = $idCon";
    $resultado = mysqli_query($c, $delete);
    desconectar($c);
    return $resultado;
}

function insertFanCon($idFan, $idCon) {
    $c = conectar();
    $insert = "INSERT INTO fanconcierto "
            . "VALUES ($idCon, $idFan)";
    if (mysqli_query($c, $insert)) {
        $resultado = true;
    } else {
        $resultado = false;
    }
    desconectar($c);
    return $resultado;
}

function tablaFanCon($idFan, $idCon) {
    $c = conectar();
    $select = "SELECT * FROM fanconcierto WHERE userFan = $idFan AND idConcierto = $idCon";
    $resultado = mysqli_query($c, $select);
    $filas = mysqli_num_rows($resultado);
    if ($filas != 0) {
        $result = true;
    } else {
        $result = false;
    }
    desconectar($c);
    return $result;
}

function selectTablaFanCon($inicio, $cantidad) {
    $c = conectar();
    $select = "SELECT * from concierto INNER JOIN genero ON concierto.genero = genero.idGenero INNER JOIN musico ON concierto.idMusico = musico.userMusico "
            . "WHERE estado = 1 AND fecha_Concierto > CURDATE() ORDER BY fecha_concierto, hora LIMIT $inicio, $cantidad";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function borrarFanMusico($idFAN, $idMU) {
    $c = conectar();
    $delete = "DELETE FROM fanmusico WHERE userFan = $idFAN AND userMusico = $idMU";
    $resultado = mysqli_query($c, $delete);
    desconectar($c);
    return $resultado;
}

function selectTablaFanMu($idFan, $idMU) {
    $c = conectar();
    $select = "SELECT * FROM fanmusico WHERE userFan = $idFan AND userMusico = $idMU";
    $resultado = mysqli_query($c, $select);
    $filas = mysqli_num_rows($resultado);
    if ($filas != 0) {
        $result = true;
    } else {
        $result = false;
    }
    desconectar($c);
    return $result;
}

function insertFanMu($idFan, $idMu) {
    $c = conectar();
    $insert = "INSERT INTO fanmusico "
            . "VALUES ($idMu, $idFan)";
    if (mysqli_query($c, $insert)) {
        $resultado = true;
    } else {
        $resultado = false;
    }
    echo mysqli_error($c);
    desconectar($c);
    return $resultado;
}

function selectMusicoGeneroVotar($gen) {
    $c = conectar();
    $select = "SELECT * FROM musico INNER JOIN genero ON genero.idGenero = musico.genero WHERE genero.nombre = '$gen'";
    $resultado = mysqli_query($c, $select);
    $filas = mysqli_num_rows($resultado);
    if ($filas != 0) {
        $result = true;
    } else {
        $result = false;
    }
    desconectar($c);
    return $result;
}

function verMusicos($gen, $inicio, $cantidad ) {
    $c = conectar();
    $select = "SELECT * FROM musico INNER JOIN genero ON genero.idGenero = musico.genero WHERE genero.nombre = '$gen' LIMIT $inicio, $cantidad";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selectGenMusic() {
    $c = conectar();
    $select = "SELECT nombre FROM genero";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

/* SELECT ver conciertos aceptados / denegados */

function selConciertosDenegados($idMU) {
    $c = conectar();
    $select = "SELECT * FROM conciertomusico INNER JOIN concierto ON conciertomusico.idConcierto = concierto.idConcierto "
            . "WHERE userMusico = $idMU AND conciertomusico.estado = 2;";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selConciertosAceptados($idMU) {
    $c = conectar();
    $select = "SELECT * FROM concierto INNER JOIN locales ON concierto.userLocal = locales.userLocal WHERE idMusico = $idMU AND estado = 1";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

/* inserts selects drops de concierto musico aceptados rechazados etc.. */

function rechazoMusico($idCon, $idMus) {
    $c = conectar();
    $update = "UPDATE conciertomusico SET estado = 2 WHERE idConcierto = $idCon and userMusico = $idMus";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

function updateAceptado($idCO, $idMU) {
    $c = conectar();
    $update = "UPDATE conciertomusico SET estado = 1 WHERE idConcierto = '$idCO' and userMusico = '$idMU'";
    if (mysqli_query($c, $update)) {
        $update2 = "UPDATE conciertomusico SET estado = 2 WHERE idConcierto = '$idCO' and userMusico <> '$idMU'";
        if (mysqli_query($c, $update2)) {
            $update3 = "UPDATE concierto SET idMusico = $idMU, estado = 1 WHERE idConcierto = $idCO";
            if (mysqli_query($c, $update3)) {
                $resultado = "ok";
            } else {
                $resultado = mysqli_error($c);
            }
        } else {
            $resultado = mysqli_error($c);
        }
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

/* SELECT para ver musicos apuntados */

function selectMusicoConcierto($idCO) {
    $c = conectar();
    $select = "SELECT * FROM conciertomusico INNER JOIN musico ON conciertomusico.userMusico = musico.userMusico  AND estado <> 2 "
            . "WHERE idConcierto = '$idCO'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

/* Selects para apuntar desapuntar */

function borrarMusicocon($idCO, $idMU) {
    $c = conectar();
    $delete = "DELETE FROM conciertomusico WHERE idConcierto = $idCO AND userMusico = $idMU";
    $resultado = mysqli_query($c, $delete);
    desconectar($c);
    return $resultado;
}

function selectTablaMuCo1($idCO, $idMU) {
    $c = conectar();
    $select = "SELECT * FROM conciertomusico WHERE idConcierto = $idCO AND usermusico = $idMU AND estado <> 0";
    $resultado = mysqli_query($c, $select);
    $filas = mysqli_num_rows($resultado);
    if ($filas != 0) {
        $result = true;
    } else {
        $result = false;
    }
    desconectar($c);
    return $result;
}

function selectTablaMuCo($idCO, $idMU) {
    $c = conectar();
    $select = "SELECT * FROM conciertomusico WHERE idConcierto = $idCO AND usermusico = $idMU AND estado = 0";
    $resultado = mysqli_query($c, $select);
    $filas = mysqli_num_rows($resultado);
    if ($filas != 0) {
        $result = true;
    } else {
        $result = false;
    }
    desconectar($c);
    return $result;
}

/* Insert de Musico En tabla ConciertoMusico */

function insertMusicocon($idCO, $idMu) {
    $c = conectar();
    $insert = "INSERT INTO conciertomusico "
            . "VALUES ($idCO, $idMu, 0)";
    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

/* DAR DE BAJA */

function deleteConcierto($idCo) {
    $c = conectar();
    $delete = "DELETE FROM concierto WHERE idConcierto = '$idCo'";
    $resultado = mysqli_query($c, $delete);
    desconectar($c);
    return $resultado;
}

/* Selects de Genero para la tabla de Musico */

function selectConciertoMusicos($genM) {
    $c = conectar();
    $select = "SELECT idConcierto FROM concierto WHERE genero = '$genM'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selectConciertosPGenero($genUser) {
    $c = conectar();
    $select = "SELECT idConcierto, locales.direccion, fecha_concierto, hora, pago, estado "
            . "FROM concierto INNER JOIN locales ON concierto.userLocal = locales.userLocal "
            . "WHERE  genero = '$genUser' AND estado = 0 AND fecha_concierto > CURDATE() "
            . "ORDER BY fecha_concierto, hora;";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selectGeneroMusico($idMusico) {
    $c = conectar();
    $select = "SELECT genero FROM musico WHERE userMusico = '$idMusico'";
    $resultado = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    desconectar($c);
    return $genero;
}

/* SELECTS DE CONCIERTOS ACEPTADOS / PENDIENTES */

function selectConciertoAceptados($user) {
    $c = conectar();
    $select = "SELECT idConcierto, fecha_concierto, hora, pago, nombreArtistico, genero.nombre as gen, estado "
            . "FROM concierto INNER JOIN genero ON concierto.genero = genero.idGenero INNER JOIN musico ON concierto.idMusico = musico.userMusico "
            . "WHERE userLocal = '$user' AND estado = 1 AND fecha_concierto > CURDATE() "
            . "ORDER BY fecha_concierto";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selectConciertoPendientes($user) {
    $c = conectar();
    $select = "SELECT idConcierto, fecha_concierto, hora, pago, idMusico, genero.nombre as gen, estado "
            . "FROM concierto INNER JOIN genero ON concierto.genero = genero.idGenero "
            . "WHERE userLocal = '$user' AND estado = 0 AND fecha_concierto > CURDATE() "
            . "ORDER BY fecha_concierto";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}
