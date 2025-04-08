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
    <link rel="stylesheet" href="css/calculadoraHipoteca.css">
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
    <div class="main-container">
        <div class="container">
            <div class="calculator">
                <h2>Calcula tu hipoteca</h2>
                <p>Ingresa los montos</p>
                <label for="precio">¿Cuánto cuesta la casa que quieres?</label>
                <input type="number" id="precio" placeholder="Ingresa el monto">
                
                <label for="enganche">¿Cuánto te gustaría dejar de enganche?</label>
                <input type="number" id="enganche" placeholder="Ingresa el monto">
                
                <label>¿Cuánto tiempo necesitas para pagar?</label>
                <div class="options">
                    <label><input type="radio" id="5años" name="plazo" value="5"> 5 años</label>
                    <label><input type="radio" id="10años" name="plazo" value="10"> 10 años</label>
                    <label><input type="radio" id="15años" name="plazo" value="15"> 15 años</label>
                    <label><input type="radio" id="20años" name="plazo" value="20"> 20 años</label>
                </div>
                <button>Calcular</button>
                <div id="resultado" class="resultado" style="display: none;"></div>
            </div>
            <div class="image-box"></div>
        </div>
    </div>
</body>
<script src="js/general.js"></script>
<script src="js/calculadoraHipoteca.js"></script>
</html>