<?php
require_once '../Datos/conexion.php';

// Obtener clientes
$sqlClientes = "SELECT id, nombre FROM usuarios ORDER BY nombre ASC";
$resultadoClientes = $conn->query($sqlClientes);
$usuarios = $resultadoClientes->fetch_all(MYSQLI_ASSOC);

// Obtener propiedades
$sqlPropiedades = "SELECT id, titulo, precio FROM propiedades WHERE estado ='Disponible' ORDER BY titulo ASC";
$resultadoPropiedades = $conn->query($sqlPropiedades);
$propiedades = $resultadoPropiedades->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Ventas</title>
    <link rel="stylesheet" href="css/propiedades.css">
    <link rel="stylesheet" href="css/ventas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 8px; border: 1px solid #ccc; text-align: center; }
        form { margin-top: 20px; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="logo">
        <img src="../Vista/imgs/logo.png" alt="Inmobiliaria Uriangato">
        <h2>Inmobiliaria Uriangato</h2>
        <p>Admin</p>
    </div>
    <nav>
        <a href="Inicio.php"><i class="fa fa-home"></i> Home</a>
        <a href="propiedades.php"><i class="fa fa-building"></i> Propiedades</a>
        <a href="Mensaje.php"><i class="fa fa-envelope"></i> Mensajes</a>
        <a href="Mensajes_prop.php"><i class="fa fa-envelope"></i> Mensajes propiedades</a>
        <a href="Ventas.php" class="active"><i class="fa fa-dollar-sign"></i> Ventas</a>
        <a href="../Datos/logout.php" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
    </nav>
</aside>

<main class="main-content">
    <header class="top-bar">
        <h2>Gestión de Ventas</h2>
    </header>

    <!-- Formulario de Registro -->
    <form method="POST" action="guardar_venta.php">
        <label for="cliente">Cliente:</label>
        <select id="cliente" name="cliente" required>
            <option value="">Seleccione un cliente</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?= $usuario['id'] ?>"><?= htmlspecialchars($usuario['nombre']) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="propiedad">Propiedad:</label>
        <select id="propiedad" name="propiedad" required onchange="actualizarMonto()">
            <option value="">Seleccione una propiedad</option>
            <?php foreach ($propiedades as $propiedad): ?>
                <option value="<?= $propiedad['id'] ?>" data-precio="<?= $propiedad['precio'] ?>">
                    <?= htmlspecialchars($propiedad['titulo']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="monto_mostrar">Monto:</label>
        <input type="text" id="monto_mostrar" disabled>

        <input type="hidden" id="monto" name="monto">

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado">
            <option value="En proceso">En proceso</option>
            <option value="Finalizada">Finalizada</option>
            <option value="Cancelada">Cancelada</option>
        </select>

        <button type="submit"><i class="fa fa-plus"></i> Registrar Venta</button>
    </form>

    <script>
    function actualizarMonto() {
        const propiedadSelect = document.getElementById('propiedad');
        const selectedOption = propiedadSelect.options[propiedadSelect.selectedIndex];
        const precio = selectedOption.getAttribute('data-precio') || 0;
        document.getElementById('monto').value = precio;
        document.getElementById('monto_mostrar').value = '$' + parseFloat(precio).toFixed(2);
    }
    </script>

    <!-- Tabla de Ventas -->
    <h3>Ventas Registradas</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Propiedad</th>
                <th>Fecha</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sqlVentas = "
            SELECT v.id, u.nombre AS cliente, p.titulo AS propiedad, v.fecha, v.monto, v.estado
            FROM ventas v
            INNER JOIN usuarios u ON v.cliente = u.id
            INNER JOIN propiedades p ON v.propiedad = p.id
            ORDER BY v.fecha DESC
            ";
            $resultadoVentas = $conn->query($sqlVentas);
            while ($row = $resultadoVentas->fetch_assoc()):
            ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['cliente']) ?></td>
                <td><?= htmlspecialchars($row['propiedad']) ?></td>
                <td><?= $row['fecha'] ?></td>
                <td>$<?= number_format($row['monto'], 2) ?></td>
                <td><?= $row['estado'] ?></td>
                <td>
                    <a href="editar_venta.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="eliminar_venta.php?id=<?= $row['id'] ?>" onclick="return confirm('¿Estás seguro?')">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</main>
</body>
</html>
