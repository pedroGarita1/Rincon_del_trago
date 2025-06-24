<?php
class Conexion
{
    private static $host = 'localhost';
    private static $db = 'rincon_del_trago';
    private static $user = 'root';
    private static $pass = '';
    public static function conectar()
    {
        try {
            $pdo = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$db . ';charset=utf8', self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die('Error de conexión: ' . $e->getMessage());
        }
    }
}
