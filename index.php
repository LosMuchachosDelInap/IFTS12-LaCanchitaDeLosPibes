<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Inicia la sesión antes de cualquier salida
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Llamo al archivo de la clase de conexión (lo requiero para poder instanciar la clase)
require_once 'src/ConectionBD/CConection.php';
// Instanciao la clase
$conectarDB = new ConectionDB();
// Obtengo la conexión
$conn = $conectarDB->getConnection();
?>
<!DOCTYPE html>
<html lang="es">
/*
 * La Canchita de los Pibes
 * Desarrollado por: Los Muchachos del INAP
 * Autores: Varela Javier, Barrios Julian, Belloso Pablo, Minotti Sebastian
 * Fecha: 01-05-2025
 * Descripción: Página principal del sitio web.
 */
<?php include_once("src/Template/head.php"); ?>

<body>
      <div>
            <?php include_once("src/Template/navBar.php"); ?>
      </div>

      <div>
            <?php include_once("src/Template/footer.php"); ?>
      </div>
<?php
include_once("src/Components/modalLoguin.php");
include_once("src/Components/modalRegistrar.php");
?>
</body>

</html>