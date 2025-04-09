<?php
include("../Datos/Conexion.php");

$id = $_GET['id'] ?? null;
$telefono = $_GET['telefono'] ?? null;
$usuario = $_GET['usuario'] ?? null;
$propiedad = $_GET['propiedad'] ?? null;

if ($id && $telefono && $usuario && $propiedad) {
    $sql_update = "UPDATE solicitudes_contacto_user SET respondido = 1 WHERE id = $id";
    if ($conn->query($sql_update) === TRUE) {
        $mensaje = "Hola%20$usuario,%20estamos%20respondiendo%20tu%20mensaje%20sobre%20la%20propiedad%20$propiedad.";
        $link_whatsapp = "https://wa.me/52$telefono?text=$mensaje";
        header("Location: $link_whatsapp");
        exit;
    } else {
        echo "Error al actualizar el estado del mensaje.";
    }
} else {
    echo "Error: datos incompletos.";
}
?>
