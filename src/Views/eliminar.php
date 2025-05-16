<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Llamo al archivo de la clase de conexión
require_once 'src/ConectionBD/CConection.php';

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
        $sql = "UPDATE empleado SET habilitado=0, cancelado=1 WHERE id_empleado=?";
        $stmt = $this->conn->prepare($sql);
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

$idEmpleado = $_GET['id_empleado'] ?? $_POST['id_empleado'] ?? null;

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
