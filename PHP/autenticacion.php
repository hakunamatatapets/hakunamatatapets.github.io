<?php
session_start();

$respuesta = array('autenticado' => false);

if (isset($_SESSION['usuario_id'])) {
    $respuesta['autenticado'] = true;
}

echo json_encode($respuesta);
?>