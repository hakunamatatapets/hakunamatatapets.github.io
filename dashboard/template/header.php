<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <base href="/proyecto/dashboard/">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2 class="logo">Dashboard</h2>
            <nav class="menu">
                <a href="../index.php"><i class="material-icons" style="font-size: 14px;">arrow_back</i> Volver al inicio</a>
            </nav>
            <nav class="menu">
                <a href="index.php">Usuarios</a>
            </nav>
            <nav class="menu">
                <a href="empleados/index_empleados.php">Empleados</a>
            </nav>
            <nav class="menu">
                <a href="servicios/index_servicios.php">Servicios</a>
            </nav>
            <nav class="menu">
                <a href="mascotas/index_mascotas.php">Mascotas</a>
            </nav>
            <nav class="menu">
                <a href="citas/index_citas.php">Citas</a>
            </nav>
        </aside>
        <?php 
        session_start();
        
        include '../db_connection.php';
        
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
        <main class="main-content">
            <header class="header">
                <div class="user-info">
                    <span class="user-name">Bienvenido, <?php echo $usuario['nombre']?></span>
                    <i class="material-icons">account_box</i>
                </div>
            </header>
            <section class="projects">