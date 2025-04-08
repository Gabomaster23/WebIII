<?php
require_once '../Datos/conexion.php';

// Tipos posibles y sus iconos correspondientes
$tipos_posibles = [
    'Casa' => 'fa-home',
    'Departamento' => 'fa-city',
    'Edificio' => 'fa-building',
    'Bodega' => 'fa-warehouse',
    'Oficina' => 'fa-briefcase',
    'Local Comercial' => 'fa-store',
    'Terreno' => 'fa-map-marked-alt'
];

// Inicializar cantidades en 0
$tipos_propiedad = array_fill_keys(array_keys($tipos_posibles), 0);

// Consulta para contar propiedades por tipo
$sql = "SELECT tipo, COUNT(*) as cantidad FROM propiedades GROUP BY tipo";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tipo = $row['tipo'];
        if (array_key_exists($tipo, $tipos_propiedad)) {
            $tipos_propiedad[$tipo] = $row['cantidad'];
        }
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Inmobiliaria</title>
    <link rel="stylesheet" href="css/inicio.css">
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
            <a href="Inicio.php" class="active"><i class="fa fa-home"></i> Home</a>
            <a href="propiedades.php"><i class="fa fa-building"></i> Propiedades</a>
            <a href="#" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <header class="top-bar">
            <input type="text" placeholder="Buscar...">
            <i class="fa fa-bell"></i>
        </header>

        <section class="dashboard">
            <?php foreach ($tipos_propiedad as $tipo => $cantidad): ?>
                <div class="card">
                    <div class="card-header">
                        <i class="fa <?= $tipos_posibles[$tipo] ?>"></i>
                        <p><?= $tipo ?></p>
                    </div>
                    <h3><?= $cantidad ?></h3>
                </div>
            <?php endforeach; ?>
        </section>
    </main>

</body>
</html>

