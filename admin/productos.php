<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: /controllers/LoginController.php');
    exit;
}
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Categoria.php';
$mensaje = '';
$categorias = Categoria::todas();
// Agregar
if (isset($_POST['agregar'])) {
    if (Producto::crear($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen'], $_POST['categoria_id'])) {
        $mensaje = 'Producto agregado correctamente.';
    } else {
        $mensaje = 'Error al agregar.';
    }
}
// Editar
if (isset($_POST['editar'])) {
    if (Producto::editar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $_POST['imagen'], $_POST['categoria_id'])) {
        $mensaje = 'Producto editado correctamente.';
    } else {
        $mensaje = 'Error al editar.';
    }
}
// Deshabilitar
if (isset($_POST['deshabilitar'])) {
    if (Producto::deshabilitar($_POST['id'])) {
        $mensaje = 'Producto deshabilitado.';
    } else {
        $mensaje = 'Error al deshabilitar.';
    }
}
$productos = Producto::todos();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Productos</h2>
        <a href="panel.php" class="btn btn-secondary mb-3">Volver al panel</a>
        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="post" class="row g-3 mb-4">
            <div class="col-md-2">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required>
            </div>
            <div class="col-md-2">
                <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio" required>
            </div>
            <div class="col-md-2">
                <input type="text" name="imagen" class="form-control" placeholder="Imagen (ej: boneless.jpg)" required>
            </div>
            <div class="col-md-2">
                <select name="categoria_id" class="form-select" required>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?php echo $cat['id']; ?>"><?php echo $cat['nombre']; ?></option>
                    <?php
                    endforeach; ?>
                </select>
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
                    <th>Categoría</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $prod): ?>
                    <tr>
                        <form method="post">
                            <td><?php echo $prod['id']; ?><input type="hidden" name="id" value="<?php echo $prod['id']; ?>"></td>
                            <td><input type="text" name="nombre" value="<?php echo $prod['nombre']; ?>" class="form-control" required></td>
                            <td><input type="text" name="descripcion" value="<?php echo $prod['descripcion']; ?>" class="form-control" required></td>
                            <td><input type="number" step="0.01" name="precio" value="<?php echo $prod['precio']; ?>" class="form-control" required></td>
                            <td><input type="text" name="imagen" value="<?php echo $prod['imagen']; ?>" class="form-control" required></td>
                            <td>
                                <select name="categoria_id" class="form-select" required>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?php echo $cat['id']; ?>" <?php if ($prod['categoria_id'] == $cat['id']) echo 'selected'; ?>><?php echo $cat['nombre']; ?></option>
                                    <?php
                                    endforeach; ?>
                                </select>
                            </td>
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