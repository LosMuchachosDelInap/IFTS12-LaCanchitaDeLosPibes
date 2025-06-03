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
// Instanciao la clase
$conectarDB = new ConectionDB();
// Obtengo la conexión
$conn = $conectarDB->getConnection();

// Verifica si está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: ' . BASE_URL . '/src/Views/noInicioSesion.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="es">

<?php require_once __DIR__ . '/../Template/head.php'; ?>

<body style="flex:1; min-height: 100vh;">
    <div>
        <?php require_once __DIR__ . '/../Template/navBar.php'; ?>
    </div>
    <div class="centrar" style="background-image: url('../Public/Pagina-en-construccion3.jpg'); background-size: cover; background-position: center;">
        <!-- Aquí tu contenido -->
    </div>
    <?php require_once __DIR__ . '/../Template/footer.php'; ?>
</body>

</html>