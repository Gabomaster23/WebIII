<?php

session_start();

require_once '../Modelo/solicitudes.php'; 
require_once '../Datos/DAOSolicitudes.php';

$mensajeRespuesta = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
    $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
    $mensaje = isset($_POST['mensaje']) ? trim($_POST['mensaje']) : '';

    // Verificar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($apellido) && !empty($email) && !empty($telefono) && !empty($mensaje)) {
        $nombreCompleto = $nombre . ' ' . $apellido;

        $dao = new DAOSolicitudes();
        $resultado = $dao->agregarSolicitud($nombreCompleto, $email, $telefono, $mensaje);

        if ($resultado) {
            $mensajeRespuesta = "¡Gracias! Pronto nos pondremos en contacto contigo.";
        } else {
            $mensajeRespuesta = "Ocurrió un error al enviar tu mensaje. Intenta nuevamente.";
        }
    } else {
        $mensajeRespuesta = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/contacto.css">
</head>
<body>
    <div class="nav-head">
        <img src="imgs/logo.png" alt="Logo" class="logo">
        <nav class="navegacion-principal contenedor">
          <a href="index.php">Inicio</a>
          <a href="propiedades.php">Propiedades</a>
          <div class="nav-item">
            <a href="#">Servicios</a>
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
    <main class="page-content">
        <div class="login-container">
            <div class="login-form">
                <h3>Contáctanos</h3>
                <p class="subtitle">Envíanos un mensaje llenando los campos a continuación.</p>

                <!-- Mostrar mensaje de éxito o error -->
<?php if (!empty($mensajeRespuesta)): ?>
    <p id="mensaje-respuesta" class="mensaje"><?= htmlspecialchars($mensajeRespuesta) ?></p>
<?php endif; ?>

                <form action="contacto.php" method="POST">
                    <div class="form-group form-group-name-apellido">
                        <div class="form-group">
                            <input type="text" id="nombre" name="nombre" placeholder="Ingresa tu nombre" required>
                        </div>
                        <div class="form-group">
                            <input type="text" id="apellido" name="apellido" placeholder="Ingresa tu apellido" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Ingresa tu correo" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="telefono" name="telefono" placeholder="Ingresa tu teléfono" required>
                    </div>
                    <div class="form-group">
                        <input type="text" id="mensaje" name="mensaje" placeholder="Ingresa tu mensaje" required>
                    </div>
                    <button type="submit" class="btn">Contactar</button>
                </form>
            </div>
            <div class="login-image">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3745.6689534413463!2d-101.17917622499361!3d20.147854081290074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cfabbb7f67f15%3A0x1ad9fafe1a320641!2sAv.%20del%20Prado%203%2C%20Zona%20Centro%2C%2038980%20Uriangato%2C%20Gto.!5e0!3m2!1ses-419!2smx!4v1741704438755!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </main>
</body>
<script src="js/general.js"></script>
<script src="js/Contacto.js"></script>
</html>