<?php
require '../Datos/conexion.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['busqueda']) && $_GET['busqueda'] === '') {
    header("Location: propiedades.php");
    exit();
}

$busqueda = $_GET['busqueda'] ?? '';

$sql = "SELECT * FROM propiedades WHERE estado = 'Disponible'";

if (!empty($busqueda)) {
    $busqueda = $conn->real_escape_string($busqueda);
    $sql .= " AND (
        ubicacion LIKE '%$busqueda%' OR
        tipo LIKE '%$busqueda%' OR
        precio LIKE '%$busqueda%' OR
        descripcion LIKE '%$busqueda%'
    )";
}

$result = $conn->query($sql);

$sql = "SELECT * FROM propiedades WHERE descuento IS NOT NULL";
$resultado = $conn->query($sql);
$propiedades_descuento = mysqli_fetch_all($resultado, MYSQLI_ASSOC);


?>

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
                    <li><a href="calculadoraHipoteca.php">Calculadora de Hipoteca</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                </ul>
            </div>
            <a href="index.php">Inicio</a>
            <a href="contacto.php">Contacto</a>
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
        <h2>Propiedades</h2>
        <h1>Encuentra tu hogar</h1>
        <p class="subtext">Descubre tu hogar ideal con nuestras exclusivas opciones de casas, diseñadas para cada estilo de vida.</p>

            <form method="GET" action="" class="search-container">
                <input type="text" name="busqueda" placeholder="Buscar por ubicación, tipo, precio o descripción" value="<?php echo htmlspecialchars($busqueda); ?>">
                <button type="submit">Buscar</button>
            </form>

        <div class="properties">
            <!-- Propiedades Estáticas -->
            <!--<div class="property-card">
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

            <div class="property-card">
                <img src="imgs/casa2.JPG" alt="Residencial Las Palmas">
                <div class="info">
                    <div class="category">Casa</div>
                    <div class="title-container">
                        <h3>Residencial Las Palmas</h3>
                        <a href="propiedad.php" class="expand-icon">↗</a>
                    </div>
                    <p>Amplia casa de tres recámaras y dos baños, en una zona tranquila con acceso a parques y escuelas cercanas.</p>
                    <div class="price">$950,000 MXN</div>
                    <div class="details">
                        <span>🛏️ 3</span>
                        <span>🚽 2</span>
                    </div>
                </div>
            </div>

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
            </div>-->

            <!-- Propiedades desde la BD -->
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="property-card">
                    <img src="../Casas/<?php echo $row['id']; ?>/Principal.jpg" alt="<?php echo $row['titulo']; ?>">
                    <div class="info">
                        <div class="category"><?php echo $row['tipo']; ?></div>
                        <div class="title-container">
                            <h3><?php echo $row['titulo']; ?></h3>
                            <a href="propiedad.php?id=<?php echo $row['id']; ?>" class="expand-icon">↗</a>
                        </div>
                        <p><?php echo $row['descripcion']; ?></p>
                        <div class="price">$<?php echo number_format($row['precio'], 2); ?> MXN</div>
                        <div class="details">
                            <span>🛏️ <?php echo $row['num_habitaciones'] ?? 0; ?></span>
                            <span>🚽 <?php echo $row['num_banos'] ?? 0; ?></span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </main>


    <?php if (!empty($propiedades_descuento)) : ?>
        <script>
            var propiedadesConDescuento = <?php echo json_encode($propiedades_descuento); ?>;
            var mensaje = "¡Hay propiedades con descuento! Echa un vistazo:\n\n";

            propiedadesConDescuento.forEach(function(propiedad) {
                mensaje += propiedad.titulo + " - Precio original: $" + propiedad.precio + " MXN - Ahora: $" + propiedad.descuento + " MXN\n";
            });

            alert(mensaje);
        </script>
    <?php endif; ?>



    <script>
        // Si la página se recarga (tipo 1 = reload), vaciamos el campo y disparamos el form vacío
        if (performance.navigation.type === 1) {
            const inputBusqueda = document.querySelector('input[name="busqueda"]');
            if (inputBusqueda) {
                inputBusqueda.value = '';
                const form = inputBusqueda.closest('form');
                if (form) {
                    form.submit(); // Esto fuerza el GET sin valor
                }
            }
        }
    </script>

    <script src="js/general.js"></script>
</body>
</html>
