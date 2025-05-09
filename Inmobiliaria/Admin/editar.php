<?php
include("Conexion.php");
require_once("../Datos/DAOPropiedades.php");

// Validar que venga el id
if (!isset($_GET['id'])) {
    header("Location: propiedades.php");
    exit();
}

$id = $_GET['id'];
$dao = new DAOPropiedades();
$propiedad = $dao->obtenerPropiedadPorId($id);

if (!$propiedad) {
    header("Location: propiedades.php");
    exit();
}

// Obtener imágenes
$imagenes = $dao->obtenerMultimediaPorPropiedad($id);

// Eliminar imagen
// Eliminar imagen si viene el parámetro
if (isset($_GET['delete_img'])) {
    $idImagen = $_GET['delete_img'];

    // Obtener la ruta del archivo
    $stmt = $conn->prepare("SELECT url FROM multimedia WHERE id = ?");
    $stmt->bind_param("i", $idImagen);
    $stmt->execute();
    $result = $stmt->get_result();
    $imagen = $result->fetch_assoc();

    if ($imagen) {
        $rutaFisica = $_SERVER['DOCUMENT_ROOT'] . $imagen['url'];

        // Eliminar el archivo físico si existe
        if (file_exists($rutaFisica)) {
            unlink($rutaFisica);
        }

        // Eliminar el registro de la base de datos
        $dao->eliminarImagen($idImagen);
    }

    header("Location: editar.php?id=$id");
    exit();
}


// Subir nueva imagen
if (isset($_POST['subir_imagen']) && isset($_FILES['nueva_imagen'])) {
    $rutaTemporal = $_FILES['nueva_imagen']['tmp_name'];

    // Carpeta destino (ruta absoluta para mover archivo)
    $carpetaDestino = $_SERVER['DOCUMENT_ROOT'] . "/WebIII/Inmobiliaria/Casas/" . $id . "/";
    // Ruta para guardar en la base de datos
    $rutaEnBD = "/WebIII/Inmobiliaria/Casas/" . $id . "/";

    // Crear carpeta si no existe
    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    // Obtener el próximo ID de la tabla multimedia
    $stmt = $conn->prepare("SELECT MAX(id) AS ultimo_id FROM multimedia");
    $stmt->execute();
    $resultado = $stmt->get_result();
    $row = $resultado->fetch_assoc();
    $nuevoId = ($row['ultimo_id'] ?? 0) + 1;

    // Nombre del archivo final (ej: 11.png)
    $nombreFinal = $nuevoId . ".png";

    // Ruta final para mover el archivo y para la BD
    $rutaCompletaArchivo = $carpetaDestino . $nombreFinal;
    $rutaFinalEnBD = $rutaEnBD . $nombreFinal;

    // Mover archivo
    if (move_uploaded_file($rutaTemporal, $rutaCompletaArchivo)) {
        $dao->agregarImagen($id, $rutaFinalEnBD);
        header("Location: editar.php?id=$id");
        exit();
    } else {
        echo "Error al subir la imagen. Verifica permisos o tamaño del archivo.";
    }
}



