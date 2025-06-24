<?php
require_once 'models/Conexion.php';
require_once 'models/Categoria.php';
require_once 'models/Producto.php';

echo "<h2>Debug Rápido - Bebidas</h2>";

// Obtener productos
$productos = Producto::todos();

// Obtener categorías
$categorias = Categoria::todas();

echo "<h3>Productos en subcategorías de bebidas:</h3>";

// Buscar productos en categorías 5, 6, 7 (subcategorías de bebidas)
foreach ($productos as $producto) {
    if (in_array($producto['categoria_id'], [5, 6, 7])) {
        echo "<p><strong>{$producto['nombre']}</strong> - Precio: ${$producto['precio']} - Categoría ID: {$producto['categoria_id']}</p>";
    }
}

echo "<h3>Categorías de bebidas:</h3>";
foreach ($categorias as $cat) {
    if ($cat['tipo'] == 'bebida') {
        echo "<p><strong>{$cat['nombre']}</strong> - ID: {$cat['id']} - Parent ID: {$cat['parent_id']}</p>";
    }
}

// Organizar productos por categoría
$productos_por_categoria = [];
foreach ($productos as $producto) {
    $categoria_id = $producto['categoria_id'];
    if (!isset($productos_por_categoria[$categoria_id])) {
        $productos_por_categoria[$categoria_id] = [];
    }
    $productos_por_categoria[$categoria_id][] = $producto;
}

echo "<h3>Productos por categoría (5, 6, 7):</h3>";
for ($i = 5; $i <= 7; $i++) {
    if (isset($productos_por_categoria[$i])) {
        echo "<h4>Categoría ID $i:</h4>";
        foreach ($productos_por_categoria[$i] as $prod) {
            echo "<p>{$prod['nombre']} - $${$prod['precio']}</p>";
        }
    } else {
        echo "<p>Categoría ID $i: NO HAY PRODUCTOS</p>";
    }
}
