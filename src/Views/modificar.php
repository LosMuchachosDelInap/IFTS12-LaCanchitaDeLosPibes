<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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

// Llamo al archivo de las peticiones SQL
require_once __DIR__ . '/../Model/peticionesSql.php';

$idEmpleado = $_GET['idEmpleado'] ?? null;
?>

<!-- Modal Modificar Empleado-->
<div class="modal fade " id="modalModificar" tabindex="-1" aria-labelledby="modalModificarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="card " style="width: 100%; height: auto ">
                    <div class="card-header">
                        <h5 class="card-title text-center">Modificar Usuario</h5>
                    </div>
                    <div class="card-body">
                        <?php
                        // Listar empleado para editar
                        $listarRegistro = mysqli_query($conn, $listarEmpleado);
                        while ($rowModificar = mysqli_fetch_array($listarRegistro)) { ?>
                            <form action="src/Views/modificar.php " method="post" class="d-grid bg-dark p-2 rounded">
                                <!-- OBTENER LOS ID -------------------------------------------------------------------------------------------------------->
                                <input type="text" name="idPersona" value="<?php echo $rowModificar["idPersona"]; ?>" style="display: none;">
                                <input type="text" name="idUsuario" value="<?php echo $rowModificar["idUsuario"]; ?>" style="display: none;">
                                <input type="text" name="id_rol" value="<?php echo $rowModificar["id_rol"]; ?>" style="display: none;">
                                <input type="text" name="idEmpleado" value="<?php echo $rowModificar["idEmpleado"]; ?>" style="display: none;">
                                <!-- OBTENER LOS ID -------------------------------------------------------------------------------------------------------->
                                <div class="d-grid gap-3">

                                    <div class="p-2 bg-light border">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Email</span>
                                            <input type="email" name="email" value="<?php echo $rowModificar["email"]; ?>" class="form-control" placeholder="Nombre de usuario" id="registrarEmail" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1">Password</span>
                                            <input type="password" name="clave" value="<?php echo $rowModificar["clave"]; ?>" class="form-control" placeholder="Inegrese password" id="registrarClave" aria-label="Inegrese password" aria-describedby="basic-addon1">
                                        </div>
                                    </div>
                                    <div class="p-2 bg-light border">
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">Nombre</span>
                                            <input type="text" name="nombre" value="<?php echo $rowModificar["nombre"]; ?>" class="form-control" id="registrarNombre" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1">Apellido</span>
                                            <input type="text" name="apellido" value="<?php echo $rowModificar["apellido"]; ?>" class="form-control" id="registrarApellido" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1">Edad</span>
                                            <input type="text" name="edad" value="<?php echo $rowModificar["edad"]; ?>" class="form-control" id="registrarEdad" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                            <span class="input-group-text" id="basic-addon1">Dni</span>
                                            <input type="text" name="dni" value="<?php echo $rowModificar["dni"]; ?>" class="form-control" id="registrarDni" aria-label="Nombre de usuario" aria-describedby="basic-addon1">
                                        </div>
                                    </div>

                                    <div class="p-2 bg-light border">
                                        <div class="input-group">
                                          
                                            <span class="input-group-text" value="<?php echo $rowModificar["telefono"]; ?>" disabled id="basic-addon1">Telefono</span>
                                            <input type="text" name="telefono" id="registrarTelefono">
                                              <!-- LISTA DESPLEGABLE ROLES --------------------------------------->
                                            <span class="input-group-text" id="basic-addon1">Cargo a desempeñar</span>
                                            <select name="rol" class="form-select btn btn-secondary" style="width: auto;">
                                                <?php
                                                $listarRoles = mysqli_query($conn, $listarRol);
                                                while ($row = mysqli_fetch_array($listarRoles)) { ?>
                                                    <option value="<?php echo $row["id_rol"] ?>"><?php echo $row["rol"] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- LISTA DESPLEGABLE roles --------------------------------------->

                                    <div class="p-2 bg-light border">
                                        <div class="input-group">
                                            <button type="submit" name="modificarEmpleado" class="btn btn-primary form-control">Actualizar empleado</button>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                // Modificar empleado
                                if (isset($_POST['modificarEmpleado'])) {
                                    $idCargo = $_POST['roles'] ?? null;

                                    // Actualizar tabla persona
                                    $updatePersona = "UPDATE persona SET nombre=?, apellido=?, edad=?, dni=?, telefono=? WHERE id_persona=?";
                                    $stmtPersona = $conn->prepare($updatePersona);
                                    $stmtPersona->bind_param("sssssi", $nombre, $apellido, $edad, $dni, $telefono, $idPersona);


                                    // Actualizar tabla usuario
                                    $updateUsuario = "UPDATE usuario SET email=?, clave=? WHERE idPersona=?";
                                    $stmtUsuario = $conn->prepare($updateUsuario);
                                    $stmtUsuario->bind_param("ssi", $usuario, $clave, $idPersona);


                                    // Actualizar id_rol de la tabla empleado
                                    $updateEmpleado = "UPDATE empleado SET id_rol=? WHERE idPersona=?";
                                    $stmtEmpleado = $conn->prepare($updateEmpleado);
                                    $stmtEmpleado->bind_param("ii", $idCargo, $idPersona);


                                    if (!$stmtPersona->execute() || !$stmtUsuario->execute() || !$stmtEmpleado->execute()) {
                                        echo "Error al actualizar: " . $stmtPersona->error . $stmtUsuario->error . $stmtEmpleado->error;
                                        //} else {

                                        // header('location: listado.php');
                                    }
                                }
                                ?>
                            </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>