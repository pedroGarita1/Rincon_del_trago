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
    $imagen = '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $permitidas) && exif_imagetype($tmp_name)) {
            $nuevo_nombre = uniqid('prod_') . '.' . $ext;
            move_uploaded_file($tmp_name, __DIR__ . '/../settings/img/' . $nuevo_nombre);
            $imagen = $nuevo_nombre;
        }
    }
    Producto::crear($_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $imagen, $_POST['categoria_id']);
    header('Location: productos.php');
    exit;
}
// Editar
if (isset($_POST['editar'])) {
    $imagen = $_POST['imagen_actual'] ?? '';
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['imagen']['tmp_name'];
        $ext = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (in_array($ext, $permitidas) && exif_imagetype($tmp_name)) {
            $nuevo_nombre = uniqid('prod_') . '.' . $ext;
            move_uploaded_file($tmp_name, __DIR__ . '/../settings/img/' . $nuevo_nombre);
            $imagen = $nuevo_nombre;
        }
    }
    Producto::editar($_POST['id'], $_POST['nombre'], $_POST['descripcion'], $_POST['precio'], $imagen, $_POST['categoria_id']);
    header('Location: productos.php');
    exit;
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
        <form method="post" class="row g-3 mb-4" enctype="multipart/form-data">
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
                <input type="file" name="imagen" class="form-control" accept="image/*">
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
                        <form method="post" enctype="multipart/form-data">
                            <td><?php echo $prod['id']; ?><input type="hidden" name="id" value="<?php echo $prod['id']; ?>"></td>
                            <td><input type="text" name="nombre" value="<?php echo $prod['nombre']; ?>" class="form-control" required></td>
                            <td><input type="text" name="descripcion" value="<?php echo $prod['descripcion']; ?>" class="form-control" required></td>
                            <td><input type="number" step="0.01" name="precio" value="<?php echo $prod['precio']; ?>" class="form-control" required></td>
                            <td style="min-width:120px">
                                <?php if ($prod['imagen']): ?>
                                    <img src="../settings/img/<?php echo $prod['imagen']; ?>" alt="img" style="max-width:50px;max-height:50px;object-fit:cover;display:block;margin-bottom:2px;">
                                    <small class="text-muted d-block mb-1"><?php echo $prod['imagen']; ?></small>
                                <?php else: ?>
                                    <span class="text-muted">Sin imagen</span>
                                <?php endif; ?>
                                <input type="file" name="imagen" class="form-control" accept="image/*">
                                <input type="hidden" name="imagen_actual" value="<?php echo $prod['imagen']; ?>">
                            </td>
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