<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador - Inmobiliaria</title>
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="../imgs/logo.png" alt="Inmobiliaria Uriangato">
            <h2>Inmobiliaria Uriangato</h2>
            <p>Admin</p>
        </div>
        <nav>
            <a href="Inicio.php" class="active"><i class="fa fa-home"></i> Home</a>
            <a href="propiedades.php"><i class="fa fa-building"></i> Propiedades</a>
            <a href="#" class="logout"><i class="fa fa-sign-out-alt"></i> Logout</a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <header class="top-bar">
            <input type="text" placeholder="Buscar...">
            <i class="fa fa-bell"></i>
        </header>

        <section class="dashboard">
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-home"></i>
                    <p>Casas</p>
                </div>
                <h3>100</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-city"></i>
                    <p>Departamentos</p>
                </div>
                <h3>50</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-building"></i>
                    <p>Edificios</p>
                </div>
                <h3>200</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-warehouse"></i>
                    <p>Bodegas</p>
                </div>
                <h3>200</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-briefcase"></i>
                    <p>Oficinas</p>
                </div>
                <h3>100</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-store"></i>
                    <p>Locales Comerciales</p>
                </div>
                <h3>50</h3>
            </div>
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-map-marked-alt"></i>
                    <p>Terrenos</p>
                </div>
                <h3>30</h3>
            </div>
        </section>
    </main>

</body>
</html>
