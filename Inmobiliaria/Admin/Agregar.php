<?php
include("../Conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar datos del formulario
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

    // Insertar en la tabla propiedades con id_usuario = 1
    $sql = "INSERT INTO propiedades 
    (titulo, descripcion, tipo, precio, ubicacion, ancho, largo, area, num_habitaciones, num_banos, estacionamiento, estado, id_usuario) 
    VALUES 
    ('$titulo', '$descripcion', '$tipo', '$precio', '$ubicacion', '$ancho', '$largo', '$area', '$num_habitaciones', '$num_banos', '$estacionamiento', '$estado', 1)";

    if ($conn->query($sql) === TRUE) {
        $id = $conn->insert_id; // ID de la propiedad recién insertada
        
        // Crear carpeta para la propiedad
        $carpeta = "../Casas/" . $id;
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true); 
        }

        // Procesar imágenes
        if (!empty($_FILES['imagenes']['name'][0])) {
            $total = count($_FILES['imagenes']['name']);
            for ($i = 0; $i < $total; $i++) {
                $tmp_name = $_FILES['imagenes']['tmp_name'][$i];
                $ext = pathinfo($_FILES['imagenes']['name'][$i], PATHINFO_EXTENSION);

                if ($i == 0) {
                    $nombre_imagen = "Principal." . $ext;
                } else {
                    $nombre_imagen = ($i) . "." . $ext;
                }

                $ruta_destino = $carpeta . "/" . $nombre_imagen;

                if (move_uploaded_file($tmp_name, $ruta_destino)) {
                    // Insertar en multimedia
                    $url = "/WebIII/Inmobiliaria/Casas/" . $id . "/" . $nombre_imagen;
                    $sql_multimedia = "INSERT INTO multimedia (id_propiedad, tipo, url, fecha_subida) VALUES ($id, 'Imagen', '$url', NOW())";
                    $conn->query($sql_multimedia);
                }
            }
        }

        header("Location: propiedades.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Propiedad</title>
    <link rel="stylesheet" href="css/agregar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../imgs/logo.png" alt="Inmobiliaria Uriangato">
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
                <img src="../imgs/home.png" alt="User Icon">
            </div>
            <h2 class="form-title">Agregar Propiedad</h2>
            <form action="agregar.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input type="text" name="titulo" placeholder="Título" required>
                    <input type="text" name="tipo" placeholder="Tipo" required>
                </div>
                <div class="form-group full-width">
                    <textarea name="descripcion" placeholder="Descripción" required></textarea>
                </div>
                <div class="form-group">
                    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
                    <input type="text" name="ubicacion" placeholder="Ubicación" required>
                </div>
                <div class="form-group">
                    <input type="number" step="0.01" name="ancho" placeholder="Ancho (m)" required>
                    <input type="number" step="0.01" name="largo" placeholder="Largo (m)" required>
                </div>
                <div class="form-group">
                    <input type="number" step="0.01" name="area" placeholder="Área (m²)" required>
                    <input type="number" name="num_habitaciones" placeholder="Habitaciones" required>
                </div>
                <div class="form-group">
                    <input type="number" name="num_banos" placeholder="Baños" required>
                    <input type="number" name="estacionamiento" placeholder="Estacionamiento" required>
                </div>
                <div class="form-group">
                    <select name="estado" required>
                        <option value="">Estado</option>
                        <option value="Disponible">Disponible</option>
                        <option value="Vendido">Vendido</option>
                        <option value="Rentado">Rentado</option>
                    </select>
                </div>
                <div class="form-group full-width">
                    <label for="imagenes">Subir Imágenes:</label>
                    <input type="file" name="imagenes[]" multiple accept="image/*" required>
                </div>
                <button type="submit" class="submit-btn">Registrar Propiedad</button>
            </form>
        </div>
    </main>
</body>
</html>
