<?php
include 'conexion.php';

// Validar si recibimos id por GET
if (!isset($_GET['id'])) {
    echo "Propiedad no especificada.";
    exit;
}

$id = intval($_GET['id']); // Sanitize el id

// Obtener detalles de la propiedad
$sql = "SELECT * FROM propiedades WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Propiedad no encontrada.";
    exit;
}
$propiedad = $result->fetch_assoc();

// Obtener imágenes de la propiedad
$sql2 = "SELECT url FROM multimedia WHERE id_propiedad = $id ORDER BY id ASC";
$result2 = $conn->query($sql2);
$imagenes = [];
while ($row = $result2->fetch_assoc()) {
    $imagenes[] = $row['url'];
}



// DEPURACION
/*
echo "<pre>";
print_r($imagenes);
echo "</pre>";
*/

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $propiedad['titulo']; ?></title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/propiedad.css">
</head>
<body>

    <div class="nav-head">
        <img src="imgs/logo.png" alt="" class="logo">
        <nav class="navegacion-principal contenedor">
            <a href="index.php">Inicio</a>
            <a href="propiedades.php">Propiedades</a>
            <div class="nav-item">
                <a href="#">Servicios ▾</a>
                <ul class="submenu">
                    <li><a href="calculadoraHipoteca.php">Calculadora de Hipoteca</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                </ul>
            </div>
            <a href="Contacto.php">Contacto</a>
        </nav>
    </div>

    <main>
        <section class="property-details">
            <div class="gallery">
                <div class="image-container">
                    <div class="thumbnails">
                        <?php
                        // Miniaturas (excepto la imagen principal)
                        for ($i = 1; $i < min(count($imagenes), 5); $i++) {
                            echo '<img src="' . $imagenes[$i] . '" alt="Miniatura ' . $i . '">';
                        }
                        ?>
                        <button class="view-more">View More</button>
                    </div>
                    <!-- Imagen principal -->
                    <img src="<?php echo $imagenes[0]; ?>" class="main-image" alt="Imagen principal">
                </div>
            </div>

            <div class="info">
                <h1><?php echo $propiedad['titulo']; ?></h1>
                <p>📍 <?php echo $propiedad['ubicacion']; ?></p>
                <h2>$<?php echo number_format($propiedad['precio'], 2); ?></h2>
                <h3>Descripción:</h3>
                <p><?php echo $propiedad['descripcion']; ?></p>
                <h3>Características:</h3>
                <ul>
                    <li><?php echo $propiedad['area']; ?> m2 de Terreno</li>
                    <li><?php echo $propiedad['num_habitaciones']; ?> recámaras</li>
                    <li><?php echo $propiedad['num_banos']; ?> baños</li>
                    <li>Estacionamiento para <?php echo $propiedad['estacionamiento']; ?> autos</li>
                </ul>
                <button class="contact-button">Contactar con un asesor</button>
            </div>
        </section>

        <section class="property-location">
            <h2>Ubicación del inmueble</h2>
            <p><?php echo $propiedad['ubicacion']; ?></p>
            <img src="imgs/mapa.jpeg" class="map" alt="Mapa de ubicación">
        </section>
    </main>

</body>
</html>
