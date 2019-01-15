<?php

/* Funciones de Select para mostrar en formularios */

function selectIdUsuario($user) {
    $c = conectar();
    $select = "SELECT idUsuario FROM usuario WHERE nombreUsuario = '$user'";
    $resultado = mysqli_query($c, $select);
    mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    desconectar($c);
    return $idUsuario;
}

function selectIdGenero($genM) {
    $c = conectar();
    $select = "SELECT idGenero FROM genero WHERE nombre = '$genM'";
    $resultado = mysqli_query($c, $select);
    mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    desconectar($c);
    return $idGenero;
}

function selectIdCiudad($city) {
    $c = conectar();
    $select = "SELECT idciudad FROM ciudad WHERE ciudad LIKE '%$city%'";
    $resultado = mysqli_query($c, $select);
    mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    desconectar($c);
    return $idciudad;
}

function selectTipoValidar($user) {
    $c = conectar();
    $select = "SELECT tipo FROM usuario WHERE nombreUsuario = '$user'";
    $resultado = mysqli_query($c, $select);
    mysqli_query($c, $select);
    $fila = mysqli_fetch_assoc($resultado);
    extract($fila);
    desconectar($c);
    return $tipo;
}

function selectProvinciaReal() {
    $c = conectar();
    $select = "SELECT * FROM ciudad WHERE provincia LIKE '% Barcelona %'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

function selectGenero() {
    $c = conectar();
    $select = "SELECT * FROM genero";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    return $resultado;
}

/* Funcion validar usuario */

function validarUser($user, $pass) {
    $c = conectar();
    $select = "SELECT password FROM usuario WHERE nombreUsuario = '$user'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    if (mysqli_num_rows($resultado) == 1) {
        $passcif = mysqli_fetch_assoc($resultado);
        extract($passcif);
        return password_verify($pass, $password);
    } else {
        return false;
    }
}

function selectUser($user) {
    $c = conectar();
    $select = "SELECT nombreUsuario FROM usuario WHERE nombreUsuario = '$user'";
    $resultado = mysqli_query($c, $select);
    desconectar($c);
    if (mysqli_num_rows($resultado) == 1) {
        return true;
    } else {
        return false;
    }
}

/* Funciones de Inserts. */

function insertUserLocal($name, $surname, $user, $code, $city, $phone, $mail, $type, $aforoL, $dirL) {
    $passcif = password_hash($code, PASSWORD_DEFAULT);
    $c = conectar();
    $insert = "insert into usuario(nombreUsuario, password, nombre, apellidos, email, telf, ciudad, tipo) "
            . "values ('$user', '$passcif', '$name', '$surname', '$mail', '$phone', '$city', $type);";
    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
        $id = mysqli_insert_id($c);
        if ($type == 2) {
            $instertLocal = "insert into locales(userLocal, aforo, direccion)"
                    . "values('$id', '$aforoL', '$dirL')";
            if (mysqli_query($c, $instertLocal)) {
                $resultado = 'ok';
            } else {
                $resultado = mysqli_error($c);
            }
        }
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

function insertUserMusico($name, $surname, $user, $code, $city, $phone, $mail, $type, $genM, $nomArtM, $webM, $compM) {
    $passcif = password_hash($code, PASSWORD_DEFAULT);
    $c = conectar();
    $insert = "insert into usuario(nombreUsuario, password, nombre, apellidos, email, telf, ciudad, tipo) "
            . "values ('$user', '$passcif', '$name', '$surname', '$mail', '$phone', '$city', $type);";
    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
        $id = mysqli_insert_id($c);
        if ($type == 1) {
            $insertMusico = "insert into musico(userMusico, genero, nombreArtistico, web, num_componentes)"
                    . "values ('$id', '$genM', '$nomArtM', '$webM', '$compM')";
            if (mysqli_query($c, $insertMusico)) {
                $resultado = 'ok';
            } else {
                $resultado = mysqli_error($c);
            }
        } else {
            $resultado = mysqli_error($c);
        }
    }
    desconectar($c);
    return $resultado;
}

function insertUserFan($name, $surname, $user, $code, $city, $phone, $mail, $type, $fechaNacimiento, $genero) {
    $passcif = password_hash($code, PASSWORD_DEFAULT);
    $c = conectar();
    $insert = "insert into usuario(nombreUsuario, password, nombre, apellidos, email, telf, ciudad, tipo) "
            . "values ('$user', '$passcif', '$name', '$surname', '$mail', '$phone', '$city', $type);";
    if (mysqli_query($c, $insert)) {
        $resultado = "ok";
        $id = mysqli_insert_id($c);
        if ($type == 3) {
            $insertFan = "insert into fan(userFan, sexo, nacimiento)"
                    . "values ('$id', '$genero', '$fechaNacimiento' )";
            if (mysqli_query($c, $insertFan)) {
                $resultado = 'ok';
            } else {
                $resultado = mysqli_error($c);
            }
        }
    } else {
        $resultado = mysqli_error($c);
    }
    desconectar($c);
    return $resultado;
}

/* Funciones de conexión y desconexión a la BBDD */

function desconectar($conexion) {
    mysqli_close($conexion);
}

function conectar() {
    $conexion = mysqli_connect("localhost", "root", "", "daw1mgrupo1");
    if (!$conexion) {
        die("No se ha podido establecer la conexión con el servidor");
    }
    return $conexion;
}
