<?php
// Iniciar la sesión para acceder a las variables de sesión
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/ofertas.css">
</head>
<body>
    <div class="nav-head">
        <img src="imgs/logo.png" alt="" class="logo">
        <nav class="navegacion-principal contenedor">
            <a href="index.php">Inicio</a>
            <a href="propiedades.php">Propiedades</a>
            <!-- Contenedor para el menú desplegable -->
            <div class="nav-item">
                <a href="#">Servicios ▾</a>
                <ul class="submenu">
                    <li><a href="calculadoraHipoteca.php">Calculadora de Hipoteca</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                </ul>
            </div>
            <!-- Mostrar el nombre del usuario si está logueado -->
        <?php if (isset($_SESSION['user_name'])): ?>
          <div class="nav-item">
          <a href="#">Hola, <?php echo $_SESSION['user_name']; ?></a>
          <ul class="submenu">
              <li><a href="../Datos/logout.php">Cerrar sesión</a></li>
          </ul>
      </div>
        <?php else: ?>
            <a href="login.php">Iniciar sesión</a>
        <?php endif; ?>
        </nav>
    </div>
    <main>
        <h1>Ofertas especiales</h1>
        <p class="subtext">¡Hasta 20% OFF en propiedades seleccionadas!</p>
        <div class="offers">
            <div class="offer-card">
                <img src="imgs/discount.png" alt="15% de descuento" class="discount-badge">
                <h3>Casa Solara - ¡15% OFF!</h3>
                <p>Precio anterior: $1,200,000</p>
                <p>Precio nuevo: $1,020,000</p>
                <img src="imgs/casa4.JPG" alt="Casa Solara">
            </div>
            <div class="offer-card">
                <img src="imgs/discount.png" alt="15% de descuento" class="discount-badge">
                <h3>Residencial Palmas - ¡10% OFF!</h3>
                <p>Precio anterior: $950,000</p>
                <p>Precio nuevo: $855,000</p>
                <img src="imgs/casa5.JPG" alt="Residencial Palmas">
            </div>
            <div class="offer-card">
                <img src="imgs/discount.png" alt="15% de descuento" class="discount-badge">
                <h3>Valle Verde - ¡20% OFF!</h3>
                <p>Precio anterior: $850,000</p>
                <p>Precio nuevo: $680,000</p>
                <img src="imgs/casa6.JPG" alt="Valle Verde">
            </div>
        </div>
    </main>
</body>
</html>