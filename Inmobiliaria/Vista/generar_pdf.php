<?php
require_once('tcpdf/tcpdf.php');
include '../Datos/conexion.php';

if (!isset($_GET['id'])) {
    die("Propiedad no especificada.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM propiedades WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Propiedad no encontrada.");
}
$propiedad = $result->fetch_assoc();

// Obtener imágenes
$sql2 = "SELECT url FROM multimedia WHERE id_propiedad = $id ORDER BY id ASC";
$result2 = $conn->query($sql2);
$imagenes = [];
while ($row = $result2->fetch_assoc()) {
    $imagenes[] = $row['url'];
}
$imagenPrincipal = $imagenes[0] ?? null;

// Crear nuevo documento PDF
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Inmobiliaria');
$pdf->SetTitle('Ficha de propiedad');
$pdf->SetMargins(15, 20, 15);
$pdf->AddPage();



if ($imagenPrincipal) {
    // Eliminar /WebIII/Inmobiliaria si viene al inicio
    $rutaRelativa = preg_replace('#^/?WebIII/Inmobiliaria/#', '', ltrim($imagenPrincipal, '/'));

    // Construir ruta desde Vista/ hacia Casas/
    $rutaImagen = __DIR__ . '/../' . $rutaRelativa;

    $pdf->Cell(0, 10, "Ruta construida: " . $rutaImagen, 0, 1);

    if (!file_exists($rutaImagen)) {
        $pdf->Cell(0, 10, "¿Existe? " . (is_file($rutaImagen) ? 'Sí' : 'No'), 0, 1);
        $pdf->Cell(0, 10, "¿Es legible? " . (is_readable($rutaImagen) ? 'Sí' : 'No'), 0, 1);
    }
    

    if (file_exists($rutaImagen)) {
        $pdf->Image($rutaImagen, 15, 30, 180, 100, '', '', '', false, 300, '', false, false, 0);
        $pdf->Ln(105);
    } else {
        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(0, 10, "⚠ Imagen no encontrada en: " . $rutaImagen, 0, 1);
        $pdf->SetTextColor(0, 0, 0);
    }
}

$pdf->SetFont('helvetica', 'B', 18);
$pdf->Cell(0, 10, $propiedad['titulo'], 0, 1, 'C');

$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, "📍 Ubicación: " . $propiedad['ubicacion'], 0, 1, 'C');

$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, "💲 Precio: $" . number_format($propiedad['precio'], 2), 0, 1, 'C');

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 10, "📝 Descripción:", 0, 1);
$pdf->SetFont('helvetica', '', 11);
$pdf->MultiCell(0, 8, $propiedad['descripcion'], 0, 'L');

$pdf->Ln(5);
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 10, "🏡 Características:", 0, 1);
$pdf->SetFont('helvetica', '', 11);

$caracteristicas = [
    "📐 Área de terreno: {$propiedad['area']} m2",
    "🛏 Habitaciones: {$propiedad['num_habitaciones']}",
    "🚿 Baños: {$propiedad['num_banos']}",
    "🚗 Estacionamiento: {$propiedad['estacionamiento']} autos",
];

foreach ($caracteristicas as $carac) {
    $pdf->Cell(0, 8, $carac, 0, 1);
}

$pdf->Ln(10);
$pdf->SetFont('helvetica', 'I', 10);
$pdf->Cell(0, 10, "Documento generado automáticamente por Tu Inmobiliaria", 0, 0, 'C');

// Salida del PDF
$pdf->Output("Propiedad_{$id}.pdf", 'I');
