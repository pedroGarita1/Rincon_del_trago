<?php
// Este archivo será una copia fiel de index.html, pero con los bloques de productos, combos, comida y bebidas generados dinámicamente.
// El resto del HTML, CSS y estructura se mantiene igual.
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Rincón del Trago - Menú</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="settings/css/style.css">
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
    <header class="menu-header">
        <h1>🌮🍹 EL RINCÓN DEL TRAGO 🍗🥂</h1>
        <p>¡Disfruta de nuestros deliciosos platillos y bebidas!</p>
    </header>
    <nav class="sticky-top z-3 nav-wrapper shadow-sm">
        <ul class="nav nav-tabs container justify-content-center">
            <li class="nav-item"><a class="nav-link active" href="#combos">Combos</a></li>
            <li class="nav-item"><a class="nav-link" href="#comida">Comida</a></li>
            <li class="nav-item"><a class="nav-link" href="#bebidas">Bebidas</a></li>
        </ul>
    </nav>
    <!-- Sección de Paquetes Espaciales (visual igual a index.html) -->
    <section id="combos" style="background-color: #ffe5cc; padding: 2rem; border-radius: 20px;">
        <div class="container text-center">
            <h2 style="color: #cc4400; font-weight: bold; margin-bottom: 1.5rem;">🛸💥 PAQUETES ESPACIALES</h2>
            <div class="row g-4 justify-content-center">
                <?php
                // Agrupar promociones por nombre (solo Alitas + Papas y Boneless + Papas)
                $paquetes = [
                    'Alitas + Papas' => [],
                    'Boneless + Papas' => []
                ];
                foreach ($promociones as $promo) {
                    if (isset($paquetes[$promo['nombre']])) {
                        $paquetes[$promo['nombre']][] = $promo;
                    }
                }
                // Renderizar cada tarjeta grande
                foreach ($paquetes as $nombre => $lista):
                    if (count($lista) > 0):
                ?>
                        <div class="col-md-5 mb-3">
                            <div class="card h-100 menu-card" style="margin-bottom: 1.5rem;">
                                <div class="card-body">
                                    <h5 class="card-title text-warning fw-bold" style="font-size: 1.5rem;">
                                        <?php echo ($nombre == 'Alitas + Papas' ? '🚀 ' : '🛸 ') . htmlspecialchars($nombre); ?>
                                    </h5>
                                    <p class="text-muted" style="font-size: 1.1rem;">
                                        <?php echo $nombre == 'Alitas + Papas' ? 'Disfruta de nuestras alitas acompañadas de papas crujientes.' : 'Perfecta combinación de boneless y papas para compartir.'; ?>
                                    </p>
                                    <ul class="list-group list-group-flush">
                                        <?php foreach ($lista as $promo): ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-center" style="font-size: 1.1rem;">
                                                <span><strong><?php echo htmlspecialchars($promo['descripcion']); ?></strong></span>
                                                <span class="text-warning fw-bold" style="font-size: 1.1rem;">$<?php echo number_format($promo['precio'], 2); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </section>
    <!-- Combos Diarios -->
    <div class="container text-center mt-3">
        <h2 class="section-title">📅🔥 COMBOS DIARIOS (De Martes a Domingo)</h2>
        <div class="row justify-content-center g-4">
            <?php
            // Mostrar el resto de promociones (las que no son paquetes)
            foreach ($promociones as $promo) {
                if (!isset($paquetes[$promo['nombre']])) {
            ?>
                    <div class="col-md-5 mb-3">
                        <div class="card h-100 menu-card">
                            <div class="card-body text-center">
                                <h5 class="card-title text-warning fw-bold"><?php echo htmlspecialchars($promo['nombre']); ?></h5>
                                <p class="text-muted"><strong><?php echo htmlspecialchars($promo['descripcion']); ?></strong></p>
                                <p class="menu-price">$<?php echo number_format($promo['precio'], 2); ?></p>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>

    <!-- Sección de Comida -->
    <div class="container mt-5">
        <div id="comida" class="menu-section">
            <h2 class="section-title">🍗🛸 COMIDA GALÁCTICA</h2>
            <div class="row justify-content-center g-4">
                <?php if (isset($categorias_por_tipo['comida'])): ?>
                    <?php foreach ($categorias_por_tipo['comida'] as $categoria): ?>
                        <?php
                        $productos_categoria = isset($productos_por_categoria[$categoria['id']]) ? $productos_por_categoria[$categoria['id']] : [];
                        ?>
                        <?php foreach ($productos_categoria as $producto): ?>
                            <div class="col-md-4">
                                <div class="card h-100 menu-card">
                                    <?php if ($producto['imagen']): ?>
                                        <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" class="card-img-top menu-img" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                    <?php endif; ?>
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                        <p class="text-muted"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                        <p class="menu-price">$<?php echo number_format($producto['precio'], 2); ?></p>
                                        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal<?php echo $producto['id']; ?>">Ver más</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Sección de Bebidas -->
    <div class="container mt-5">
        <div id="bebidas" class="menu-section">
            <h2 class="section-title">🍹✨ BEBIDAS DEL COSMOS</h2>
            <div class="row justify-content-center g-4">
                <?php
                // Mostrar productos de bebidas directamente (categorías 5, 6, 7)
                $bebidas_categorias = [5, 6, 7];
                foreach ($bebidas_categorias as $cat_id):
                    $productos_bebida = isset($productos_por_categoria[$cat_id]) ? $productos_por_categoria[$cat_id] : [];
                    if (!empty($productos_bebida)):
                        // Obtener información de la categoría
                        $categoria_info = null;
                        foreach ($categorias as $cat) {
                            if ($cat['id'] == $cat_id) {
                                $categoria_info = $cat;
                                break;
                            }
                        }
                ?>
                        <div class="col-md-4">
                            <div class="card h-100 menu-card">
                                <?php if ($productos_bebida[0]['imagen']): ?>
                                    <img src="settings/img/<?php echo htmlspecialchars($productos_bebida[0]['imagen']); ?>" class="card-img-top menu-img" alt="<?php echo htmlspecialchars($categoria_info['nombre']); ?>">
                                <?php endif; ?>
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($categoria_info['nombre']); ?></h5>
                                    <?php if (!empty($categoria_info['descripcion'])): ?>
                                        <p class="text-muted small"><?php echo htmlspecialchars($categoria_info['descripcion']); ?></p>
                                    <?php endif; ?>
                                    <?php
                                    $precio_minimo = min(array_column($productos_bebida, 'precio'));
                                    $precio_maximo = max(array_column($productos_bebida, 'precio'));
                                    ?>
                                    <p class="menu-price">Desde $<?php echo number_format($precio_minimo, 2); ?></p>
                                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modalBebida<?php echo $cat_id; ?>">Ver más</button>
                                </div>
                            </div>
                        </div>
                <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    </div>

    <!-- Modales para Comida -->
    <?php if (isset($categorias_por_tipo['comida'])): ?>
        <?php foreach ($categorias_por_tipo['comida'] as $categoria): ?>
            <?php
            $productos_categoria = isset($productos_por_categoria[$categoria['id']]) ? $productos_por_categoria[$categoria['id']] : [];
            ?>
            <?php foreach ($productos_categoria as $producto): ?>
                <div class="modal fade" id="modal<?php echo $producto['id']; ?>" tabindex="-1" aria-labelledby="modalLabel<?php echo $producto['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalLabel<?php echo $producto['id']; ?>"><?php echo htmlspecialchars($producto['nombre']); ?></h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row align-items-center">
                                    <?php if ($producto['imagen']): ?>
                                        <div class="col-12 col-md-6 mb-3">
                                            <img src="<?php echo htmlspecialchars($producto['imagen']); ?>" class="img-fluid rounded" style="width: 100%; height: 300px;" alt="<?php echo htmlspecialchars($producto['nombre']); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="col-12 <?php echo $producto['imagen'] ? 'col-md-6' : 'col-md-12'; ?>">
                                        <h4 class="text-warning fw-bold"><?php echo htmlspecialchars($producto['nombre']); ?></h4>
                                        <p class="text-muted"><?php echo htmlspecialchars($producto['descripcion']); ?></p>
                                        <p class="menu-price">Precio: $<?php echo number_format($producto['precio'], 2); ?></p>
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
        <?php endforeach; ?>
    <?php endif; ?>

    <!-- Modales para Bebidas -->
    <?php
    $bebidas_categorias = [5, 6, 7];
    foreach ($bebidas_categorias as $cat_id):
        $productos_bebida = isset($productos_por_categoria[$cat_id]) ? $productos_por_categoria[$cat_id] : [];
        if (!empty($productos_bebida)):
            // Obtener información de la categoría
            $categoria_info = null;
            foreach ($categorias as $cat) {
                if ($cat['id'] == $cat_id) {
                    $categoria_info = $cat;
                    break;
                }
            }
    ?>
            <div class="modal fade" id="modalBebida<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="modalBebidaLabel<?php echo $cat_id; ?>" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalBebidaLabel<?php echo $cat_id; ?>"><?php echo htmlspecialchars($categoria_info['nombre']); ?></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <h6 class="mb-3"><?php echo htmlspecialchars($categoria_info['descripcion']); ?></h6>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php
                                    // Agrupar productos por nombre
                                    $productos_agrupados = [];
                                    foreach ($productos_bebida as $producto) {
                                        $nombre = $producto['nombre'];
                                        if (!isset($productos_agrupados[$nombre])) {
                                            $productos_agrupados[$nombre] = [];
                                        }
                                        $productos_agrupados[$nombre][] = $producto;
                                    }
                                    ?>
                                    <div class="row g-3">
                                        <?php foreach ($productos_agrupados as $nombre_producto => $variantes): ?>
                                            <?php foreach ($variantes as $variante): ?>
                                                <div class="col-md-6">
                                                    <div class="card mb-2 shadow-sm border-0">
                                                        <div class="card-body text-center">
                                                            <h5 class="card-title mb-1"><?php echo htmlspecialchars($variante['nombre']); ?></h5>
                                                            <p class="text-warning fw-bold mb-1"><?php echo htmlspecialchars($variante['descripcion']); ?></p>
                                                            <p class="menu-price mb-0">$<?php echo number_format($variante['precio'], 2); ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        endif;
    endforeach;
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>