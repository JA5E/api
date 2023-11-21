<?php
define("DB_ENCODE", "utf8");
// Definimos una constante como nombre del proyecto
define("PRO_NOMBRE", "cc");
// Datos de producción, descomentar para pasar
define("DB_HOST", "localhost");
// Nombre de la base de datos
define("DB_NAME", "mortalidad");
// Usuario de la base de datos
define("DB_USERNAME", "root");
// Contraseña del usuario de la base de datos
define("DB_PASSWORD", "");

// Conexión a la database utilizando mysqli
$conexion = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
// Comprobar si la conexión a la base de datos tuvo errores
if ($conexion->connect_error) {
    die("Falló conexión a la base de datos: " . $conexion->connect_error);
}

?>