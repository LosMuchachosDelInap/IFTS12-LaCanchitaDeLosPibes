<?php
// Llamo al archivo de la clase de conexión (lo requiero para poder instanciar la clase)
require_once 'src/ConectionBD/CConection.php';

// Instanciao la clase
$conexion = new ConectionDB();

// Obtengo la conexión
$conn = $conexion->getConnection();
// Creo el inicio de secion
?>

<div class="modal fade" id="modalLoguin" tabindex="-1" aria-labelledby="modalLoguinLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center modal-fondo">
                <div class="card" style="width: 100%; height: auto;">
                    <div class="card-header">
                        <h5 class="card-title text-center">Ingrese Usuario y Contraseña</h5>
                    </div>
                    <div class="card-body">
                       <form action="src/Controllers/validarUsuario.php" method="post" class="row g-3"> 
                            <div>
                                <label for="inputEmail" class="form-label">Usuario</label>
                                <input type="text" class="form-control" id="inputImail" name="email" required>
                            </div>
                            <div>
                                <label for="inputClave" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="inputClave" name="clave" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" name="botonLogin" class="btn btn-primary form-control">Ingresar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center mx-auto mt-5" role="alert" style="height: 10vh; width: 50vh;">
        <strong><?= htmlspecialchars($_SESSION['error_message'], ENT_QUOTES, 'UTF-8') ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['error_message']); ?>
<?php endif; ?>