<?php

//función para realizar la conexión a la BBDD
function conectaBBDD(){
    $direccion = 'localhost';
    $usuario_BBDD = "pruebasTEST";
    $password_BBDD = "bYZv6O2UrLlAfynl";
    $nombre_BBDD = "ejemploquiz";
    $puerto = "3306";
    $conexion = new mysqli($direccion, $usuario_BBDD, $password_BBDD, $nombre_BBDD, $puerto);
    $consulta = $conexion -> query("SET NAMES UTF8");
    return $conexion;
}
