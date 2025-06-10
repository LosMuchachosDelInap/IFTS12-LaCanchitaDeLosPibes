<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../ConectionBD/CConection.php';
require_once __DIR__ . '/../Controllers/modificarEmpleado.php';

$conectarDB = new ConectionDB();
$conn = $conectarDB->getConnection();
$empleadoController = new EmpleadoController($conn);

$idEmpleado = $_GET['id_empleado'] ?? null;
$empleado = $empleadoController->obtenerEmpleadoPorId($idEmpleado);
$roles = $empleadoController->obtenerRoles();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modificar'])) {
    $idPersona = $_POST['id_persona'];
    $idUsuario = $_POST['id_usuario'];
    $idEmpleado = $_POST['id_empleado'];
    $idRol = $_POST['Roles'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $edad = $_POST['edad'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $email = $_POST['usuario'];
    $clave = $_POST['clave'];

    $ok = $empleadoController->actualizarEmpleado($idPersona, $nombre, $apellido, $edad, $dni, $telefono, $idUsuario, $email, $clave, $idEmpleado, $idRol);

    if ($ok) {
        echo "<script>alert('Empleado actualizado correctamente'); window.location='listado.php';</script>";
        exit;
    } else {
        echo "<script>alert('Error al actualizar empleado');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<?php include_once("../Template/head.php"); ?>

<body class="content">

  <?php include_once("../Template/navBar.php"); ?>

  <div class="centrar">
    <div class="card" style="width: 300px; height: auto">
      <div class="card-header">
        Modificar datos
      </div>
      <div class="card-body">
        <form method="post" class="d-grid bg-dark p-2 rounded">
          <input type="hidden" name="id_persona" value="<?php echo $empleado["id_persona"]; ?>">
          <input type="hidden" name="id_usuario" value="<?php echo $empleado["id_usuario"]; ?>">
          <input type="hidden" name="id_empleado" value="<?php echo $empleado["id_empleado"]; ?>">
          <input type="text" name="rol" placeholder="rol" disabled value="<?php echo $empleado["rol"]; ?>" class="form-control">
          <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $empleado["nombre"]; ?>" class="mt-2 form-control">
          <input type="text" name="apellido" placeholder="Apellido" value="<?php echo $empleado["apellido"]; ?>" class="mt-2 form-control">
          <input type="text" name="edad" placeholder="Edad" value="<?php echo $empleado["edad"]; ?>" class="mt-2 form-control">
          <input type="text" name="dni" placeholder="DNI" value="<?php echo $empleado["dni"]; ?>" class="mt-2 form-control">
          <input type="email" name="usuario" placeholder="Usuario" value="<?php echo $empleado["email"]; ?>" class="mt-2 form-control">
          <input type="password" name="clave" placeholder="Clave" value="<?php echo $empleado["clave"]; ?>" class="mt-2 form-control">
          <input type="text" name="telefono" placeholder="Teléfono" value="<?php echo $empleado["telefono"]; ?>" class="mt-2 form-control">
          <div>
            <div class="input-group">
              <select name="Roles" class="mt-2 form-select form-control btn btn-secondary">
                <?php foreach ($roles as $rol) { ?>
                  <option value="<?php echo $rol["id_roles"]; ?>" <?php if ($empleado["id_rol"] == $rol["id_roles"]) echo 'selected'; ?>>
                    <?php echo $rol["rol"]; ?>
                  </option>
                <?php } ?>
              </select>
            </div>
          </div>
          <button type="submit" name="modificar" class="mt-2 btn btn-primary form-control">Aceptar cambios</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>