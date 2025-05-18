<?php
require_once '../Datos/conexion.php';

if (!isset($_GET['id'])) {
    die("ID de venta no especificado.");
}

$id = intval($_GET['id']);

// Si se envió el formulario para actualizar
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = trim($_POST['cliente']);
    $propiedad = trim($_POST['propiedad']);
    $fecha = $_POST['fecha'];
    $monto = floatval($_POST['monto']);
    $estado = $_POST['estado'];

    // Preparar la consulta para actualizar la venta
    $stmt = $conn->prepare("UPDATE ventas SET cliente=?, propiedad=?, fecha=?, monto=?, estado=? WHERE id=?");
    $stmt->bind_param("sssdsi", $cliente, $propiedad, $fecha, $monto, $estado, $id);

    if ($stmt->execute()) {
        // Si el estado de la venta es 'Cancelada', actualizar el estado de la propiedad a 'Disponible'
        if ($estado == 'Cancelada') {
            $updatePropiedad = $conn->prepare("UPDATE propiedades SET estado = 'Disponible' WHERE id = ?");
            $updatePropiedad->bind_param("i", $propiedad);
            $updatePropiedad->execute();
            $updatePropiedad->close();
        } else if ($estado == 'Finalizada') {
            $updatePropiedad = $conn->prepare("UPDATE propiedades SET estado = 'Vendido' WHERE id = ?");
            $updatePropiedad->bind_param("i", $propiedad);
            $updatePropiedad->execute();
            $updatePropiedad->close();
        }

        header("Location: Ventas.php?editado=1");
        exit();
    } else {
        echo "Error al actualizar: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Obtener los datos actuales de la venta
    $stmt = $conn->prepare("SELECT * FROM ventas WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 0) {
        die("Venta no encontrada.");
    }

    $venta = $resultado->fetch_assoc();
    $stmt->close();

    // Obtener el nombre del cliente
    $clienteId = $venta['cliente'];
    $stmtCliente = $conn->prepare("SELECT nombre FROM usuarios WHERE id=?");
    $stmtCliente->bind_param("i", $clienteId);
    $stmtCliente->execute();
    $resultadoCliente = $stmtCliente->get_result();
    $cliente = $resultadoCliente->fetch_assoc();
    $venta['cliente_nombre'] = $cliente['nombre'];
    $stmtCliente->close();

    // Obtener el título de la propiedad
    $propiedadId = $venta['propiedad'];
    $stmtPropiedad = $conn->prepare("SELECT titulo FROM propiedades WHERE id=?");
    $stmtPropiedad->bind_param("i", $propiedadId);
    $stmtPropiedad->execute();
    $resultadoPropiedad = $stmtPropiedad->get_result();
    $propiedad = $resultadoPropiedad->fetch_assoc();
    $venta['propiedad_titulo'] = $propiedad['titulo'];
    $stmtPropiedad->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Venta</title>
    <link rel="stylesheet" href="css/ventas.css">
</head>
<body>
    <h2>Editar Venta</h2>
<form method="POST">
    <label>Cliente:</label>
    <input type="text" disabled value="<?= htmlspecialchars($venta['cliente_nombre']) ?>"><br>
    <input type="hidden" name="cliente" value="<?= $venta['cliente'] ?>">

    <label>Propiedad:</label>
    <input type="text" disabled value="<?= htmlspecialchars($venta['propiedad_titulo']) ?>"><br>
    <input type="hidden" name="propiedad" value="<?= $venta['propiedad'] ?>">

    <label>Fecha:</label>
    <input type="date" name="fecha" value="<?= $venta['fecha'] ?>" required><br>

    <label>Monto:</label>
    <input type="number" disabled step="0.01" value="<?= $venta['monto'] ?>"><br>
    <input type="hidden" name="monto" value="<?= $venta['monto'] ?>">

    <label>Estado:</label>
    <select name="estado">
        <option value="En proceso" <?= $venta['estado'] == 'En proceso' ? 'selected' : '' ?>>En proceso</option>
        <option value="Finalizada" <?= $venta['estado'] == 'Finalizada' ? 'selected' : '' ?>>Finalizada</option>
        <option value="Cancelada" <?= $venta['estado'] == 'Cancelada' ? 'selected' : '' ?>>Cancelada</option>
    </select><br><br>

    <button type="submit">Guardar cambios</button>
</form>

    <br>
    <a href="Ventas.php">Volver</a>
</body>
</html>
