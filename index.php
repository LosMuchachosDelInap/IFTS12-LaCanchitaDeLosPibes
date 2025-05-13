<?php
// Llamo al archivo de la clase de conexión (lo requiero para poder instanciar la clase)
require_once 'src/ConectionBD/CConection.php';

// Instanciao la clase
$conexion = new ConectionDB();

// Obtengo la conexión
$conn = $conexion->getConnection();
