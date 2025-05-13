<?php
/*clase para la base de datos*/
class ConectionDB
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'lacanchitadelospibes';
    private $conn; // Variable para la conexión a la base de datos
    private $charset = 'utf8mb4'; // Codificación de caracteres de la base de datos

    public function __construct() /* "metodo" de coneccion a la base de datos*/
    {
        $this->conn = new mysqli(
            $this->host, // Host de la base de datos
            $this->username, // Usuario de la base de datos
            $this->password, // Contraseña de la base de datos
            $this->dbname // Nombre de la base de datos
        );

        // Usar el charset definido
        $this->conn->set_charset($this->charset);

        // Verificar si la conexión fue exitosa
        // Si hay un error de conexión, se muestra un mensaje de error en la consola del navegador
        if ($this->conn->connect_error) {
            // Mensaje de error en consola del navegador
            echo "<script>console.error('Error de conexión: " . addslashes($this->conn->connect_error) . "');</script>";
        } else {
            // Mensaje de éxito en consola del navegador
            echo "<script>console.log('Conexión exitosa a la base de datos');</script>";
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
