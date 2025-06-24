<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// index.php - Vista pública del menú (estructura inicial, aún sin conexión a BD)
// TODO: Reemplazar el contenido estático por consultas dinámicas a la base de datos
require_once __DIR__ . '/models/Promocion.php';
require_once __DIR__ . '/models/Producto.php';
require_once __DIR__ . '/models/Categoria.php';
$promociones = Promocion::todas();
$productos = Producto::todos();
$categorias = Categoria::todas();
// Buscar la categoría de comida
$categoriaComida = null;
foreach ($categorias as $cat) {
    if ($cat['tipo'] === 'comida') {
        $categoriaComida = $cat;
        break;
    }
}
$productosComida = array_filter($productos, function ($p) use ($categoriaComida) {
    return $p['categoria_id'] == $categoriaComida['id'];
});
// Bebidas: buscar la categoría principal y subcategorías
$categoriaBebidas = null;
foreach ($categorias as $cat) {
    if ($cat['tipo'] === 'bebida' && $cat['parent_id'] === null) {
        $categoriaBebidas = $cat;
        break;
    }
}
$subcategoriasBebidas = array_filter($categorias, function ($c) use ($categoriaBebidas) {
    return $c['parent_id'] == $categoriaBebidas['id'];
});
//header('Location: controllers/MenuController.php');
//exit;
?>
<!-- INICIO DEL CONTENIDO MIGRADO DE index.html -->
<?php // Aquí irá el HTML migrado, por ahora solo la estructura base 
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Trago - Menú</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./settings/css/style.css">
    <style>
        body {
            background-color: #fff8f0;
            font-family: 'Segoe UI', sans-serif;
        }

        html {
            scroll-behavior: smooth;
        }

        .menu-header {
            background-color: #ff6600;
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .menu-section {
            margin-top: 2rem;
        }

        .section-title {
            border-bottom: 3px solid #ff6600;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
            color: #ff6600;
        }

        .menu-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .menu-card:hover {
            transform: scale(1.02);
        }

        .menu-img {
            height: 200px;
            object-fit: cover;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .menu-price {
            font-weight: bold;
            color: #ff6600;
            font-size: 1.2rem;
        }

        .nav-wrapper {
            background: linear-gradient(to right, #ff6600, #ff944d);
            padding: 0.5rem 0;
            border-bottom: 2px solid #ff6600;
        }

        .nav-tabs .nav-link {
            color: white;
            font-weight: 500;
            border-radius: 20px;
            margin: 0 0.25rem;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.15);
        }

        .nav-tabs .nav-link.active {
            background-color: white;
            color: #ff6600;
            font-weight: bold;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: #fff;
        }
    </style>
</head>

<body>
    <!-- INICIO DEL BODY DE INDEX.HTML -->
    <header class="menu-header">
        <h1>🌮🍹 EL RINCÓN DEL TRAGO 🍗🥂</h1>
        <p>¡Disfruta de nuestros deliciosos platillos y bebidas!</p>
    </header>
    <nav class="sticky-top z-3 nav-wrapper shadow-sm">
        <ul class="nav nav-tabs container justify-content-center">
            <li class="nav-item">
                <a class="nav-link active" href="#combos">Combos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#comida">Comida</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#bebidas">Bebidas</a>
            </li>
        </ul>
    </nav>
    <section id="combos" style="background-color: #ffe5cc; padding: 2rem;">
        <div class="container text-center">
            <h2 style="color: #cc4400; font-weight: bold; margin-bottom: 1.5rem;">🛸💥 PAQUETES ESPACIALES</h2>
            <div class="row g-4 justify-content-center">
                <?php foreach ($promociones as $promo): ?>
                    <div class="col-md-5 mb-3">
                        <div class="card h-100 menu-card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-warning fw-bold"><?php echo htmlspecialchars($promo['nombre']); ?></h5>
                                <p class="text-muted"><?php echo htmlspecialchars($promo['descripcion']); ?></p>
                                <span class="menu-price text-warning fw-bold">$<?php echo number_format($promo['precio'], 2); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section id="comida" class="menu-section">
        <div class="container mt-5">
            <h2 class="section-title">🍗🛸 COMIDA GALÁCTICA</h2>
            <div class="row justify-content-center g-4">
                <?php foreach ($productosComida as $prod): ?>
                    <div class="col-md-4">
                        <div class="card h-100 menu-card">
                            <img src="./settings/img/<?php echo htmlspecialchars($prod['imagen']); ?>" class="card-img-top menu-img" alt="<?php echo htmlspecialchars($prod['nombre']); ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?php echo htmlspecialchars($prod['nombre']); ?></h5>
                                <p class="menu-price"><?php echo htmlspecialchars($prod['descripcion']); ?></p>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalComida<?php echo $prod['id']; ?>">Ver más</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <section id="bebidas" class="menu-section">
        <div class="container mt-5">
            <h2 class="section-title">🍹✨ BEBIDAS DEL COSMOS</h2>
            <div class="row justify-content-center g-4">
                <?php foreach ($subcategoriasBebidas as $subcat): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 menu-card text-center">
                            <?php
                            // Buscar la primera bebida con imagen para mostrarla como portada
                            $img = null;
                            foreach ($productos as $prod) {
                                if ($prod['categoria_id'] == $subcat['id'] && !empty($prod['imagen'])) {
                                    $img = $prod['imagen'];
                                    break;
                                }
                            }
                            ?>
                            <?php if ($img): ?>
                                <img src="./settings/img/<?php echo htmlspecialchars($img); ?>" class="card-img-top menu-img" alt="<?php echo htmlspecialchars($subcat['nombre']); ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($subcat['nombre']); ?></h5>
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalBebidas<?php echo $subcat['id']; ?>">Ver más</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <!-- ... resto del contenido del body ... -->
    <!-- MODALES DE COMIDA -->
    <?php foreach ($productosComida as $prod): ?>
        <div class="modal fade" id="modalComida<?php echo $prod['id']; ?>" tabindex="-1" aria-labelledby="modalComidaLabel<?php echo $prod['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalComidaLabel<?php echo $prod['id']; ?>"><?php echo htmlspecialchars($prod['nombre']); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row align-items-center">
                            <div class="col-12 col-md-6 mb-3">
                                <img src="./settings/img/<?php echo htmlspecialchars($prod['imagen']); ?>" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;" alt="<?php echo htmlspecialchars($prod['nombre']); ?>">
                            </div>
                            <div class="col-12 col-md-6">
                                <h4 class="text-warning fw-bold"><?php echo htmlspecialchars($prod['nombre']); ?></h4>
                                <p class="menu-price">$<?php echo number_format($prod['precio'], 2); ?></p>
                                <p class="text-muted"><?php echo htmlspecialchars($prod['descripcion']); ?></p>
                                <!-- Aquí puedes agregar detalles adicionales si los tienes en la BD -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- MODALES DE BEBIDAS AGRUPADAS POR SUBCATEGORÍA -->
    <?php foreach ($subcategoriasBebidas as $subcat): ?>
        <div class="modal fade" id="modalBebidas<?php echo $subcat['id']; ?>" tabindex="-1" aria-labelledby="modalBebidasLabel<?php echo $subcat['id']; ?>" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBebidasLabel<?php echo $subcat['id']; ?>"><?php echo htmlspecialchars($subcat['nombre']); ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-4">
                            <?php foreach ($productos as $prod): ?>
                                <?php if ($prod['categoria_id'] == $subcat['id']): ?>
                                    <div class="col-md-6 mb-3">
                                        <div class="card menu-card h-100">
                                            <div class="card-body text-center">
                                                <h5 class="card-title"><?php echo htmlspecialchars($prod['nombre']); ?></h5>
                                                <p class="menu-price"><?php echo htmlspecialchars($prod['descripcion']); ?></p>
                                                <p class="text-muted"><?php echo htmlspecialchars($prod['precio']); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- FIN MODALES DE BEBIDAS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>