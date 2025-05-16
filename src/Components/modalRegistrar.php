<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Llamo al archivo de la clase de conexión (lo requiero para poder instanciar la clase)
require_once 'src/ConectionBD/CConection.php';

// Instanciao la clase
$conectarDB = new ConectionDB();

// Obtengo la conexión
$conn = $conectarDB->getConnection();

// Llamo al archivo de las peticiones SQL
require_once 'src/Model/peticionesSql.php';

?>

<!-- Modal Registrar-->
<div class="modal fade " id="modalRegistrar" tabindex="-1" aria-labelledby="modalRegistrarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <div class="card " style="width: 100%; height: auto ">
          <div class="card-header">
            <h5 class="card-title text-center">Ingrese sus datos</h5>
          </div>
          <div class="card-body">
            <form method="post">
              <div class="d-grid gap-3">

                <div class="p-2 bg-light border">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                    <input type="email" name="email" class="form-control" placeholder="Ingrese su email" id="registrarEmail" aria-label="ingrese su email" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1">Password</span>
                    <input type="password" name="clave" class="form-control" placeholder="Inegrese password" id="registrarClave" aria-label="Inegrese password" aria-describedby="basic-addon1">
                  </div>
                </div>
                <div class="p-2 bg-light border">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Nombre</span>
                    <input type="text" name="nombre" class="form-control" id="registrarNombre" aria-label="nombre" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1">Apellido</span>
                    <input type="text" name="apellido" class="form-control" id="registrarApellido" aria-label="apellido" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1">Edad</span>
                    <input type="text" name="edad" class="form-control" id="registrarEdad" aria-label="edad" aria-describedby="basic-addon1">
                    <span class="input-group-text" id="basic-addon1">Dni</span>
                    <input type="text" name="dni" class="form-control" id="registrarDni" aria-label="dni" aria-describedby="basic-addon1">
                  </div>
                </div>

                <div class="p-2 bg-light border">
                  <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">Telefono</span>
                    <input type="text" name="telefono" class="form-control" id="registrarTelefono" aria-label="telefono" aria-describedby="basic-addon1">
                    <!-- LISTA DESPLEGABLE CARGAOS --------------------------------------->
                    <span class="input-group-text" id="basic-addon1">Cargo a desempeñar</span>
                    <select name="rol" class="form-select btn btn-secondary" style="width: auto;">
                      <?php
                      $listarRoles = mysqli_query($conn, $listarRol);
                      while ($row = mysqli_fetch_array($listarRoles)) { ?>
                        <option value="<?php echo $row["id_roles"] ?>"><?php echo $row["rol"] ?></option>
                      <?php } ?>
                    </select>
                    <!-- LISTA DESPLEGABLE CARGOS --------------------------------------->
                  </div>
                </div>
                <!--BOTON REGISTRAR USUARIO-->
                <div class="p-2 bg-light border">
                  <div class="input-group">
                    <button type="submit" name="crearEmpleado" class="btn btn-primary form-control">Registrar usuario</button>
                  </div>
                </div>
                <!--BOTON REGISTRAR USUARIO-->
              </div>

              <?php
              // crear empleado
              // si se hace click en el boton de crear empleado
              // se ejecuta la consulta de crear empleado
              if (isset($_POST['crearEmpleado'])) {
                $id_Rol = $_POST['rol'] ?? null;
                $ingresarPersona = mysqli_query($conn, $crearPersona);
                $idPersonaObtenido = mysqli_insert_id($conn);

                if (isset($idPersonaObtenido)) {

                  $clave = $_POST['clave'];
                  $hashed_password = password_hash($clave, PASSWORD_DEFAULT);
                  $registrarPersonaQuery = "INSERT INTO usuario (id_persona, email, clave) VALUES (?, ?, ?)";
                  $stmt = mysqli_prepare($conn, $registrarPersonaQuery);
                  mysqli_stmt_bind_param($stmt, "iss", $idPersonaObtenido, $email, $hashed_password);
                  mysqli_stmt_execute($stmt);

                  $idUsuarioObtenido = mysqli_insert_id($conn);

                  if (isset($idRol)) {
                    $crearEmpleado = "INSERT INTO empleado (id_rol,id_persona,id_usuario) VALUES (?,?,?)";
                    $stmt = mysqli_prepare($conn, $crearEmpleado);
                    mysqli_stmt_bind_param($stmt, "iii", $idRol, $idPersonaObtenido, $idUsuarioObtenido);
                    mysqli_stmt_execute($stmt);
                  }
                  echo "<script>alert('Usuario creado exitosamente');</script>";
                } else {
                  echo "<script>alert('Error al crear usuario');</script>";
                }
              }
              ?>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>