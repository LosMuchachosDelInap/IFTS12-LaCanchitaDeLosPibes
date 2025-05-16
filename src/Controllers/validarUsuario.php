<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inicia la sesión antes de cualquier salida
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Llamo al archivo de la clase de conexión (lo requiero para poder instanciar la clase)
require_once __DIR__ . '/../ConectionBD/CConection.php';
// Instancio la clase
$conectarDB = new ConectionDB();
// Obtengo la conexión
$conn = $conectarDB->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['email'] ?? null);
    $clave = trim($_POST['clave'] ?? null);

    if (!empty($usuario) && !empty($clave)) {
        $loginQuery = "SELECT clave FROM usuario WHERE email = ? AND habilitado = 1 AND cancelado = 0";
        $stmt = mysqli_prepare($conn, $loginQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $usuario);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $db_clave);
            mysqli_stmt_fetch($stmt);

            if (!empty($db_clave) && password_verify($clave, $db_clave)) {
                $_SESSION['email'] = $usuario;
                $_SESSION['logged_in'] = true;
                mysqli_stmt_close($stmt);
                mysqli_close($conn);
                header('Location: /src/Views/listado.php'); // Redirige a la página de listado
                exit;
            } else {
                $_SESSION['error_message'] = 'Usuario o contraseña incorrecta';
            }
            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error_message'] = 'Error interno del servidor';
        }
    } else {
        $_SESSION['error_message'] = 'Debe llenar ambos campos';
    }
    mysqli_close($conn);
    header('Location: /index.php'); // Redirige al modal
    exit;
}
