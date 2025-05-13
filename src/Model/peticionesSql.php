<?php
// DECLARACIONES DE VARIABLES - ADJUNTO EL CAMPO DE LA TABLA (EXACTAMENTE COMO FIGURA EN LA TABLA) A LA VARIABLE
// TABLA USUARIO
$idUsuario = $_POST['id_usuario'] ?? null;
$apellido = $_POST['apellido'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$email = $_POST['email'] ?? null;
$clave = $_POST['clave'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$dni = $_POST['dni'] ?? null;
//TABLA ROLES
$idRol = $_POST['id_roles'] ?? null;
$rol = $_POST['rol'] ?? null;
// TABLA CANCHA
$idCancha = $_POST['id_cancha'] ?? null;
$nomnbreCancha = $_POST['nombreCancha'] ?? null;
// TABLA FECHA
$idFecha = $_POST['id_fecha'] ?? null;
$fecha = $_POST['fecha'] ?? null;
// TABLA HORARIO 
$idHorario = $_POST['id_horario'] ?? null;
$hora = $_POST['hora'] ?? null;
// TABLA PRECIO
$idPrecio = $_POST['id_precio'] ?? null;
$precio = $_POST['precio'] ?? null;
// TABLA RESERVA - SE RELACIONAN TODAS LA TABLAS
$idReserva = $_POST['id_reserva'] ?? null;
$idUsuario = $_POST['id_usuario'] ?? null;
$idCancha = $_POST['id_cancha'] ?? null;
$idFecha = $_POST['id_fecha'] ?? null;
$idPrecio = $_POST['id_precio'] ?? null;
$idHorario = $_POST['id_horario'] ?? null;

//-------------------------------------SENTENCIAS----------------------------------------------------------------------------------------------------------------//
// LOGIN //
$login = "SELECT usuario,clave FROM usuario WHERE usuario=$usuario AND clave=$clave AND habilitado=1 AND eliminado=0";
// REGISTRO DE USUARIO //
$crearPersona = "INSERT INTO persona (nombre,apellido,edad,dni,legajo) VALUES ('$nombre','$apellido','$edad','$dni','$legajo') ";
// LISTAR REGISTROS PERSONAS//
$listarPersona = "SELECT idPersona,apellido,nombre,edad,dni FROM persona WHERE habilitado=1 AND eliminado = 0 ORDER BY idPersona DESC ";
// EMPLEADOS
$listarEmpleados = "SELECT persona.idPersona, empleado.idEmpleado, persona.legajo, persona.nombre, persona.apellido, persona.edad, persona.dni, cargo.cargo, usuario.usuario
FROM empleado
INNER JOIN persona ON empleado.idPersona = persona.idPersona 
INNER JOIN cargo ON empleado.idCargo  = cargo.idCargo 
INNER JOIN usuario ON empleado.idUsuario = usuario.idUsuario
WHERE empleado.habilitado = 1 AND empleado.eliminado = 0 ORDER BY empleado.idEmpleado ASC ";
// LISTAR CARGO
$listarCargo = "SELECT idCargo,cargo FROM cargo WHERE habilitado=1 AND eliminado=0";
// EDITAR EMPLEADOS---------------------------------------------------------------------------------------------------------//
$listarEmpleado = "SELECT empleado.idEmpleado, empleado.idPersona,empleado.idCargo,empleado.idUsuario, persona.legajo, persona.nombre, persona.apellido, persona.edad, persona.dni, cargo.cargo, usuario.usuario, usuario.clave
FROM empleado
INNER JOIN persona ON empleado.idPersona = persona.idPersona 
INNER JOIN cargo ON empleado.idCargo  = cargo.idCargo 
INNER JOIN usuario ON empleado.idUsuario = usuario.idUsuario
WHERE idEmpleado='$idEmpleado' AND empleado.habilitado=1 AND empleado.eliminado=0";

// EDITAR EMPLEADOS---------------------------------------------------------------------------------------------------------//

