<?php
// DECLARACIONES DE VARIABLES - ADJUNTO EL CAMPO DE LA TABLA (EXACTAMENTE COMO FIGURA EN LA TABLA) A LA VARIABLE
// TABLA USUARIO
$idUsuario = $_POST['id_usuario'] ?? null;
$email = $_POST['email'] ?? null;
$clave = $_POST['clave'] ?? null;
// TABLA PERSONA
$idPersona = $_POST['id_persona'] ?? null;
$apellido = $_POST['apellido'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$dni = $_POST['dni'] ?? null;
$edad = $_POST['edad'] ?? null;
// TABLA EMPLEADO
$idEmpleado = $_POST['id_empleado'] ?? null;
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
$login = "SELECT email,clave FROM usuario WHERE email=$email AND clave=$clave AND habilitado=1 AND eliminado=0";
// CREAR USUARIO //
$crearUsuario = "INSERT INTO usuario (email,clave) VALUES ('$email','$clave') ";
// CREAR PERSONA
$crearPersona = "INSERT INTO persona (apellido,nombre,edad,dni,telefono) VALUES ('$apellido','$nombre','$edad','$dni','$telefono')";
// CREAR EMPLEADO
$crearEmpleado = "INSERT INTO empleado (idRol,idPersona,idUsuario) VALUES ('$idRol','$idPersona','$idUsuario')";
// LISTAR REGISTROS DE USUARIOS// REVISAR
$listarUsuarios = "SELECT id_usuario,apellido,nombre,email,clave,telefono,id_rol FROM usuario WHERE habilitado=1 AND eliminado = 0 ORDER BY id_usuario DESC ";
// LISTAR EMPLEADOS // REVISAR
$listarEmpleados = "SELECT persona.idPersona, empleado.idEmpleado, persona.legajo, persona.nombre, persona.apellido, persona.edad, persona.dni, roles.rol, usuario.email
FROM empleado
INNER JOIN persona ON empleado.id_persona = persona.id_persona 
INNER JOIN roles ON empleado.id_rol  = roles.id_rol 
INNER JOIN usuario ON empleado.id_usuario = usuario.id_usuario
WHERE empleado.habilitado = 1 AND empleado.eliminado = 0 ORDER BY empleado.id_empleado ASC ";
// LISTAR CARGO
$listarRoles = "SELECT id_rol,rol FROM roles WHERE habilitado=1 AND eliminado=0";
// EDITAR EMPLEADOS---------------------------------------------------------------------------------------------------------//
$listarEmpleado = "SELECT empleado.id_empleado, empleado.id_persona,empleado.id_rol,empleado.id_usuario, persona.nombre, persona.apellido, persona.edad, persona.dni, roles.rol, usuario.mail, usuario.clave
FROM empleado
INNER JOIN persona ON empleado.id_persona = persona.id_persona 
INNER JOIN roles ON empleado.id_rol  = cargo.id_rol 
INNER JOIN usuario ON empleado.id_usuario = usuario.id_usuario
WHERE id_empleado='$idEmpleado' AND empleado.habilitado=1 AND empleado.eliminado=0";

// EDITAR EMPLEADOS---------------------------------------------------------------------------------------------------------//

