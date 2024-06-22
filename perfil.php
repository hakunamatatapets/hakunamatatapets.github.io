<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
  header("Location: ingreso.php"); // Redirigir al login si no está logueado
  exit();
}

include 'db_connection.php';

// Obtener información del usuario
$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM cliente WHERE ID_Cliente = '$usuario_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  $usuario = $result->fetch_assoc();
} else {
  echo "Error al obtener los datos del usuario.";
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Perfil - HAKUNA MATATA PETS</title>
  <link rel="stylesheet" href="CSS/style_perfil.css" />
  <link rel="stylesheet" href="CSS/style_base.css" />
  <link rel="stylesheet" href="CSS/estilo_board.css">
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />
</head>

  <?php include 'template/header.php'?>

  <div class="container">
    <div class="row" style="justify-content: center">
      <div class="col-6">
        <h2>Perfil de Usuario</h2>
        <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
        <p><strong>Apellidos:</strong> <?php echo $usuario['apellidos']; ?></p>
        <p><strong>Teléfono:</strong> <?php echo $usuario['telefono']; ?></p>
        <p><strong>Email:</strong> <?php echo $usuario['email']; ?></p>
        <p><strong>Dirección:</strong> <?php echo $usuario['direccion']; ?></p>
      </div>
    </div>
  </div>

  <?php include 'PHP/index.php' ?>

  <?php include 'template/footer.php'?>
<?php
$conn->close();
?>