<?php
session_start();
include '../Datos/conexion.php';

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = intval($_SESSION['user_id']);
$id_propiedad = intval($_GET['id']);

// Obtener los datos de la propiedad para generar el mensaje
$sql = "SELECT titulo, ubicacion FROM propiedades WHERE id = $id_propiedad";
$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Propiedad no encontrada.";
    exit;
}

$propiedad = $result->fetch_assoc();
$titulo = $propiedad['titulo'];
$ubicacion = $propiedad['ubicacion'];

// Registrar en la base de datos
$stmt = $conn->prepare("INSERT INTO solicitudes_contacto_user (id_usuario, id_propiedad) VALUES (?, ?)");
$stmt->bind_param("ii", $id_usuario, $id_propiedad);
$stmt->execute();
$stmt->close();

// Redirigir a WhatsApp
$nombre_usuario = $_SESSION['user_name'];
$mensaje = urlencode("¡Hola! Soy $nombre_usuario y estoy interesado en la propiedad \"$titulo\" ubicada en $ubicacion.");
$telefono = "4433868406";
$wa_url = "https://wa.me/$telefono?text=$mensaje";

header("Location: $wa_url");
exit;
?>
