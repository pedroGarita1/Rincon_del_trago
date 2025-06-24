<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: /controllers/LoginController.php');
    exit;
}
require_once __DIR__ . '/../models/Promocion.php';
$mensaje = '';
// Agregar
if (isset($_POST['agregar'])) {
    if (Promocion::crear($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen'])) {
        $mensaje = 'Promoción agregada correctamente.';
    } else {
        $mensaje = 'Error al agregar.';
    }
}
// Editar
if (isset($_POST['editar'])) {
    if (Promocion::editar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen'])) {
        $mensaje = 'Promoción editada correctamente.';
    } else {
        $mensaje = 'Error al editar.';
    }
}
// Deshabilitar
if (isset($_POST['deshabilitar'])) {
    if (Promocion::deshabilitar($_POST['id'])) {
        $mensaje = 'Promoción deshabilitada.';
    } else {
        $mensaje = 'Error al deshabilitar.';
    }
}
$promociones = Promocion::todas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Promociones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Promociones</h2>
        <a href="panel.php" class="btn btn-secondary mb-3">Volver al panel</a>
        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="post" class="row g-3 mb-4">
            <div class="col-md-3">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="imagen" class="form-control" placeholder="Imagen (opcional)">
            </div>
            <div class="col-md-2">
                <button type="submit" name="agregar" class="btn btn-success w-100">Agregar</button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($promociones as $promo): ?>
                    <tr>
                        <form method="post">
                            <td><?php echo $promo['id']; ?><input type="hidden" name="id" value="<?php echo $promo['id']; ?>"></td>
                            <td><input type="text" name="nombre" value="<?php echo $promo['nombre']; ?>" class="form-control" required></td>
                            <td><input type="text" name="descripcion" value="<?php echo $promo['descripcion']; ?>" class="form-control" required></td>
                            <td><input type="number" step="0.01" name="precio" value="<?php echo $promo['precio']; ?>" class="form-control" required></td>
                            <td><input type="text" name="imagen" value="<?php echo $promo['imagen']; ?>" class="form-control"></td>
                            <td>
                                <button type="submit" name="editar" class="btn btn-primary btn-sm">Editar</button>
                                <button type="submit" name="deshabilitar" class="btn btn-danger btn-sm" onclick="return confirm('¿Deshabilitar?')">Deshabilitar</button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>