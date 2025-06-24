<?php
require_once 'Conexion.php';
class Producto
{
    public static function todos()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT * FROM productos WHERE habilitado = 1');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function bebidasAgrupadas()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('
            SELECT 
                p.nombre,
                p.descripcion,
                p.imagen,
                GROUP_CONCAT(
                    CONCAT(p2.precio, " - ", p2.descripcion) 
                    ORDER BY p2.precio ASC 
                    SEPARATOR " | "
                ) as variantes,
                MIN(p.precio) as precio_min,
                MAX(p.precio) as precio_max,
                COUNT(*) as cantidad_variantes
            FROM productos p
            INNER JOIN categorias c ON p.categoria_id = c.id
            INNER JOIN categorias c_parent ON c.parent_id = c_parent.id
            INNER JOIN productos p2 ON p2.nombre = p.nombre AND p2.habilitado = 1
            WHERE c_parent.tipo = "bebida" AND p.habilitado = 1
            GROUP BY p.nombre
            ORDER BY p.nombre ASC
        ');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function porCategoria($categoria_id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM productos WHERE categoria_id = ? AND habilitado = 1');
        $stmt->execute([$categoria_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function crear($nombre, $descripcion, $precio, $imagen, $categoria_id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('INSERT INTO productos (nombre, descripcion, precio, imagen, categoria_id) VALUES (?, ?, ?, ?, ?)');
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $categoria_id]);
    }

    public static function deshabilitar($id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE productos SET habilitado = 0 WHERE id = ?');
        return $stmt->execute([$id]);
    }

    public static function editar($id, $nombre, $descripcion, $precio, $imagen, $categoria_id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE productos SET nombre = ?, descripcion = ?, precio = ?, imagen = ?, categoria_id = ? WHERE id = ?');
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $categoria_id, $id]);
    }
}
