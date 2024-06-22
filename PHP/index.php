<?php
include 'funciones.php';
$error = false;
$config = include 'config.php';
try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
    // Consulta SQL para obtener los datos necesarios de citas, cliente y mascota
    $consultaSQL = "SELECT ci.id AS id_cita, c.nombre AS nombre_cliente, c.apellidos AS apellido, c.email, c.telefono, m.nombre AS nombre_mascota, m.raza, m.tamaño AS tamano, m.sexo, ci.fecha, ci.hora
                    FROM Citas ci
                    INNER JOIN Mascota m ON ci.ID_Mascota = m.ID_Mascota
                    INNER JOIN Cliente c ON ci.ID_Cliente = c.ID_Cliente
                    WHERE c.email LIKE '%" . $usuario['email'] . "%'";
    
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();
    $citas = $sentencia->fetchAll();
} catch (PDOException $error) {
    $error = $error->getMessage();
}
?>
<?php
if ($error) {
?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $error ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3">Lista de citas</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre cliente</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Nombre mascota</th>
                        <th>Raza</th>
                        <th>Tamaño</th>
                        <th>Sexo</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($citas && $sentencia->rowCount() > 0) {
                        foreach ($citas as $fila) {
                    ?>
                            <tr>
                                <td><?php echo escapar($fila["id_cita"]); ?></td>
                                <td><?php echo escapar($fila["nombre_cliente"]); ?></td>
                                <td><?php echo escapar($fila["apellido"]); ?></td>
                                <td><?php echo escapar($fila["email"]); ?></td>
                                <td><?php echo escapar($fila["telefono"]); ?></td>
                                <td><?php echo escapar($fila["nombre_mascota"]); ?></td>
                                <td><?php echo escapar($fila["raza"]); ?></td>
                                <td><?php echo escapar($fila["tamano"]); ?></td>
                                <td><?php echo escapar($fila["sexo"]); ?></td>
                                <td><?php echo escapar($fila["fecha"]); ?></td>
                                <td><?php echo escapar($fila["hora"]); ?></td>
                                <td>
                                    <a href="<?= 'PHP/borrar.php?id=' . escapar($fila["id_cita"]) ?>">🗑️ Borrar</a>
                                    <a href="<?= 'editar.php?id=' . escapar($fila["id_cita"]) ?>">✏️ Editar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="12">No se encontraron citas.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>