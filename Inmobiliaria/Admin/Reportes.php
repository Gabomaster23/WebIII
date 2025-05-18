<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Inmobiliaria</title>
    <link rel="stylesheet" href="css/reporte.css">
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
            <a href="Inicio.php" class=""><i class="fa fa-home"></i> Home</a>
            <a href="propiedades.php"><i class="fa fa-building"></i> Propiedades</a>
            <a href="Mensaje.php" class=""><i class="fa fa-envelope"></i> Mensajes</a>
            <a href="Mensajes_prop.php" class=""><i class="fa fa-envelope"></i> Mensajes propiedades</a>
            <a href="Ventas.php" class=""><i class="fa fa-dollar-sign"></i>Ventas</a>
            <a href="Reportes.php" class="active"><i class="fa fa-chart-bar"></i>Reportes</a>
            <a href="../Datos/logout.php" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenido principal -->
<main class="main-content">
  <h2>Reporte de ventas</h2>

  <div class="filtros-fechas">
    <div class="filtro">
      <label for="fecha_inicio">Fecha de inicio:</label>
      <input type="date" id="fecha_inicio" placeholder="Selecciona la fecha">
    </div>
    <div class="filtro">
      <label for="fecha_fin">Fecha de fin:</label>
      <input type="date" id="fecha_fin" placeholder="Selecciona la fecha">
    </div>
    <button class="boton-reporte" onclick="generarReporte()">Generar Reporte</button>
  </div>

  <canvas id="graficaVentas" width="1000" height="400"></canvas>

  <div id="resumen">
    <div>
      <p>Ventas totales: <span id="ventasTotales">$0.00</span></p>
      <p>Número de ventas: <span id="numeroVentas">0</span></p>
    </div>
    <div id="ventasPorSeccion">
      <!-- Aquí se llenan las ventas por sección dinámicamente -->
    </div>
  </div>
</main>
    <script src="js/generarReporte.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
document.addEventListener('DOMContentLoaded', function () {
    const hoy = new Date().toISOString().split('T')[0];
    document.getElementById('fecha_inicio').setAttribute('max', hoy);
    document.getElementById('fecha_fin').setAttribute('max', hoy);
});
</script>

</body>
</html>

