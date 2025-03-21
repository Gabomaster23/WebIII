<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/registro.css">
</head>
<body>
    <!-- Header / Nav -->
    <header class="nav-head">
      <img src="imgs/logo.png" alt="Inmobiliaria Uriangato" class="logo">
      <nav class="navegacion-principal">
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
    </header>
  
    <main class="page-content">
        <div class="login-container">
            <!-- Lado izquierdo: imagen -->
            <div class="login-image">
              <img src="imgs/registro.JPG" alt="Imagen de registro">
            </div>
        
            <!-- Lado derecho: formulario -->
            <div class="login-form">
              <div class="form-header">
                <img src="imgs/logo.png" alt="Logo" class="logo">
                <h2>Inmobiliaria Uriangato</h2>
              </div>
        
              <h3>Registro</h3>
              <p class="subtitle">Crea tu cuenta llenando los campos a continuación.</p>
        
              <form action="#">
                <!-- Nombre y Apellido en el mismo renglón -->
                <div class="form-group form-group-name-apellido">
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" placeholder="Ingresa tu nombre" required>
                  </div>
        
                  <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" placeholder="Ingresa tu apellido" required>
                  </div>
                </div>
        
                <!-- Correo Electrónico -->
                <div class="form-group">
                  <label for="email">Correo Electrónico</label>
                  <input type="email" id="email" placeholder="hello@example.cl" required>
                </div>
        
                <!-- Contraseña -->
                <div class="form-group">
                  <label for="password">Contraseña</label>
                  <div class="password-container">
                    <input type="password" id="password" placeholder="••••••••••" required>
                    <span class="eye-icon">👁️</span>
                  </div>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group">
                  <label for="confirm-password">Confirmar Contraseña</label>
                  <div class="password-container">
                    <input type="password" id="confirm-password" placeholder="••••••••••" required>
                    <span class="eye-icon">👁️</span>
                  </div>
                </div>
        
                <!-- Botón -->
                <button type="submit" class="btn">Registrarse</button>
              </form>
        
              <p class="register-text">¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
            </div>
        </div>
    </main>
</body>
<script src="js/general.js"></script>
</html>
