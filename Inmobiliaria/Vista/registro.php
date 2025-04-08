<?php
require_once '../Datos/conexion.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $nombreCompleto = $nombre . ' ' . $apellido;
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validaciones
    if (empty($nombre) || empty($apellido) || empty($email) || empty($telefono) || empty($password) || empty($confirmPassword)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "Correo electrónico no válido.";
    } elseif (!preg_match("/^[0-9]{10}$/", $telefono)) {
        $mensaje = "Teléfono inválido. Debe contener 10 dígitos.";
    } elseif ($password !== $confirmPassword) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        $tipo = 'usuario';
        $sql = "INSERT INTO usuarios (nombre, email, telefono, contrasena, tipo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if ($stmt === false) {
            $mensaje = "Error al preparar la consulta: " . $conn->error;
        } else {
            $stmt->bind_param("sssss", $nombreCompleto, $email, $telefono, $password, $tipo);

            if ($stmt->execute()) {
                $mensaje = "Registro exitoso. <a href='login.php'>Inicia sesión aquí</a>.";
            } else {
                $mensaje = "Error al registrar: " . $stmt->error;
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro</title>
  <link rel="stylesheet" href="css/general.css"/>
  <link rel="stylesheet" href="css/registro.css"/>
</head>
<body>
  <header class="nav-head">
    <img src="imgs/logo.png" alt="Inmobiliaria Uriangato" class="logo" />
    <nav class="navegacion-principal">
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
  </header>

  <main class="page-content">
    <div class="login-container">
      <div class="login-image">
        <img src="imgs/registro.JPG" alt="Imagen de registro"/>
      </div>

      <div class="login-form">
        <div class="form-header">
          <img src="imgs/logo.png" alt="Logo" class="logo" />
          <h2>Inmobiliaria Uriangato</h2>
        </div>

        <h3>Registro</h3>
        <p class="subtitle">Crea tu cuenta llenando los campos a continuación.</p>

        <!-- Mostrar mensaje si existe -->
        <?php if (isset($mensaje)) : ?>
          <p style="background-color:#bbefb1; color:#28661c; padding:10px; border-radius:5px; text-align:center;">
            <?= $mensaje ?>
          </p>
        <?php endif; ?>

        <form method="POST" action="">
          <div class="form-group form-group-name-apellido">
            <div class="form-group">
              <label for="nombre">Nombre</label>
              <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required />
            </div>

            <div class="form-group">
              <label for="apellido">Apellido</label>
              <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required />
            </div>
          </div>

          <div class="form-group">
            <label for="email">Correo Electrónico</label>
            <input type="email" id="email" name="email" placeholder="hello@example.cl" required />
          </div>

          <div class="form-group">
            <label for="telefono">Teléfono</label>
            <input type="tel" id="telefono" name="telefono" placeholder="4451489785" required />
          </div>

          <div class="form-group">
            <label for="password">Contraseña</label>
            <div class="password-container">
              <input type="password" id="password" name="password" placeholder="••••••••••" required />
              <span class="eye-icon">👁️</span>
            </div>
          </div>

          <div class="form-group">
            <label for="confirm-password">Confirmar Contraseña</label>
            <div class="password-container">
              <input type="password" id="confirm-password" name="confirm-password" placeholder="••••••••••" required />
              <span class="eye-icon">👁️</span>
            </div>
          </div>

          <button type="submit" class="btn">Registrarse</button>
        </form>

        <p class="register-text">
          ¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a>
        </p>
      </div>
    </div>
  </main>

  <script src="js/general.js"></script>
  <script src="js/registro.js"></script>
</body>
</html>
