<?php
session_start();
require_once 'ContactoController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $emailUsuario = $_SESSION['email'] ?? '';
    $mensaje = $_POST['contacto'] ?? '';

    $contacto = new ContactoController();
    $contacto->setEmailUsuario($emailUsuario);
    $contacto->setMensaje($mensaje);

    echo $contacto->enviarConsulta();
} else {
    echo "<div class='alert alert-warning'>Acceso no permitido.</div>";
}