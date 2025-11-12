<?php

//CONEXION CON LA BASE DE DATOS
$host = 'bxyq4uhvbgvqozw4ealz-mysql.services.clever-cloud.com';
$port = 3306;
$user = 'utz1rhbli4bdrjhk';
$password = 'chRcXTSSwugBeeuMfcpg';
$dbname = 'bxyq4uhvbgvqozw4ealz'; // Cambia si tu proveedor indica otro nombre de BD

$conexion = mysqli_connect($host, $user, $password, $dbname, $port);
if (!$conexion) {
    error_log('Error de conexión MySQL: ' . mysqli_connect_error());
    die('Error de conexión a la base de datos.');
}
$conexion->set_charset('utf8');