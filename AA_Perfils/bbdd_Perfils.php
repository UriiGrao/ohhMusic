<?php

/* 1r las funciones para ver datos. */

function selectfechaT($user) {
   $c = conectar();
   $select = "SELECT nacimiento FROM fan WHERE userFan = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $nacimiento;
}

function selectGeneroT($user) {
   $c = conectar();
   $select = "SELECT sexo FROM fan WHERE userFan = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $sexo;
}

function selectId($user) {
   $c = conectar();
   $select = "SELECT idUsuario FROM usuario WHERE nombreUsuario = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $idUsuario;
}

function selectCiudadTotal($city) {
   $c = conectar();
   $select = "SELECT ciudad FROM ciudad WHERE idCiudad = '$city'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $ciudad;
}

function selectCiudadS($user) {
   $c = conectar();
   $select = "SELECT ciudad FROM usuario WHERE nombreUsuario = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $ciudad;
}

function selectApellidoS($user) {
   $c = conectar();
   $select = "SELECT apellidos FROM usuario WHERE nombreUsuario = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $apellidos;
}

function selectNombreS($user) {
   $c = conectar();
   $select = "SELECT nombre FROM usuario WHERE nombreUsuario = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $nombre;
}

function selectTelfS($user) {
   $c = conectar();
   $select = "SELECT telf FROM usuario WHERE nombreUsuario = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $telf;
}

function selectEmailS($user) {
   $c = conectar();
   $select = "SELECT email FROM usuario WHERE nombreUsuario = '$user'";
   $resultado = mysqli_query($c, $select);
   mysqli_query($c, $select);
   $fila = mysqli_fetch_assoc($resultado);
   extract($fila);
   desconectar($c);
   return $email;
}




/* Modificar datos Perfiles */

function updateNombre($user,$newdata){
    $c = conectar();
    $update = "UPDATE usuario SET nombre='$newdata' WHERE nombreUsuario='$user';";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}


function updateSurname($user,$newdata){
    $c = conectar();
    $update = "UPDATE usuario SET apellidos='$newdata' WHERE nombreUsuario='$user';";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

function updateEmail($user,$newdata){
    $c = conectar();
    $update = "UPDATE usuario SET email='$newdata' WHERE nombreUsuario='$user';";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

function updateTelf($user,$newdata){
    $c = conectar();
    $update = "UPDATE usuario SET telf='$newdata' WHERE nombreUsuario='$user';";
    if (mysqli_query($c, $update)) {
        $resultado = "ok";
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}