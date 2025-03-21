<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/propiedad.css">
</head>
<body>
    <div class="nav-head">
        <img src="imgs/logo.png" alt="" class="logo">
        <nav class="navegacion-principal contenedor">
            <a href="index.html">Inicio</a>
            <a href="propiedades.html">Propiedades</a>
            <!-- Contenedor para el menú desplegable -->
            <div class="nav-item">
                <a href="#">Servicios ▾</a>
                <ul class="submenu">
                    <li><a href="calculadoraHipoteca.html">Calculadora de Hipoteca</a></li>
                    <li><a href="ofertas.html">Ofertas</a></li>
                </ul>
            </div>
            <a href="Contacto.html">Contacto</a>
        </nav>
    </div>
    <main>
        <section class="property-details">
            <div class="gallery">
                <div class="image-container">
                    <div class="thumbnails">
                        <img src="imgs/detalle1.JPG" alt="Miniatura 1">
                        <img src="imgs/detalle2.JPG" alt="Miniatura 2">
                        <img src="imgs/detalle3.JPG" alt="Miniatura 3">
                        <img src="imgs/detalle4.JPG" alt="Miniatura 4">
                        <button class="view-more">View More</button>
                    </div>
                    <img src="imgs/casa2.JPG" class="main-image" alt="Imagen principal">
                </div>
            </div>
            <div class="info">
                <h1>Casa Solara</h1>
                <p><i class="location-icon"></i>📍 Lomas de Chapultepec, México</p>
                <h2>$1,200,000 MXN</h2>
                <h3>Descripción:</h3>
                <p>Casa habitacional ubicada en una de las mejores calles de Lomas de Chapultepec. La casa cuenta con abundante entrada de luz natural, es una casa que se mantiene en excelente temperatura todo el año. El estado de conservación de la misma es impecable.</p>
                <h3>Características:</h3>
                <ul>
                    <li>600 m2 de Terreno</li>
                    <li>4 recámaras con opción a una quinta, cada una con vestidor y baño.</li>
                    <li>La habitación principal tiene jacuzzi, clóset y vestidor.</li>
                    <li>Estacionamiento para 5 autos con puerta eléctrica.</li>
                    <li>Estancia para sala, comedor y antecomedor.</li>
                    <li>Cocina integral independiente con cubierta de cuarzo.</li>
                    <li>Jardín central con fuente</li>
                    <li>Amplia área de servicio con 2 baños, 2 recámaras, cuarto de lavado y 2 bodegas.</li>
                    <li>Calefacción central</li>
                    <li>Sistema hidroneumático</li>
                    <li>Jardinero y vigilancia 24hrs.</li>
                    <li>Pisos de encino americano y puertas de cedro blanco.</li>
                </ul>
                <button class="contact-button">Contactar con un asesor</button>
            </div>
        </section>
        <section class="property-location">
            <h2>Ubicación del inmueble</h2>
            <p>Montes Pirineos 611, Col. Lomas de Chapultepec, Miguel Hidalgo, CDMX, C.P. 11000</p>
            <img src="imgs/mapa.jpeg" class="map" alt="Mapa de ubicación">
        </section>
    </main>

</body>
<script src="js/general.js"></script>
</html>