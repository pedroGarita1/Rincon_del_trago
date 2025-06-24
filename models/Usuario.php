<?php
require_once 'Conexion.php';
class Usuario
{
    public static function login($email, $password)
    {
        $pdo = Conexion::conectar();
        $stmt = $pdo->prepare('SELECT * FROM usuarios WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario && $password == $usuario['password']) {
            return $usuario;
        }
        return false;
    }
}
