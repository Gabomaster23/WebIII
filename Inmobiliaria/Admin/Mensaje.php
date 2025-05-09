<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Inmobiliaria</title>
    <link rel="stylesheet" href="css/propiedades.css">
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
            <a href="Inicio.php" ><i class="fa fa-home"></i> Home</a>
            <a href="propiedades.php" class=""><i class="fa fa-building"></i> Propiedades</a>
            <a href="Mensaje.php" class="active"><i class="fa fa-building"></i> Mensajes</a>
            <a href="Mensajes_prop.php" class=""><i class="fa fa-envelope"></i> Mensajes propiedades</a>
            <a href="Ventas.php" class=""><i class="fa fa-dollar-sign"></i>Ventas</a>
            <a href="../Datos/logout.php" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenido Principal -->
    <main class="main-content">
        <header class="top-bar">
            <input type="text" placeholder="Buscar...">
            <i class="fa fa-bell"></i>
        </header>

        <section class="lista-propiedades">
            <h2>Lista de Mensajes</h2>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Mensaje</th>
                        <th>Atendido</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php include("../Datos/Conexion.php"); ?>
                <tbody>
                <?php
$sql = "SELECT * FROM solicitudes_contacto";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>".$row['nombre']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['telefono']."</td>";
    echo "<td>".$row['mensaje']."</td>";
          // Columna de respondido
          if ($row['respondido']) {
            $estado = "<i class='fa fa-check-circle' style='color:green; font-size:18px;' title='Respondido'></i>";
        } else {
            $estado = "<i class='fa fa-times-circle' style='color:red; font-size:18px;' title='No respondido'></i>";
        }
        echo "<td>$estado</td>";
    echo "<td>".$row['fecha']."</td>";


    // Columna de acciones (WhatsApp)
    $link = "responder.php?id=" . $row['id'];
    echo "<td>
            <a href='$link' class='fa fa-envelope' title='Enviar WhatsApp' target='_blank' style='color:green; font-size:18px;'></a>
          </td>";
    echo "</tr>";
}
?>



                </tbody>

            </table>
        </div>
        </section>
    </main>

</body>
</html>
