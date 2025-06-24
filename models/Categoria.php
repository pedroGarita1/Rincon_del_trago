<?php
require_once 'Conexion.php';
class Categoria
{
    public static function todas()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT id, nombre, tipo, parent_id, descripcion FROM categorias WHERE habilitado = 1');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function hijas($parent_id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT id, nombre, tipo, parent_id, descripcion FROM categorias WHERE parent_id = ? AND habilitado = 1');
        $stmt->execute([$parent_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function crear($nombre, $tipo, $parent_id = null, $descripcion = null)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('INSERT INTO categorias (nombre, tipo, parent_id, descripcion) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$nombre, $tipo, $parent_id, $descripcion]);
    }
    public static function deshabilitar($id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE categorias SET habilitado = 0 WHERE id = ?');
        return $stmt->execute([$id]);
    }
    public static function editar($id, $nombre, $tipo, $parent_id = null, $descripcion = null)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE categorias SET nombre = ?, tipo = ?, parent_id = ?, descripcion = ? WHERE id = ?');
        return $stmt->execute([$nombre, $tipo, $parent_id, $descripcion, $id]);
    }
}
