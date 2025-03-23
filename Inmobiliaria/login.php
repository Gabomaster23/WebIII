<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/login.css">
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
            <a href="Contacto.php">Contacto</a>
        </nav>
    </div>

    <main class="page-content">
        <div class="login-container">
            <!-- Lado izquierdo: imagen -->
            <div class="login-image">
              <img src="imgs/login.JPG" alt="Imagen de login">
            </div>
        
            <!-- Lado derecho: formulario -->
            <div class="login-form">
              <div class="form-header">
                <img src="imgs/logo.png" alt="Logo" class="logo">
                <h2>Inmobiliaria Uriangato</h2>
              </div>
        
              <h3>Login</h3>
              <p class="subtitle">Bienvenido de nuevo. Ingresa tus credenciales para acceder a tu cuenta.</p>
        
              <form action="#">
                <div class="form-group">
                  <label for="email">Correo Electrónico</label>
                  <input type="email" id="email" placeholder="hello@example.cl">
                </div>
        
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <div class="password-container">
                    <input type="password" id="password" placeholder="••••••••••">
                    <span class="eye-icon">👁️</span>
                  </div>
                </div>
        
                <button type="submit" class="btn">Ingresar</button>
              </form>
        
              <p class="register-text">¿No tienes una cuenta? <a href="registro.php">Sign up here</a></p>
            </div>
          </div>
    </main>
</body>
<script src="js/general.js"></script>
<script src="js/login.js"></script>
</html>