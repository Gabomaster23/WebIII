<?php
include("../Datos/Conexion.php");

$id = $_GET['id'] ?? null;

if ($id) {
    $sql = "SELECT * FROM solicitudes_contacto WHERE id = $id";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        $telefono = preg_replace('/[^0-9]/', '', $row['telefono']);
        $nombre = $row['nombre'];
        $mensaje = "Bienvenido a Inmobiliaria Uriangato, $nombre. ¿En qué puedo servirte?";
        $link = "https://wa.me/52$telefono?text=" . urlencode($mensaje);

        $conn->query("UPDATE solicitudes_contacto SET respondido = 1 WHERE id = $id");
        header("Location: $link");
        exit;
    }
}
echo "Error: mensaje no encontrado.";
?>
