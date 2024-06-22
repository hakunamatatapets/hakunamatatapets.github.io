<?php
require('../fpdf/fpdf.php');

class PDF extends FPDF
{
    protected $totalClientes;

    // Conectar a la base de datos y cargar datos
    function LoadData()
    {
        $config = include '../config.php';
        $data = array();
        
        try {
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            $conexion = new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
            $consultaSQL = "SELECT nombre, apellidos, telefono, correo FROM Empleados";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $results = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            
            foreach ($results as $row) {
                $data[] = array($row['nombre'], $row['apellidos'], $row['telefono'], $row['correo']);
            }
            
            // Obtener el total de clientes
            $consultaSQL = "SELECT COUNT(*) AS total FROM Empleados";
            $sentencia = $conexion->prepare($consultaSQL);
            $sentencia->execute();
            $this->totalClientes = $sentencia->fetch(PDO::FETCH_ASSOC)['total'];
            
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
        $this->Cell(60,10,'Lista de Empleados',1,0,'C');
        // Salto de línea
        $this->Ln(20);
    }

    function ImprovedTable($header, $data)
    {
        // Ajusta la posición de la tabla aquí
        $startX = 20; // Posición X
        $startY = 50; // Posición Y
        $this->SetXY($startX, $startY);

        // Anchuras de las columnas
        $w = array(40, 50, 30, 60);
        
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
            $this->Cell($w[0], 6, $row[0], 'LR');
            $this->Cell($w[1], 6, $row[1], 'LR');
            $this->Cell($w[2], 6, $row[2], 'LR');
            $this->Cell($w[3], 6, $row[3], 'LR');
            $this->Ln();
            $this->SetX($startX); // Reinicia la posición X para cada fila
        }
        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');

        // Mostrar el total de clientes
        $this->Ln(10); // Espacio antes del total
        $this->Cell(0, 10, 'Total de empleados: ' . $this->totalClientes, 0, 1, 'C');
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
$header = array('Nombre', 'Apellidos', 'Telefono', 'Email');
// Carga de datos
$data = $pdf->LoadData();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->ImprovedTable($header, $data);
$pdf->Output();
?>
