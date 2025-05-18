<?php
session_start();
require '../Datos/conexion.php';

// Buscar todas las propiedades con descuento
$sql = "SELECT * FROM propiedades WHERE descuento IS NOT NULL AND estado = 'Disponible'" ;
$resultado = $conn->query($sql);
$propiedades_descuento = mysqli_fetch_all($resultado, MYSQLI_ASSOC);

// Obtener la URL de la imagen principal de cada propiedad desde la tabla multimedia
$imagenes = [];
foreach ($propiedades_descuento as $prop) {
    $id_propiedad = $prop['id'];
    // IMPORTANTE: Buscar tipo 'Principal', sin extensión
    $sql_imagen = "SELECT url FROM multimedia 
               WHERE id_propiedad = $id_propiedad 
               AND tipo = 'Imagen' 
               AND (LOWER(url) LIKE '%principal.jpg' OR LOWER(url) LIKE '%principal.png') 
               LIMIT 1";


    $resultado_imagen = $conn->query($sql_imagen);
    $imagen = $resultado_imagen->fetch_assoc();
    $imagenes[$id_propiedad] = $imagen ? $imagen['url'] : null;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ofertas Especiales</title>
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/ofertas.css">
</head>
<body>
    
        



    <div class="nav-head">
        <img src="imgs/logo.png" alt="" class="logo">
        <nav class="navegacion-principal contenedor">
            <a href="../index.php" class="active">Inicio</a>
            <a href="propiedades.php">Propiedades</a>
            <div class="nav-item">
                <a href="#">Servicios ▾</a>
                <ul class="submenu">
                    <li><a href="calculadoraHipoteca.php">Calculadora de Hipoteca</a></li>
                    <li><a href="ofertas.php">Ofertas</a></li>
                </ul>
            </div>
            <a href="login.php">Iniciar sesión</a>
        </nav>
    </div>

    <main>
        <h1>Ofertas Especiales</h1>
        <p class="subtext">¡Hasta 20% OFF en propiedades seleccionadas!</p>
        <div class="offers">
            <?php if (!empty($propiedades_descuento)) : ?>
                <?php foreach ($propiedades_descuento as $prop) : ?>
                    <div class="offer-card" data-id="<?php echo $prop['id']; ?>">
                        <img src="imgs/discount.png" alt="Descuento" class="discount-badge">
                        <h3>
                            <?php echo htmlspecialchars($prop['titulo']); ?> -
                            ¡<?php echo $prop['precio'] > 0 ? round(($prop['descuento'] / $prop['precio']) * 100) : 0; ?>% OFF!
                        </h3>
                        <p>Precio anterior: $<?php echo number_format($prop['precio'], 2); ?> MXN</p>
                        <p>Precio nuevo: $<?php echo number_format(($prop['precio']-$prop['descuento']), 2); ?> MXN</p>

                        <!-- Mostrar imagen principal o imagen por defecto -->
                        <?php if (!empty($imagenes[$prop['id']])) : ?>
                            <img src="<?php echo $imagenes[$prop['id']]; ?>" alt="<?php echo htmlspecialchars($prop['titulo']); ?>">
                        <?php else : ?>
                            <img src="imgs/default-house.jpg" alt="<?php echo htmlspecialchars($prop['titulo']); ?>">
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>No hay ofertas disponibles en este momento.</p>
            <?php endif; ?>
        </div>
    </main>
    <script>
document.querySelectorAll('.offer-card').forEach(card => {
    card.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        window.location.href = `propiedad.php?id=${id}`;
    });
});
</script>

</body>
</html>
