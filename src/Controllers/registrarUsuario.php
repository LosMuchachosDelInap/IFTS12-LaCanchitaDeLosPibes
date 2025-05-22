<?php

require_once __DIR__ . '/../Model/peticionesSql.php';
// Declaro las variables globales para poder usarlas ya que se encuentran en otro archivo
global $crearPersonaQuery;
global $crearUsuarioQuery;
global $crearEmpleadoQuery;
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

    public function crearPersona($apellido, $nombre, $edad, $dni, $telefono, $crearPersonaQuery)
    {
        global $crearPersonaQuery;// declaro global a esta variable para poder usarla,ya que esta en otro archivo
        $stmt = mysqli_prepare($this->conn, $crearPersonaQuery);
        if ($stmt === false) {
            die("Error en la preparación de la consulta crearPersona: " . mysqli_error($this->conn));
        }
        mysqli_stmt_bind_param($stmt, "sssss", $apellido, $nombre, $edad, $dni, $telefono);
        //mysqli_stmt_execute($stmt);
        // visualizo el error
        if (!$stmt->execute()) {
        die("Error en crearPersona: " . $stmt->error);
        }   
        $id = mysqli_insert_id($this->conn);
        mysqli_stmt_close($stmt);
        return $id;
    }

    public function crearUsuario($idPersona, $email, $clave, $crearUsuarioQuery)
    {
        global $crearUsuarioQuery; // declaro global a esta variable para poder usarla,ya que esta en otro archivo
        $hashed_password = password_hash($clave, PASSWORD_DEFAULT);
        $stmt = mysqli_prepare($this->conn, $crearUsuarioQuery);
        if ($stmt === false) {
            die("Error en la preparación de la consulta crearUsuario: " . mysqli_error($this->conn));
        }
        mysqli_stmt_bind_param($stmt, "iss", $idPersona, $email, $hashed_password);
        //mysqli_stmt_execute($stmt);
        // visualizo el error
        if (!$stmt->execute()) {
        die("Error en crearPersona: " . $stmt->error);
        } 
        $id = mysqli_insert_id($this->conn);
        mysqli_stmt_close($stmt);
        return $id;
    }

    public function crearEmpleado($idRol, $idPersona, $idUsuario, $crearEmpleadoQuery)
    {
        global $crearEmpleadoQuery; // declaro global a esta variable para poder usarla,ya qu
        $stmt = mysqli_prepare($this->conn, $crearEmpleadoQuery);
        if ($stmt === false) {
            die("Error en la preparación de la consulta crearEmpleado: " . mysqli_error($this->conn));
        }
        mysqli_stmt_bind_param($stmt, "iii", $idRol, $idPersona, $idUsuario);
        if (!$stmt->execute()) {
        die("Error en crearEmpleado: " . $stmt->error);
        } 
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return $result;
    }
}
