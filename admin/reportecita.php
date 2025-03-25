<?php
include 'conexion.php';
require('./libreria/fpdf/fpdf.php');

if(isset($_GET['id_receta'])) {
    $id_receta = $_GET['id_receta'];

    // Consulta para obtener los detalles de la receta
    $sql = "SELECT r.*, c.fecha_cita, p.nombre as nombre_paciente 
            FROM recetas r
            INNER JOIN citas c ON r.id_cita = c.id_cita 
            INNER JOIN pacientes p ON c.id_paciente = p.id_paciente
            WHERE r.id_receta = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_receta);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);
    $receta = mysqli_fetch_assoc($resultado);

  
    class PDF extends FPDF {
        function Header() {
            $this->SetFont('Arial', 'B', 16);
            $this->SetTextColor(0, 51, 102);
            $this->Cell(0, 10, utf8_decode('Clínica La esperanza - Receta Médica'), 0, 1, 'C');
            $this->Ln(5);
            $this->SetTextColor(0, 0, 0);
            $this->Cell(0, 0, '', 'T', 1, 'C');
            $this->Ln(10);
        }

        function Footer() {
            $this->SetY(-15);
            $this->SetFont('Arial', 'I', 8);
            $this->SetTextColor(128, 128, 128);
            $this->Cell(0, 10, utf8_decode('Clinica La esperanza - Contacto: contacto@clinica.com | Tel: +123456789'), 0, 0, 'C');
        }
    }

    $pdf = new PDF();
    $pdf->AddPage();

    // Estilos
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetTextColor(0, 0, 0);

    // Información del paciente
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Información del Paciente'), 0, 1, 'L');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode('Nombre: ') . $receta['nombre_paciente'], 0, 1);
    $pdf->Cell(0, 10, utf8_decode('Fecha de la cita: ') . $receta['fecha_cita'], 0, 1);
    $pdf->Ln(5);

    // Diagnóstico
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, utf8_decode('Diagnóstico'), 0, 1);
    $pdf->SetFont('Arial', '', 12);
    $pdf->MultiCell(0, 10, utf8_decode($receta['prescripcion']));
    $pdf->Ln(10);

    $pdf->Output();
    exit;
}
?>
