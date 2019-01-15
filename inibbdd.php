<?php

function totalConciertos() {
    $c = conectar();
    $select = "select count(*) as cantidad from concierto WHERE estado = 1 AND fecha_Concierto > CURDATE()";
    $result = mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($result);
    desconectar($c);
    return $fila["cantidad"];
}

function listamusico() {
    $c = conectar();
    $select = "SELECT  musico.nombreArtistico, genero.nombre, musico.web, musico.num_componentes, count(fanmusico.userMusico) as voto 
        FROM ((musico INNER JOIN genero ON musico.genero = genero.idGenero) 
        INNER JOIN fanmusico ON musico.userMusico = fanmusico.userMusico) 
        GROUP BY fanmusico.userMusico 
        ORDER BY voto DESC LIMIT 10";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function listalocal() {
    $c = conectar();
    $select = "SELECT ciudad.ciudad, locales.direccion, usuario.telf, usuario.email, locales.aforo FROM ((usuario "
            . "INNER JOIN locales ON usuario.idUsuario = locales.userLocal) INNER JOIN ciudad ON usuario.ciudad = ciudad.idciudad) "
            . "WHERE usuario.tipo = 2 ORDER BY ciudad.ciudad";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selectConciertoAceptadosIndex($inicio, $cantidad) {
    $c = conectar();
    $select = "SELECT * from concierto  INNER JOIN "
            . "locales ON concierto.userLocal = locales.userLocal LEFT JOIN musico ON concierto.idMusico = musico.userMusico "
            . "INNER JOIN genero ON concierto.genero = genero.idgenero WHERE estado = 1 AND fecha_Concierto > CURDATE() ORDER BY fecha_concierto, hora LIMIT $inicio, $cantidad";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}
