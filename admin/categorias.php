<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: /controllers/LoginController.php');
    exit;
}
require_once __DIR__ . '/../models/Categoria.php';
$mensaje = '';
// Agregar
if (isset($_POST['agregar'])) {
    if (Categoria::crear($_POST['nombre'], $_POST['tipo'])) {
        $mensaje = 'Categoría agregada correctamente.';
    } else {
        $mensaje = 'Error al agregar.';
    }
}
// Editar
if (isset($_POST['editar'])) {
    if (Categoria::editar($_POST['id'], $_POST['nombre'], $_POST['tipo'])) {
        $mensaje = 'Categoría editada correctamente.';
    } else {
        $mensaje = 'Error al editar.';
    }
}
// Deshabilitar
if (isset($_POST['deshabilitar'])) {
    if (Categoria::deshabilitar($_POST['id'])) {
        $mensaje = 'Categoría deshabilitada.';
    } else {
        $mensaje = 'Error al deshabilitar.';
    }
}
$categorias = Categoria::todas();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h2>Categorías</h2>
        <a href="panel.php" class="btn btn-secondary mb-3">Volver al panel</a>
        <?php if ($mensaje): ?>
            <div class="alert alert-info"><?php echo $mensaje; ?></div>
        <?php endif; ?>
        <form method="post" class="row g-3 mb-4">
            <div class="col-md-4">
                <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>
            </div>
            <div class="col-md-4">
                <select name="tipo" class="form-select" required>
                    <option value="comida">Comida</option>
                    <option value="bebida">Bebida</option>
                    <option value="promocion">Promoción</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" name="agregar" class="btn btn-success w-100">Agregar</button>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categorias as $cat): ?>
                    <tr>
                        <form method="post">
                            <td><?php echo $cat['id']; ?><input type="hidden" name="id" value="<?php echo $cat['id']; ?>"></td>
                            <td><input type="text" name="nombre" value="<?php echo $cat['nombre']; ?>" class="form-control" required></td>
                            <td>
                                <select name="tipo" class="form-select" required>
                                    <option value="comida" <?php if ($cat['tipo'] == 'comida') echo 'selected'; ?>>Comida</option>
                                    <option value="bebida" <?php if ($cat['tipo'] == 'bebida') echo 'selected'; ?>>Bebida</option>
                                    <option value="promocion" <?php if ($cat['tipo'] == 'promocion') echo 'selected'; ?>>Promoción</option>
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