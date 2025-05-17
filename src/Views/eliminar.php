<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Llamo al archivo de la clase de conexión
require_once __DIR__ . '/../ConectionBD/CConection.php';

// Llamo al archivo de las peticiones SQL
require_once __DIR__ . '/../Model/peticionesSql.php';

class EliminarEmpleado {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    /**
     * Deshabilita (no elimina físicamente) un empleado por su ID.
     * @param int $idEmpleado
     * @return bool
     */
    public function deshabilitarPorId($idEmpleado) {
        /**
         * En PHP, para usar una variable global dentro de un método, 
         * debes declararla como "global" dentro del método.
         */
        global $eliminarEmpleado; // Trae la variable desde peticionesSql.php
        $stmt = $this->conn->prepare($eliminarEmpleado);
        if ($stmt) {
            $stmt->bind_param("i", $idEmpleado);
            $result = $stmt->execute();
            $stmt->close();
            return $result;
        }
        return false;
    }
}

// Instancio la clase y obtengo la conexión
$conectarDB = new ConectionDB();
$conn = $conectarDB->getConnection();
// Verifico si se ha enviado el ID del empleado a eliminar
$idEmpleado = $_GET['id_empleado'] ?? $_POST['id_empleado'] ?? null;
// Verifico si el ID del empleado no está vacío
if ($idEmpleado) {
    $eliminador = new EliminarEmpleado($conn);
    if ($eliminador->deshabilitarPorId($idEmpleado)) {
        echo "<script>alert('Empleado eliminado con éxito'); window.location='listado.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar empleado'); window.location='listado.php';</script>";
    }
} else {
    echo "<script>alert('ID de empleado no especificado'); window.location='listado.php';</script>";
}
?>
