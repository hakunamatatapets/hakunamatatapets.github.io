<?php
$conexion = mysqli_connect('localhost', 'root', '', 'hakuna_matata');

// Verificar la conexión
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
