<?php
require_once('tcpdf/tcpdf.php');
include '../Datos/conexion.php';

// Clase personalizada con encabezado y pie de página
class MYPDF extends TCPDF {
    public function Header() {
        $this->SetFillColor(0, 102, 204); 
        $this->Rect(0, 0, 217, 25, 'F');
        $this->Image('../imagenes/logo_inmobiliaria.png', 10, 3, 20, '', '', '', '', false, 300);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('helvetica', 'B', 16);
        $this->SetXY(0, 12.5);
        $this->Cell(0, 10, 'FICHA TÉCNICA DE LA PROPIEDAD', 0, 1, 'C', 0, '', 0, false, 'M', 'M');
    }

    public function Footer() {
        $this->SetFillColor(0, 102, 204);
        $this->Rect(0, 346, 220, 10, 'F');
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('helvetica', '', 9);
        // Ancho total útil del footer
$anchoTotal = 200; // o usa $this->GetPageWidth() - márgenes

// Posición Y del footer
$y = 349;

// Teléfono alineado a la izquierda
$this->SetXY(10, $y);
$this->Cell($anchoTotal / 2, 5, 'Tel: 477-123-4567', 0, 0, 'L');

// Correo alineado a la derecha
$this->SetXY(10 + $anchoTotal / 2, $y);
$this->Cell($anchoTotal / 2, 5, 'contacto@inmobiliaria.com', 0, 0, 'R');

    }
}

if (!isset($_GET['id'])) {
    die("Propiedad no especificada.");
}

$id = intval($_GET['id']);

// Obtener propiedad
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

// Obtener mapa estático desde LocationIQ
$apiKey = 'pk.ec97329b7b7074dcb78e5c19449745d7';
$direccion = urlencode($propiedad['ubicacion']);

$geocodeUrl = "https://us1.locationiq.com/v1/search.php?key=$apiKey&q=$direccion&format=json";
$geocodeResponse = @file_get_contents($geocodeUrl);

$lat = null;
$lon = null;
if ($geocodeResponse !== false) {
    $data = json_decode($geocodeResponse, true);
    if (isset($data[0]['lat']) && isset($data[0]['lon'])) {
        $lat = $data[0]['lat'];
        $lon = $data[0]['lon'];

        $mapUrl = "https://maps.locationiq.com/v3/staticmap?key=$apiKey&center=$lat,$lon&zoom=15&size=600x400&markers=icon:small-red-cutout|$lat,$lon";
        $mapImage = @file_get_contents($mapUrl);

        $mapPath = __DIR__ . '/../imagenes/mapa_propiedad_' . $id . '.png';

        if (!file_exists(dirname($mapPath))) {
            mkdir(dirname($mapPath), 0777, true);
        }

        if ($mapImage !== false) {
            file_put_contents($mapPath, $mapImage);
        } else {
            $mapPath = null;
        }
    }
}

// Crear PDF con la clase personalizada
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(216, 356), true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Inmobiliaria');
$pdf->SetTitle('Ficha de propiedad');
$pdf->SetMargins(0, 30, 0); // margen superior aumentado por encabezado
$pdf->AddPage();

// Subtítulo
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->Cell(0, 10, 'Información principal del inmueble', 0, 1, 'C');

// Imagen principal
if ($imagenPrincipal) {
    $rutaRelativa = preg_replace('#^/?WebIII/Inmobiliaria/#', '', ltrim($imagenPrincipal, '/'));
    $rutaImagen = __DIR__ . '/../' . $rutaRelativa;

    if (file_exists($rutaImagen)) {
        $pdf->Image($rutaImagen, 15, 55, 50, 35, '', '', '', false, 300, '', false, false, 0);
    }
}

// Datos a la derecha
$pdf->SetXY(70, 55);
$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(120, 5, 
    "REFERENCIA: N° {$propiedad['id']}\n" .
    strtoupper($propiedad['titulo']) . "\n" .
    "{$propiedad['ubicacion']}\n" .
    "Fecha de registro: " . date("d-m-Y"),
    0, 'L'
);
$pdf->SetFont('helvetica', 'B', 14);
$pdf->SetXY(70, 80);
$pdf->Cell(120, 10, "$" . number_format($propiedad['precio'], 2), 0, 1, 'R');

$pdf->Ln(15);

// Características
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 10, "Características", 0, 1, 'C');
$pdf->SetFont('helvetica', '', 11);
$caracteristicas = [
    "• Área de terreno: {$propiedad['area']} m2",
    "• Habitaciones: {$propiedad['num_habitaciones']}",
    "• Baños: {$propiedad['num_banos']}",
    "• Estacionamiento: {$propiedad['estacionamiento']} autos"
];
foreach ($caracteristicas as $carac) {
    $pdf->SetX(15);
    $pdf->Cell(0, 8, $carac, 0, 1);
}
$pdf->Ln(5);

// Descripción
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 10, "Descripción", 0, 1,'C');
$pdf->SetFont('helvetica', '', 11);
$pdf->SetX(15);
$pdf->MultiCell(0, 8, $propiedad['descripcion'], 0, 'L');
$pdf->Ln(5);

// Ubicación
$pdf->SetFont('helvetica', 'B', 13);
$pdf->Cell(0, 10, "Ubicación", 0, 1,'C');
$pdf->SetFont('helvetica', '', 11);
$pdf->SetX(15);
$pdf->Cell(0, 8, "Dirección: {$propiedad['ubicacion']}", 0, 1);

// Imagen del mapa
if ($mapPath && file_exists($mapPath)) {
    $pdf->Image($mapPath, 15, $pdf->GetY() + 5, 180, 100, '', '', '', false, 300, '', false, false, 0);
    $pdf->Ln(120);
}

// Líneas decorativas
$pdf->SetDrawColor(0, 0, 0); 
$pdf->SetLineWidth(0.3);    
$pdf->Line(15, 115, 195, 115); 
$pdf->Line(15, 161, 195, 161); 
$pdf->Line(15, 185, 195, 185); 

// Salida del PDF
$pdf->Output("Propiedad_{$id}.pdf", 'I');
?>
