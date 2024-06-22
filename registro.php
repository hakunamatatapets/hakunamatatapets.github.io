<?php session_start(); ?>
<?php
include 'db_connection.php';

$resultado = '';
$error = false;
$errores = [];

if (isset($_POST['submit'])) {
    // Obtener los datos del formulario
    $ID_Cliente = $_POST['ID_Cliente'];
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    $password = $_POST['contraseña'];

    // Validar que no haya campos vacíos
    if (empty($ID_Cliente) || empty($nombre) || empty($apellidos) || empty($telefono) || empty($email) || empty($direccion) || empty($password)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    // Validar el ID_Cliente (solo números y máximo 10 dígitos)
    if (!preg_match('/^\d{1,10}$/', $ID_Cliente)) {
        $errores[] = "El número de indenditicación debe ser numérico y tener un máximo de 10 dígitos.";
    }

    // Validar el correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El formato del correo electrónico no es válido.";
    }

    // Validar el número de teléfono (exactamente 10 dígitos)
    if (!preg_match('/^\d{10}$/', $telefono)) {
        $errores[] = "El número de teléfono debe tener exactamente 10 dígitos.";
    }

    // Validar el nombre (solo letras y espacios, máximo 20 caracteres)
    if (!preg_match('/^[a-zA-Z\s]{1,20}$/', $nombre)) {
        $errores[] = "El nombre solo puede contener letras, espacios y tener un máximo de 20 caracteres.";
    }

    // Validar los apellidos (solo letras y espacios, máximo 20 caracteres)
    if (!preg_match('/^[a-zA-Z\s]{1,20}$/', $apellidos)) {
        $errores[] = "Los apellidos solo pueden contener letras, espacios y tener un máximo de 20 caracteres.";
    }

    // Validar la contraseña (1 caracter especial, 1 mayúscula y máximo 10 caracteres de longitud)
    if (!preg_match('/^(?=.*[A-Z])(?=.*[\W]).{1,10}$/', $password)) {
        $errores[] = "La contraseña debe tener al menos 1 caracter especial, 1 letra mayúscula y un máximo de 10 caracteres de longitud.";
    }

    // Verificar si el correo ya está registrado
    $stmt = $conn->prepare("SELECT email FROM cliente WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $errores[] = "El correo electrónico ya está registrado.";
    }

    $stmt->close();

    // Si no hay errores, proceder con el registro
    if (empty($errores)) {
        // Encriptar la contraseña
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Preparar y ejecutar la consulta SQL
        $stmt = $conn->prepare("INSERT INTO cliente (ID_Cliente, nombre, apellidos, telefono, email, direccion, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $ID_Cliente, $nombre, $apellidos, $telefono, $email, $direccion, $password_hash);

        if ($stmt->execute()) {
            $resultado = "Registro exitoso. <a href='ingreso.php'>Iniciar sesión</a>";
        } else {
            $resultado = "Error: " . $stmt->error;
            $error = true;
        }

        $stmt->close();
        $conn->close();
    } else {
        $error = true;
        $resultado = implode("<br>", $errores);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>HAKUNA MATATA PETS</title>
    <link rel="stylesheet" href="CSS/style_registro.css" />
    <link rel="stylesheet" href="CSS/style_base.css" />
    <link rel="stylesheet" href="CSS/estilo_board.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
</head>

    <?php include 'template/header.php'?>
    <!-- De acá hacia arriba NO TOCAR -->
    <?php if (!empty($resultado)) { ?>
        <div class="container mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-<?= $error ? 'danger' : 'success' ?>" role="alert">
                        <?= $resultado ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <div class="container" id="formuRegistro">
        <div class="row" style="justify-content: center">
            <div class="col-6">
                <h2>REGISTRARSE</h2>
                <form method="post">
                    <input type="text" name="ID_Cliente" placeholder="Digita tu identificacion" class="form-control" /><br />
                    <input type="text" name="nombre" placeholder="Digita tu nombre" class="form-control" /><br />
                    <input type="text" name="apellidos" placeholder="Digita tus apellidos" class="form-control" /><br />
                    <input type="text" name="telefono" placeholder="Digita tu telefono" class="form-control" /><br />
                    <input type="email" name="email" placeholder="Digita tu email" class="form-control" /><br />
                    <input type="text" name="direccion" placeholder="Digita tu direccion" class="form-control" /><br />
                    <input type="password" name="contraseña" placeholder="Digita tu contraseña" class="form-control" /><br />
                    <input type="checkbox" name="terminos">
                    <label for="terminos" style="color:white;">Autorizo el <a href="#" id="link">tratamiento de mis datos personales</a></label> <br /><br />
                    <input type="submit" name="submit" value="REGISTRARSE" class="btn btn-danger" />
                </form>
                <br />
            </div>
        </div>
    </div>
    <div id="modal" class="modalf">
      <div class="modalf-content">
        <span class="cerrar">&times;</span>
        <p>Prueba de modal</p>
      </div>
    </div>
    <script src="./scripts/datos.js"></script>
    <!--div container -->
    <br />
    <!-- De acá hacia abajo NO TOCAR -->
    <?php include 'template/footer.php'?>
