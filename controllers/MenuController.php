<?php
require_once __DIR__ . '/../models/Categoria.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Promocion.php';

// Obtener todas las categorías
$categorias = Categoria::todas();

// Obtener productos
$productos = Producto::todos();
$promociones = Promocion::todas();

// Organizar productos por categoría
$productos_por_categoria = [];
foreach ($productos as $producto) {
    $categoria_id = $producto['categoria_id'];
    if (!isset($productos_por_categoria[$categoria_id])) {
        $productos_por_categoria[$categoria_id] = [];
    }
    $productos_por_categoria[$categoria_id][] = $producto;
}

// Organizar categorías por tipo
$categorias_por_tipo = [];
foreach ($categorias as $categoria) {
    $tipo = $categoria['tipo'];
    if (!isset($categorias_por_tipo[$tipo])) {
        $categorias_por_tipo[$tipo] = [];
    }
    $categorias_por_tipo[$tipo][] = $categoria;
}

include __DIR__ . '/../views/menu.php';
