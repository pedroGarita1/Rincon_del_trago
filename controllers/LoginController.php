<?php
require_once __DIR__ . '/../models/Usuario.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $usuario = Usuario::login($email, $password);
    if ($usuario) {
        $_SESSION['admin'] = $usuario['email'];
        header('Location: /projects/Rincon_del_trago/admin/panel.php');
        exit;
    } else {
        $error = 'Usuario o contraseña incorrectos';
    }
}
include __DIR__ . '/../views/login.php';
