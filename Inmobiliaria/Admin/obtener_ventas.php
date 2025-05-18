<?php
include("../Datos/conexion.php"); // Asegúrate que este archivo tiene tu conexión

$fecha_inicio = $_GET['inicio'];
$fecha_fin = $_GET['fin'];

$query = "SELECT fecha, monto, tipo_propiedad FROM ventas 
          WHERE fecha BETWEEN ? AND ? AND estado = 'Finalizada'";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $fecha_inicio, $fecha_fin);
$stmt->execute();
$result = $stmt->get_result();

$ventas = [];
while ($row = $result->fetch_assoc()) {
    $ventas[] = $row;
}

echo json_encode($ventas);
?>
