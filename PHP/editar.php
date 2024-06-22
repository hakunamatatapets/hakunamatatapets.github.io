<?php
include 'funciones.php';
$config = include 'config.php';

include 'db_connection.php';

$usuario_id = $_SESSION['usuario_id'];
$sql = "SELECT * FROM cliente WHERE ID_Cliente = '$usuario_id'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();
} else {
    echo "Error al obtener los datos del usuario.";
    exit();
}

try {
    $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
    $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
    
    if (isset($_POST['submit'])) {
        // Datos del formulario
        $id_cita = $_POST['id_cita'];
        $nombre_mascota = $_POST['nombre_mascota'];
        $raza = $_POST['raza'];
        $tamano = $_POST['tamano'];
        $sexo = $_POST['sexo'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        
        // Actualizar los datos en la base de datos
        $consultaSQL = "UPDATE Citas ci
                        INNER JOIN Mascota m ON ci.ID_Mascota = m.ID_Mascota
                        SET m.nombre = :nombre_mascota, m.raza = :raza, m.tamaño = :tamano, m.sexo = :sexo, ci.fecha = :fecha, ci.hora = :hora
                        WHERE ci.id = :id_cita";
        
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->bindParam(':nombre_mascota', $nombre_mascota, PDO::PARAM_STR);
        $sentencia->bindParam(':raza', $raza, PDO::PARAM_STR);
        $sentencia->bindParam(':tamano', $tamano, PDO::PARAM_STR);
        $sentencia->bindParam(':sexo', $sexo, PDO::PARAM_STR);
        $sentencia->bindParam(':fecha', $fecha, PDO::PARAM_STR);
        $sentencia->bindParam(':hora', $hora, PDO::PARAM_STR);
        $sentencia->bindParam(':id_cita', $id_cita, PDO::PARAM_INT);
        
        $sentencia->execute();
        
        $resultado = [
            'error' => false,
            'mensaje' => 'La cita ha sido actualizada correctamente'
        ];
    } else {
        // Consulta SQL para obtener los datos necesarios de citas, cliente y mascota
        $consultaSQL = "SELECT ci.id AS id_cita, c.nombre AS nombre_cliente, c.apellidos AS apellido, c.email, c.telefono, m.nombre AS nombre_mascota, m.raza, m.tamaño AS tamano, m.sexo, ci.fecha, ci.hora
                        FROM Citas ci
                        INNER JOIN Mascota m ON ci.ID_Mascota = m.ID_Mascota
                        INNER JOIN Cliente c ON ci.ID_Cliente = c.ID_Cliente
                        WHERE c.email LIKE '%" . $usuario['email'] . "%'";
        
        $sentencia = $conexion->prepare($consultaSQL);
        $sentencia->execute();
        $citas = $sentencia->fetchAll();
    }
} catch (PDOException $error) {
    $resultado = [
        'error' => true,
        'mensaje' => $error->getMessage()
    ];
}
?>

<?php if (isset($resultado) && $resultado['error']) { ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger" role="alert">
                    <?= $resultado['mensaje'] ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (isset($resultado) && !$resultado['error'] && isset($_POST['submit'])) { ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success" role="alert">
                    <?= $resultado['mensaje'] ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if (isset($citas) && count($citas) > 0) { 
    foreach ($citas as $cita) { ?>
    <div class="container" id="formeditar">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-4">Editando la cita</h2>
                <hr>
                <form method="post">
                    <input type="hidden" name="id_cita" value="<?= escapar($cita['id_cita']) ?>">
                    <div class="form-group">
                        <label for="nombre_mascota">Nombre mascota</label>
                        <input type="text" name="nombre_mascota" id="nombre_mascota" value="<?= escapar($cita['nombre_mascota']) ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="raza">Raza</label>
                        <input type="text" name="raza" id="raza" value="<?= escapar($cita['raza']) ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="tamano">Tamaño</label>
                        <input type="text" name="tamano" id="tamano" value="<?= escapar($cita['tamano']) ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <input type="text" name="sexo" id="sexo" value="<?= escapar($cita['sexo']) ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="fecha">Fecha</label>
                        <input type="date" name="fecha" id="fecha" value="<?= escapar($cita['fecha']) ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="hora">Hora</label>
                        <input type="time" name="hora" id="hora" value="<?= escapar($cita['hora']) ?>" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary" value="Actualizar"> 
                    </div>
                    <br>
                </form>
            </div>
        </div>
    </div>
<?php }
} ?>