<?php
session_start();
require_once 'ContactoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Si está logueado, usa el email de la sesión; si no, usa el del formulario
    $emailUsuario = isset($_SESSION['email']) && !empty($_SESSION['email'])
        ? $_SESSION['email']
        : ($_POST['email'] ?? '');

    $mensaje = $_POST['contacto'] ?? '';

    $contacto = new ContactoController();
    $contacto->setEmailUsuario($emailUsuario);
    $contacto->setMensaje($mensaje);

    echo $contacto->enviarConsulta();
} else {
    echo "<div class='alert alert-warning'>Acceso no permitido.</div>";
}