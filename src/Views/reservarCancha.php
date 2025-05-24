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

// Llamo al archivo de las peticiones SQL
require_once __DIR__ . '/../Model/peticionesSql.php';

// Verifica si está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
  header('Location: ../Views/noInicioSesion.php');
  exit;
}

// Verifica si el rol NO es ni Administrador ni Dueño
$rol = $_SESSION['nombre_rol'] ?? '';
if ($rol !== 'Administrador' && $rol !== 'Dueño') {
  header('Location: ../Views/noAutorizado.php');
  exit;
}
require_once __DIR__ . '/../Controllers/ReservarCanchaController.php';

// Canchas fijas
$canchas = [
    1 => "Cancha Norte",
    2 => "Cancha Sur",
    3 => "Cancha Este",
    4 => "Cancha Oeste",
    5 => "Cancha Central"
];

// Horarios de 10 a 20 hs
$horarios = [];
for ($h = 10; $h <= 20; $h++) {
    $horarios[] = sprintf("%02d:00", $h);
}

$mensaje = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCancha = $_POST['cancha'] ?? null;
    $hora = $_POST['hora'] ?? null;
    $fecha = $_POST['fecha'] ?? date('Y-m-d');
    $idUsuario = $_SESSION['id_usuario']; // Debe estar en la sesión

    $conectarDB = new ConectionDB();
    $conn = $conectarDB->getConnection();
    $controller = new ReservarCanchaController($conn);

    $mensaje = $controller->reservar($idCancha, $idUsuario, $fecha, $hora);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reservar Cancha</title>
    <link rel="stylesheet" href="../../assets/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Reservar Cancha de Fútbol</h2>
    <?php if ($mensaje): ?>
        <div class="alert alert-info"><?= htmlspecialchars($mensaje) ?></div>
    <?php endif; ?>
    <form method="post">
        <div class="mb-3">
            <label for="cancha" class="form-label">Cancha</label>
            <select name="cancha" id="cancha" class="form-select" required>
                <option value="">Seleccione una cancha</option>
                <?php foreach ($canchas as $id => $nombre): ?>
                    <option value="<?= $id ?>"><?= $nombre ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="<?= date('Y-m-d') ?>" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Horario</label>
            <select name="hora" id="hora" class="form-select" required>
                <option value="">Seleccione un horario</option>
                <?php foreach ($horarios as $hora): ?>
                    <option value="<?= $hora ?>"><?= $hora ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn btn-success">Reservar</button>
    </form>
</div>
</body>
</html>