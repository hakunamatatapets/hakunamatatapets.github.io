<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    // Conectar a la base de datos y cargar datos
    function LoadData()
    {
        $config = include '../config.php';
        $data = array();
        
        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
            
            // Consulta para obtener clientes y sus mascotas
            $consultaSQL = "
                SELECT c.nombre AS nombre_cliente, c.apellidos, c.telefono, c.email, m.nombre AS nombre_mascota, m.raza
                FROM Cliente c
                LEFT JOIN Mascota m ON c.ID_Cliente = m.ID_Cliente
                ORDER BY c.nombre ASC
            ";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $results = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $row) {
                $data[] = array(
                    $row['nombre_cliente'],
                    $row['apellidos'],
                    $row['telefono'],
                    $row['email'],
                    $row['nombre_mascota'],
                    $row['raza']
                );
            }
        } catch (PDOException $error) {
            echo "Error: " . $error->getMessage();
        }
        
        return $data;
    }

    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../logo.jpg',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Mover a la derecha
        $this->Cell(80);
        // Título
        $this->Cell(90,10,'Lista de clientes y sus mascotas',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    function ImprovedTable($header, $data)
    {
        // Ajusta la posición de la tabla aquí
        $startX = 10; // Posición X
        $startY = 50; // Posición Y
        $this->SetXY($startX, $startY);

        // Anchuras de las columnas
        $w = array(30, 30, 30, 40, 30, 30);
        
        // Cabecera
        for($i=0; $i<count($header); $i++) {
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C');
        }
        $this->Ln();
        
        // Establece la posición de inicio para las filas de datos
        $this->SetX($startX);
        
        // Datos
        foreach($data as $row)
        {
            for($i=0; $i<count($w); $i++) {
                $this->Cell($w[$i], 6, $row[$i], 'LR');
            }
            $this->Ln();
            $this->SetX($startX); // Reinicia la posición X para cada fila
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }

    // Pie de página
    function Footer()
    {
        // Posición a 1.5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
    }
}

// Creación de instancia de la clase heredada
$pdf = new PDF();
// Encabezados de las columnas
$header = array('Nombre', 'Apellidos', 'Telefono', 'Email', 'Mascota', 'Raza');
// Carga de datos
$data = $pdf->LoadData();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->ImprovedTable($header, $data);
$pdf->Output();
?>
