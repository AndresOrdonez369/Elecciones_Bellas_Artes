<?php

$server = "localhost";
$user = "root";
$pass = "";
$db ="estudiantes";

$conexion = new mysqli($server,$user,$pass,$db);

if($conexion->connect_errno) {
	die("La conexion ha fallado" . $conexion->connexion_errno);
}
?>