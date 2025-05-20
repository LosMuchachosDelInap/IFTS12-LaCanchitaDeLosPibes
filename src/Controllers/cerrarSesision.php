<?php
session_start();
unset($_SESSION['logged_in']);
// cierra la sesion
session_destroy();
// redirigir a la página de inicio de sesión
// header('Location: /index.php');// usar en casa
header('Location: /Mis%20proyectos/IFTS12-LaCanchitaDeLosPibes/index.php');// usar en el trabajo
exit;
?>