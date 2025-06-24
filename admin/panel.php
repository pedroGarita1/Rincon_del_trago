<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../controllers/LoginController.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-dark bg-warning">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Panel de Administración</span>
            <a href="logout.php" class="btn btn-outline-dark">Cerrar sesión</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h2>Bienvenido</h2>
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <a href="categorias.php" class="btn btn-warning w-100">Categorías</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="productos.php" class="btn btn-warning w-100">Productos</a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="promociones.php" class="btn btn-warning w-100">Promociones</a>
            </div>
        </div>
    </div>
</body>

</html>