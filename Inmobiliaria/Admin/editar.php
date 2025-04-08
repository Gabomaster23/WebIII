<?php
include("Conexion.php");
require_once("../Datos/DAOPropiedades.php");

// Validar que venga el id
if (!isset($_GET['id'])) {
    header("Location: propiedades.php");
    exit();
}

$id = $_GET['id'];

// Obtener datos actuales
$dao = new DAOPropiedades();
$propiedad = $dao->obtenerPropiedadPorId($id);

if (!$propiedad) {
    header("Location: propiedades.php");
    exit();
}

// Actualizar datos si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
            <a href="#" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenedor principal -->
    <main class="main-content">
        <div class="form-container">
            <div class="form-header">
                <img src="../Vista/imgs/home.png" alt="User Icon">
            </div>
            <h2 class="form-title">Editar Propiedad</h2>
            <form action="" method="POST">
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
                <button type="submit" class="submit-btn">Actualizar Propiedad</button>
            </form>
        </div>
    </main>
</body>
</html>
