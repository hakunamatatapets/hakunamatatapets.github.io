<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identificacion = $_POST["identificacion"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $telefono = $_POST["telefono"];
    $email = $_POST["email"];
    $direccion = $_POST["direccion"];
    $contraseña = $_POST["contraseña"];
    $mensaje = $_POST["mensaje"];
    $destinatario = "tucorreo@example.com";
    $asunto = "mensaje de contacto de $nombre";
    $contenido = "nombre: $nombre\n";
    $contenido .= "email: $email\n\n";
    $contenido .= "mensaje:\n$mensaje";

    mail($destinatario, $asunto, $contenido);
   
    header("Location: confirmacion.html");
    } else {
    
    header("Location: index.html");
    }
   ?>