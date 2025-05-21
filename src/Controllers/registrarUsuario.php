<?php

require_once __DIR__ . '/../Model/peticionesSql.php';

class RegistroUsuario
{
    private $conn;

    public function __construct($conn = null)
    {
        if ($conn !== null) {
            $this->setConn($conn);
        }
    }

    public function setConn($conn)
    {
        $this->conn = $conn;
    }

    public function getConn()
    {
        return $this->conn;
    }

    public function crearPersona($nombre, $apellido, $edad, $dni, $telefono, $crearPersona)
    {
        $stmt = mysqli_prepare($this->conn, $crearPersona);
        mysqli_stmt_bind_param($stmt, "sssss", $apellido, $nombre, $edad, $dni, $telefono);
        mysqli_stmt_execute($stmt);
        $id = mysqli_insert_id($this->conn);
        mysqli_stmt_close($stmt);
        return $id;
    }

    public function crearUsuario($idPersona, $email, $clave, $crearUsuarioQuery)
    {
        $hashed_password = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($this->conn, $crearUsuarioQuery);
        mysqli_stmt_bind_param($stmt, "iss", $idPersona, $email, $hashed_password);
        mysqli_stmt_execute($stmt);
        $id = mysqli_insert_id($this->conn);
        mysqli_stmt_close($stmt);
        return $id;
    }

    public function crearEmpleado($idRol, $idPersona, $idUsuario, $crearEmpleadoQuery)
    {
        $stmt = mysqli_prepare($this->conn, $crearEmpleadoQuery);
        mysqli_stmt_bind_param($stmt, "iii", $idRol, $idPersona, $idUsuario);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
