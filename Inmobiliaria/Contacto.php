<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/contacto.css">
</head>
<body>
    <div class="nav-head">
        <img src="imgs/logo.png" alt="" class="logo">
        <nav class="navegacion-principal contenedor">
          <a href="index.php">Inicio</a>
          <a href="propiedades.php">Propiedades</a>
          <!-- Contenedor para el menú desplegable -->
          <div class="nav-item">
            <a href="#">Servicios</a>
            <ul class="submenu">
                <li><a href="calculadoraHipoteca.php">Calculadora de Hipoteca</a></li>
                <li><a href="ofertas.php">Ofertas</a></li>
            </ul>
        </div>
          <a href="login.php">Iniciar sesión</a>
        </nav>
    </div>
    <main class="page-content">
        <div class="login-container">
        
            <!-- Lado izquierdo: formulario -->
            <div class="login-form">
        
              <h3>Contactanos</h3>
              <p class="subtitle">Crea tu cuenta llenando los campos a continuación.</p>
        
              <form action="#">
                <!-- Nombre y Apellido en el mismo renglón -->
                <div class="form-group form-group-name-apellido">
                  <div class="form-group">
                    <input type="text" id="nombre" placeholder="Ingresa tu nombre" required>
                  </div>
        
                  <div class="form-group">
                    <input type="text" id="apellido" placeholder="Ingresa tu apellido" required>
                  </div>
                </div>
        
                <!-- Correo Electrónico -->
                <div class="form-group">
                  <input type="email" id="email" placeholder="Ingresa tu correo" required>
                </div>
        
                <!-- Telefono -->
                <div class="form-group">
                    <input type="telefono" id="telefono" placeholder="Ingresa tu telefono" required>
                </div>

                <!-- Confirmar Contraseña -->
                <div class="form-group">
                    <input type="mensaje" id="mensaje" placeholder="Ingresa el mensaje" required>
                </div>
        
                <!-- Botón -->
                <button type="submit" class="btn">Contactar</button>
              </form>
            </div>
            <!-- Lado derecho: imagen -->
            <div class="login-image">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3745.6689534413463!2d-101.17917622499361!3d20.147854081290074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cfabbb7f67f15%3A0x1ad9fafe1a320641!2sAv.%20del%20Prado%203%2C%20Zona%20Centro%2C%2038980%20Uriangato%2C%20Gto.!5e0!3m2!1ses-419!2smx!4v1741704438755!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
        </div>
    </main>
</body>
<script src="js/general.js"></script>
</html>