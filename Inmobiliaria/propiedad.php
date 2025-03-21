<?php
require 'conexion.php';

$id = $_GET['id'] ?? 0;
$sql = "SELECT * FROM propiedades WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$propiedad = $result->fetch_assoc();

if (!$propiedad) {
    echo "Propiedad no encontrada.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <a href="contacto.php">Contacto</a>
        </nav>
    </div>
    <main>
        <section class="property-details">
            <div class="gallery">
                <div class="image-container">
                    <img src="imgs/default-house.jpg" class="main-image" alt="Imagen principal">
                </div>
            </div>
            <div class="info">
                <h1><?php echo $propiedad['titulo']; ?></h1>
                <p>📍 <?php echo $propiedad['ubicacion'] ?? 'Ubicación no especificada'; ?></p>
                <h2>$<?php echo number_format($propiedad['precio'], 2); ?> MXN</h2>
                <h3>Descripción:</h3>
                <p><?php echo $propiedad['descripcion']; ?></p>
                <h3>Características:</h3>
                <ul>
                    <li><?php echo $propiedad['area'] ?? 'N/A'; ?> m² de Terreno</li>
                    <li><?php echo $propiedad['num_habitaciones'] ?? 0; ?> recámaras</li>
                    <li><?php echo $propiedad['num_banos'] ?? 0; ?> baños</li>
                    <li>Estacionamiento para <?php echo $propiedad['estacionamiento'] ?? 0; ?> autos</li>
                </ul>
                <button class="contact-button">Contactar con un asesor</button>
            </div>
        </section>
    </main>
</body>
<script src="js/general.js"></script>
</html>
