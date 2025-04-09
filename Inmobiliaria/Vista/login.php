<?php
session_start();
require_once '../Datos/conexion.php';

$error_message = ''; // Variable para almacenar el mensaje de error

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los valores del formulario
    $email = $_POST['email'];
    $password = $_POST['contrasena'];

    // Preparar la consulta SQL
    $sql = "SELECT id, nombre, contrasena, tipo FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Verificar si la consulta se preparó correctamente
    if ($stmt) {
        // Vincular los parámetros de la consulta
        $stmt->bind_param('s', $email);  // 's' para string (email)

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados
        $stmt->store_result();

        // Verificar si se encontró el usuario
        if ($stmt->num_rows > 0) {
            // Vincular las variables para el resultado
            $stmt->bind_result($db_id,$db_name, $db_password, $db_tipo);

            // Recuperar los datos del usuario
            $stmt->fetch();

            // Verificar la contraseña
            if ($db_password === $password) {
                // Iniciar sesión y guardar el nombre del usuario
                $_SESSION['user_name'] = $db_name;
                $_SESSION['user_id'] = $db_id;
                if($db_tipo==="admin"){
                    header("Location: ../Admin/inicio.php"); // Redirigir al usuario al admin
                }else{
                    header("Location: index.php"); // Redirigir al usuario a la página principal
                }
                exit();
            } else {
                $error_message = "Usuario o contraseña incorrectos.";
            }
        } else {
            $error_message = "Usuario o contraseña incorrectos.";
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        $error_message = "Error en la preparación de la consulta.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <div class="nav-head">
        <img src="imgs/logo.png" alt="" class="logo">
        <nav class="navegacion-principal contenedor">
            <a href="index.php">Inicio</a>
            <a href="propiedades.php">Propiedades</a>
            <a href="contacto.php">Contacto</a>
            <a href="login.php">Iniciar sesión</a>
        </nav>
    </div>

    <main class="page-content">
        <div class="login-container">
            <div class="login-image">
              <img src="imgs/login.JPG" alt="Imagen de login">
            </div>

            <div class="login-form">
                <div class="form-header">
                    <img src="imgs/logo.png" alt="Logo" class="logo">
                    <h2>Inmobiliaria Uriangato</h2>
                </div>

                <h3>Login</h3>
                <p class="subtitle">Bienvenido de nuevo. Ingresa tus credenciales para acceder a tu cuenta.</p>

                <!-- Mostrar mensaje de error si existe -->
                <?php if (!empty($error_message)): ?>
                    <div class="error-message">
                        <p><?php echo $error_message; ?></p>
                    </div>
                <?php endif; ?>

                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" placeholder="hello@example.cl" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <div class="password-container">
                            <input type="password" id="password" name="contrasena" placeholder="••••••••••" required>
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
