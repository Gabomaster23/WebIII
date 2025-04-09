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
            <a href="propiedades.php" class="active"><i class="fa fa-building"></i> Propiedades</a>
            <a href="Mensaje.php" class=""><i class="fa fa-building"></i> Mensajes</a>
            <a href="Mensajes_prop.php" class=""><i class="fa fa-envelope"></i> Mensajes propiedades</a>
            <a href="../Datos/logout.php" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenido Principal -->
    <main class="main-content">
        <header class="top-bar">
            <input type="text" placeholder="Buscar...">
            <i class="fa fa-bell"></i>
            <a href="Agregar.php" class="btn-agregar"> Agregar propiedad</a>
        </header>

        <section class="lista-propiedades">
            <h2>Lista de propiedades</h2>
            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <?php include("../Datos/Conexion.php"); ?>
                <tbody>
                <?php
                $sql = "SELECT * FROM propiedades";
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                    // Consultamos la imagen principal
                    $id = $row['id'];
                    $img_sql = "SELECT url FROM multimedia WHERE id_propiedad = $id LIMIT 1";
                    $img_result = $conn->query($img_sql);
                    $img_row = $img_result->fetch_assoc();
                    $img = $img_row ? $img_row['url'] : '../imgs/no-image.png';

                    echo "<tr>";
                    echo "<td><img src='$img' alt='Propiedad'></td>";
                    echo "<td>".$row['titulo']."</td>";
                    echo "<td>".$row['ubicacion']."</td>";
                    echo "<td>$".$row['precio']."</td>";
                    echo "<td>".$row['estado']."</td>";
                    echo "<td>
                            <a href='editar.php?id=".$row['id']."' class='fa fa-edit'></a>
                            <a href='eliminar.php?id=".$row['id']."' class='fa fa-trash' onclick='return confirm(\"¿Seguro de eliminar?\")'></a>
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
