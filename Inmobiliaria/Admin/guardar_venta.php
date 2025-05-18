<?php
require_once '../Datos/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cliente = trim($_POST['cliente']);
    $propiedad = trim($_POST['propiedad']);
    $fecha = $_POST['fecha'];
    $monto = floatval($_POST['monto']);
    $estado = $_POST['estado'];
    $tipo_propiedad = $_POST['tipo_propiedad'];


    if (empty($cliente) || empty($propiedad) || empty($fecha) || empty($monto) || empty($estado)) {
        die("Todos los campos son obligatorios.");
    }

    // Insertar la venta
    $stmt = $conn->prepare("INSERT INTO ventas (cliente, propiedad, fecha, monto, estado, tipo_propiedad) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssdss", $cliente, $propiedad, $fecha, $monto, $estado, $tipo_propiedad);

    if ($stmt->execute()) {
        // Cambiar estado de la propiedad a 'Vendida'
        $update = $conn->prepare("UPDATE propiedades SET estado = 'Vendido' WHERE id = ?");
        $update->bind_param("s", $propiedad);
        $update->execute();
        $update->close();

        header("Location: Ventas.php?exito=1");
        exit();
    } else {
        echo "Error al guardar la venta: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Acceso no permitido.";
}

$conn->close();
