<div class="modal fade" id="modalContactos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5 text-dark" id="exampleModalLabel">New message</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="/src/Controllers/contacto.php">
          <div class="mb-3">
            <label for="usuario" class="col-form-label text-dark text-start">Usuario</label>
            <input type="email" name="email" class="form-control" id="usuario"
              value="<?php echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') : ''; ?>"
              readonly>
          </div>
          <div class="mb-3">
            <label for="consulta" class="col-form-label text-dark text-start">Escribanos su cansulta:</label>
            <textarea name="contacto" class="form-control" id="consulta"></textarea>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>