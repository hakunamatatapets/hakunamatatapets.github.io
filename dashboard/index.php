<?php
include 'funciones.php';
$error = false;
$config = include 'config.php';
try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    $consultaSQL = "SELECT * FROM cliente WHERE estado = 'activo'";
    $sentencia = $conexion->prepare($consultaSQL);
    $sentencia->execute();
    $usuarios = $sentencia->fetchAll();
} catch (PDOException $error) {
    $error = $error->getMessage();
}
$titulo = 'Lista de usuarios';
?>
<?php include "template/header.php"; ?>
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
<div class="">
    <div class="row">
        <div class="col-md-12">
            <br>
            <a class="boton" href="crear.php"><strong>Crear usuario</strong></a>
            <a class="boton" href="reporte_usuario.php" target="_blank"><strong>Generar reporte</strong></a>
            <br>
            <br>
            <hr>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="mt-3"><?= $titulo ?></h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($usuarios && $sentencia->rowCount() > 0) {
                        foreach ($usuarios as $fila) {
                    ?>
                            <tr>
                                <td><?php echo escapar($fila["ID_Cliente"]); ?></td>
                                <td><?php echo escapar($fila["nombre"]); ?></td>
                                <td><?php echo escapar($fila["apellidos"]); ?></td>
                                <td><?php echo escapar($fila["telefono"]); ?></td>
                                <td><?php echo escapar($fila["email"]); ?></td>
                                <td><?php echo escapar($fila["direccion"]); ?></td>
                                <td>
                                    <a href="<?= 'borrar.php?id=' . escapar($fila["ID_Cliente"]) ?>"><i class="material-icons" style="font-size: 14px;">error_outline</i>Deshabilitar</a>
                                    <a href="<?= 'editar.php?id=' . escapar($fila["ID_Cliente"]) ?>" .>✏️Editar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                <tbody>
            </table>
        </div>
    </div>
</div>
<?php include "template/footer.php"; ?>