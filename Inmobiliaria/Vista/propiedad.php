<?php

session_start();

include '../Datos/conexion.php';

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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $propiedad['titulo']; ?></title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/propiedad.css">
    <!-- Incluir Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
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
                        <button class="view-more" onclick="openCarousel(0)">View More</button>
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
                <?php if (isset($_SESSION['user_name'])): ?>
                    <a href="https://wa.me/4433868406?text=¡Hola!%20Me%20interesa%20contactar%20con%20un%20asesor." class="contact-button" target="_blank">Contactar con un asesor</a>
                <?php else: ?>
                    <button class="contact-button" onclick="showModal();">Contactar con un asesor</button>
                <?php endif; ?>      
            </div>
        </section>

        <section class="property-location">
            <h2>Ubicación del inmueble</h2>
            <p><?php echo $propiedad['ubicacion']; ?></p>
            <!-- Contenedor para el mapa -->
            <div id="map" style="height: 400px;"></div>
        </section>
    </main>
    <!-- Carrusel Modal -->
<div id="carouselModal" class="carousel-modal">
    <span class="close" onclick="closeCarousel()">&times;</span>
    <div class="carousel-content">
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <div id="carouselSlides" class="carousel-slides">
            <?php
            // Crear las imágenes del carrusel
            foreach ($imagenes as $index => $image) {
                echo '<div class="carousel-slide">';
                echo '<img src="' . $image . '" alt="Imagen ' . ($index + 1) . '">';
                echo '</div>';
            }
            ?>
        </div>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div>
</div>
    <div id="modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h2>¡Necesitas iniciar sesión!</h2>
            <p>Para poder contactar con un asesor, es necesario que inicies sesión primero.</p>
            <a href="login.php" class="btn">Iniciar sesión</a>
        </div>
    </div>

    <script src="js/propiedad.js"></script>
    
    <!-- Incluir Leaflet.js -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Dirección de la propiedad (obtenida desde PHP)
            var direccion = "<?php echo $propiedad['ubicacion']; ?>";

            // URL de la API de Nominatim para obtener coordenadas a partir de la dirección
            var apiUrl = "https://nominatim.openstreetmap.org/search?format=json&q=" + encodeURIComponent(direccion);

            // Hacer la petición AJAX para obtener las coordenadas
            fetch(apiUrl)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        // Obtener las coordenadas del primer resultado
                        var lat = data[0].lat;
                        var lon = data[0].lon;

                        // Crear el mapa en el contenedor con id 'map'
                        var map = L.map('map').setView([lat, lon], 13);

                        // Cargar el mapa de OpenStreetMap
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        // Agregar un marcador en la ubicación de la propiedad
                        L.marker([lat, lon]).addTo(map)
                            .bindPopup("<b><?php echo $propiedad['titulo']; ?></b><br><?php echo $propiedad['ubicacion']; ?>")
                            .openPopup();
                    } else {
                        console.log("No se encontraron coordenadas para la dirección.");
                    }
                })
                .catch(error => {
                    console.error("Error al obtener las coordenadas:", error);
                });
        });
    </script>
</body>
</html>
