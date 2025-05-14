<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
<?php
include_once("src/Components/modalLoguin.php");
include_once("src/Components/modalRegistrar.php");
?>
</body>

</html>