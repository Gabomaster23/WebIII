<?php
require_once '../Datos/conexion.php';

if (!isset($_GET['id'])) {
    die("ID de venta no especificado.");
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("DELETE FROM ventas WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: Ventas.php?eliminado=1");
    exit();
} else {
    echo "Error al eliminar: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