// Actualizar propiedad
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['actualizar'])) {
    $titulo = $_POST['titulo'];
    $tipo = $_POST['tipo'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $ubicacion = $_POST['ubicacion'];
    $ancho = $_POST['ancho'];
    $largo = $_POST['largo'];
    $area = $_POST['area'];
    $num_habitaciones = $_POST['num_habitaciones'];
    $num_banos = $_POST['num_banos'];
    $estacionamiento = $_POST['estacionamiento'];
    $estado = $_POST['estado'];

    if ($dao->actualizarPropiedad($id, $titulo, $descripcion, $tipo, $precio, $ubicacion, $ancho, $largo, $area, $num_habitaciones, $num_banos, $estacionamiento, $estado)) {
        header("Location: propiedades.php");
        exit();
    } else {
        echo "Error al actualizar la propiedad.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Propiedad</title>
    <link rel="stylesheet" href="css/agregar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../Vista/imgs/logo.png" alt="Inmobiliaria Uriangato">
            <h2>Inmobiliaria Uriangato</h2>
            <p>Admin</p>
        </div>
        <nav>
            <a href="Inicio.php"><i class="fa fa-home"></i> Home</a>
            <a href="propiedades.php" class="active"><i class="fa fa-building"></i> Propiedades</a>
            <a href="Mensaje.php" class=""><i class="fa fa-envelope"></i> Mensajes</a>
            <a href="Mensajes_prop.php" class=""><i class="fa fa-envelope"></i> Mensajes propiedades</a>
            <a href="Ventas.php" class=""><i class="fa fa-dollar-sign"></i>Ventas</a>
            <a href="../Datos/logout.php" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <div class="form-container">
            <div class="form-header">
                <img src="../Vista/imgs/home.png" alt="User Icon">
            </div>
            <h2 class="form-title">Editar Propiedad</h2>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="titulo" value="<?php echo htmlspecialchars($propiedad['titulo']); ?>" required>
                    <input type="text" name="tipo" value="<?php echo htmlspecialchars($propiedad['tipo']); ?>" required>
                </div>
                <div class="form-group full-width">
                    <textarea name="descripcion" required><?php echo htmlspecialchars($propiedad['descripcion']); ?></textarea>
                </div>
                <div class="form-group">
                    <input type="number" step="0.01" name="precio" value="<?php echo $propiedad['precio']; ?>" required>
                    <input type="text" name="ubicacion" value="<?php echo htmlspecialchars($propiedad['ubicacion']); ?>" required>
                </div>
                <div class="form-group">
                    <input type="number" step="0.01" name="ancho" value="<?php echo $propiedad['ancho']; ?>" required>
                    <input type="number" step="0.01" name="largo" value="<?php echo $propiedad['largo']; ?>" required>
                </div>
                <div class="form-group">
                    <input type="number" step="0.01" name="area" value="<?php echo $propiedad['area']; ?>" required>
                    <input type="number" name="num_habitaciones" value="<?php echo $propiedad['num_habitaciones']; ?>" required>
                </div>
                <div class="form-group">
                    <input type="number" name="num_banos" value="<?php echo $propiedad['num_banos']; ?>" required>
                    <input type="number" name="estacionamiento" value="<?php echo $propiedad['estacionamiento']; ?>" required>
                </div>
                <div class="form-group">
                    <select name="estado" required>
                        <option value="">Estado</option>
                        <option value="Disponible" <?php if($propiedad['estado'] == 'Disponible') echo 'selected'; ?>>Disponible</option>
                        <option value="Vendido" <?php if($propiedad['estado'] == 'Vendido') echo 'selected'; ?>>Vendido</option>
                        <option value="Rentado" <?php if($propiedad['estado'] == 'Rentado') echo 'selected'; ?>>Rentado</option>
                    </select>
                </div>

                <!-- Galería de imágenes -->
                <h3>Galería de Imágenes</h3>
                <div class="form-group full-width" style="display: flex; flex-wrap: wrap; gap: 10px;">
                    <?php foreach ($imagenes as $img): ?>
                        <div style="position: relative;">
                            <img src="<?php echo $img['url']; ?>" alt="Imagen" style="height: 100px; border: 1px solid #ccc;">
                            <a href="?id=<?php echo $id; ?>&delete_img=<?php echo $img['id']; ?>" 
                               onclick="return confirm('¿Eliminar esta imagen?');"
                               style="position: absolute; top: 0; right: 0; background: red; color: white; padding: 2px 6px;">X</a>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Subir nueva imagen -->
                <div class="form-group full-width">
                    <label>Agregar nueva imagen:</label>
                    <input type="file" name="nueva_imagen" >
                    <button type="submit" name="subir_imagen" class="submit-btn">Subir Imagen</button>
                </div>

                <button type="submit" name="actualizar" class="submit-btn">Actualizar Propiedad</button>
            </form>
        </div>
    </main>
</body>
</html>
