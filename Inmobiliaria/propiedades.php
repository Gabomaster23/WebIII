<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Propiedades</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/propiedades.css">
</head>
<body>
    <div class="nav-head">
        <img src="imgs/logo.png" alt="Logo" class="logo">
        <nav class="navegacion-principal contenedor">
            <div class="nav-item">
                <a href="#">Servicios ▾</a>
                <ul class="submenu">
                    <li><a href="calculadoraHipoteca.html">Calculadora de Hipoteca</a></li>
                    <li><a href="ofertas.html">Ofertas</a></li>
                </ul>
            </div>
            <a href="index.html">Inicio</a>
            <!-- Contenedor para el menú desplegable -->
            <a href="contacto.html">Contacto</a>
            <a href="login.html">Iniciar sesión</a>
        </nav>
    </div>

    <main>
        <h2>Propiedades</h2>
        <h1>Encuentra tu hogar</h1>
        <p class="subtext">Descubre tu hogar ideal con nuestras exclusivas opciones de casas, diseñadas para cada estilo de vida.</p>

        <div class="search-container">
            <input type="text" placeholder="Ingresa información">
            <button>Buscar</button>
        </div>

        <div class="properties">
            <!-- Tarjeta de Propiedad 1 -->
            <div class="property-card">
                <img src="imgs/casa1.JPG" alt="Casa Solara">
                <div class="info">
                    <div class="category">Casa</div>
                    <div class="title-container">
                        <h3>Casa Solara</h3>
                        <a href="#" class="expand-icon">↗</a>
                    </div>
                    <p>Casa moderna de dos pisos, con jardín amplio y acabados de lujo. Ideal para familias medianas. Comodidad y lujo en un mismo lugar.</p>
                    <div class="price">$1,200,000 MXN</div>
                    <div class="details">
                        <span>🛏️ 3</span>
                        <span>🚽 2</span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Propiedad 2 -->
            <div class="property-card">
                <img src="imgs/casa2.JPG" alt="Residencial Las Palmas">
                <div class="info">
                    <div class="category">Casa</div>
                    <div class="title-container">
                        <h3>Residencial Las Palmas</h3>
                        <a href="propiedad.html" class="expand-icon">↗</a>
                    </div>
                    <p>Amplia casa de tres recámaras y dos baños, en una zona tranquila con acceso a parques y escuelas cercanas.</p>
                    <div class="price">$950,000 MXN</div>
                    <div class="details">
                        <span>🛏️ 3</span>
                        <span>🚽 2</span>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Propiedad 3 -->
            <div class="property-card">
                <img src="imgs/casa3.JPG" alt="Casa Lago Azul">
                <div class="info">
                    <div class="category">Casa</div>
                    <div class="title-container">
                        <h3>Casa Lago Azul</h3>
                        <a href="#" class="expand-icon">↗</a>
                    </div>
                    <p>Hermosa casa frente a un lago, con terraza. Vistas espectaculares, ideal para quienes buscan privacidad y confort.</p>
                    <div class="price">$2,500,000 MXN</div>
                    <div class="details">
                        <span>🛏️ 4</span>
                        <span>🚽 3</span>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="js/general.js"></script>
</html>
