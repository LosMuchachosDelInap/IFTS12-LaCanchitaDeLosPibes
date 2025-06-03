<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define la ruta BASE_URL //
if (!defined('BASE_URL')) {
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST'];
     //$carpeta = '/Mis_Proyectos/IFTS12-LaCanchitaDeLosPibes';// XAMPP
     $carpeta = ''; // SIN subcarpeta// POR PHP - s LOCALHOST:8000
    //$carpeta = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
    define('BASE_URL', $protocolo . $host . $carpeta);
}
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
        $loginQuery = "SELECT u.clave, u.id_usuario, e.id_rol, r.rol
        FROM usuario u
        JOIN empleado e ON u.id_usuario = e.id_usuario
        JOIN roles r ON e.id_rol = r.id_roles
        WHERE u.email = ? AND u.habilitado = 1 AND u.cancelado = 0";

        $stmt = mysqli_prepare($conn, $loginQuery);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $usuario);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $db_clave, $id_usuario, $idRol, $nombreRol);
            mysqli_stmt_fetch($stmt);

            if (!empty($db_clave) && password_verify($clave, $db_clave)) {
                $_SESSION['email'] = $usuario; // Guardar el email en la sesión
                $_SESSION['logged_in'] = true; // Marca al usuario como logueado
                $_SESSION['id_usuario'] = $id_usuario; // Guarda el id del usuario
                $_SESSION['id_rol'] = $idRol;         // Guarda el id del rol
                $_SESSION['nombre_rol'] = $nombreRol; // Guarda el nombre del rol
                mysqli_stmt_close($stmt);
                mysqli_close($conn);

                // chequea el rol del usuario y redirige a la página correspondiente
                if (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] == 'Dueño') {
                    header('Location: ' . BASE_URL . '/src/Views/listado.php'); // Redirige a la página de listado
                    exit;
                } elseif (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] == 'Administrador') {
                    header('Location: ' . BASE_URL . '/index.php'); // Redirige a la página de listado
                    exit;
                } elseif (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] == 'Bar') {
                    echo '<script>
                        alert("El Usuario: ' . $usuario . ' tiene rol de administrador del Bar del club");
                       window.location.href = "<?php echo BASE_URL; ?>/index.php";
                    </script>'; //--- PARA USAR EN EL TRABAJO*/
                    /*'<script>
                        alert("El Usuario: ' . $usuario . ' tiene rol de administrador del Bar del club");
                       window.location.href = "/index.php"; 
                    </script>';/* PARA USAR EN CASA */
                    exit;
                } elseif (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] == 'Alquiler') {
                    echo '<script>
                        alert("El Usuario: ' . $usuario . ' tiene permisos para manejar los alquileres del club");
                        window.location.href = "<?php echo BASE_URL; ?>/index.php";
                    </script>'; // para usar en el trabajo
                    /*'<script>
                        alert("El Usuario: ' . $usuario . ' tiene permisos para manejar los alquileres del club");
                        window.location.href = "/index.php";
                    </script>';*/ // para usar en casa
                    exit;
                } elseif (isset($_SESSION['nombre_rol']) && $_SESSION['nombre_rol'] == 'Estacionamiento') {
                    echo '<script>
                        alert("El Usuario: ' . $usuario . ' tiene permiso para manejar el estacionamiento del club");
                        window.location.href = "<?php echo BASE_URL; ?>/index.php";
                    </script>'; // para usar en el trabajo
                    /*'<script>
                        alert("El Usuario: ' . $usuario . ' tiene permiso para manejar el estacionamiento del club");
                        window.location.href = "/index.php";
                    </script>';*/ // para usar en casa
                    exit;
                }
            } else {
                $_SESSION['error_message'] = 'Usuario o contraseña incorrecta';
            }
            // mysqli_stmt_close($stmt);
        } else {
            $_SESSION['error_message'] = 'Error interno del servidor';
        }
    } else {
        $_SESSION['error_message'] = 'Debe llenar ambos campos';
    }
    // mysqli_close($conn);
    header('Location: /index.php'); // Redirige al modal
    exit;
}
