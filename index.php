<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>

<?php
// Llamo al archivo de la clase de conexión (lo requiero para poder instanciar la clase)
require_once 'src/ConectionBD/CConection.php';

// Instanciao la clase
$conexion = new ConectionDB();

// Obtengo la conexión
$conn = $conexion->getConnection();
// Creo el inicio de secion
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<?php include_once("src/Template/head.php"); ?>

<body>
      <div>
            <?php include_once("src/Template/navBar.php"); ?>
      </div>

    

      <div>
            <?php include_once("src/Template/footer.php"); ?>
      </div>

</body>

</html>