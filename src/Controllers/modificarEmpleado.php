<?php
class EmpleadoController {
    private $conn;

    public function __construct($conn) {
        $this->setConn($conn);
    }

    public function setConn($conn) {
        $this->conn = $conn;
    }

    public function getConn() {
        return $this->conn;
    }

    public function obtenerEmpleadoPorId($idEmpleado) {
        $sql = "SELECT empleado.id_empleado, empleado.id_persona, empleado.id_rol, empleado.id_usuario, persona.nombre, persona.apellido, persona.edad, persona.dni, roles.rol, usuario.email, usuario.clave, persona.telefono
                FROM empleado
                INNER JOIN persona ON empleado.id_persona = persona.id_persona 
                INNER JOIN roles ON empleado.id_rol  = roles.id_roles 
                INNER JOIN usuario ON empleado.id_usuario = usuario.id_usuario
                WHERE empleado.id_empleado=? AND empleado.habilitado=1 AND empleado.cancelado=0";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $idEmpleado);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function obtenerRoles() {
        $sql = "SELECT id_roles, rol FROM roles WHERE habilitado=1 AND cancelado=0";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function actualizarEmpleado($idPersona, $nombre, $apellido, $edad, $dni, $telefono, $idUsuario, $email, $clave, $idEmpleado, $idRol) {
        // Actualizar persona
        $sqlPersona = "UPDATE persona SET nombre=?, apellido=?, edad=?, dni=?, telefono=? WHERE id_persona=?";
        $stmtPersona = $this->conn->prepare($sqlPersona);
        $stmtPersona->bind_param("sssssi", $nombre, $apellido, $edad, $dni, $telefono, $idPersona);

        // Actualizar usuario
        $sqlUsuario = "UPDATE usuario SET email=?, clave=? WHERE id_usuario=?";
        $stmtUsuario = $this->conn->prepare($sqlUsuario);
        $stmtUsuario->bind_param("ssi", $email, $clave, $idUsuario);

        // Actualizar empleado
        $sqlEmpleado = "UPDATE empleado SET id_rol=? WHERE id_empleado=?";
        $stmtEmpleado = $this->conn->prepare($sqlEmpleado);
        $stmtEmpleado->bind_param("ii", $idRol, $idEmpleado);

        $ok = $stmtPersona->execute() && $stmtUsuario->execute() && $stmtEmpleado->execute();

        $stmtPersona->close();
        $stmtUsuario->close();
        $stmtEmpleado->close();

        return $ok;
    }
}