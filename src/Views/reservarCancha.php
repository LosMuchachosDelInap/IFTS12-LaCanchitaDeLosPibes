<?php
// Definir BASE_URL solo si no está definida
if (!defined('BASE_URL')) {
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
    //  $carpeta = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    $carpeta = '/Mis%20proyectos/IFTS12-LaCanchitaDeLosPibes';
    define('BASE_URL', $protocolo . $host . $carpeta);
}
?>

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

//guarda el usuario logueado
$usuarioLogueado = $_SESSION['email'] ?? null;

?>
<!DOCTYPE html>
<html lang="es">

<?php require_once __DIR__ . '/../Template/head.php'; ?>

<body>
    <div>
    <?php require_once __DIR__ . '/../Template/navBar.php'; ?>
</div>
    <div class="centrar" style="background-image: url('../Public/Pagina-en-construccion3.jpg'); background-size: cover; background-position: center;">
        <!-- Aquí tu contenido -->
        <h1 class="text-center text-white">Página en Construcción</h1>
        <p class="text-center text-white">Estamos trabajando para mejorar tu experiencia. Vuelve pronto.</p>
        <p class="text-center text-white">Mientras tanto, puedes explorar otras secciones del sitio.</p>
        <div class="text-center">
            <a href="<?php echo BASE_URL; ?>" class="btn btn-primary">Volver al Inicio</a>
    </div>
    
    <div>
        <?php require_once __DIR__ . '/../Template/footer.php'; ?>
    </div>
</body>

</html>