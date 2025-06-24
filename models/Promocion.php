<?php
require_once 'Conexion.php';
class Promocion
{
    public static function todas()
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->query('SELECT * FROM promociones WHERE habilitado = 1');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function crear($nombre, $descripcion, $precio, $imagen)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('INSERT INTO promociones (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)');
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen]);
    }
    public static function deshabilitar($id)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE promociones SET habilitado = 0 WHERE id = ?');
        return $stmt->execute([$id]);
    }
    public static function editar($id, $nombre, $descripcion, $precio, $imagen)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('UPDATE promociones SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE id = ?');
        return $stmt->execute([$nombre, $descripcion, $precio, $imagen, $id]);
    }
}
