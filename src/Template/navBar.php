<!-- Example Code Start-->
<nav class="navbar navbar-dark bg-dark fixed-top">
  <div class="container-fluid d-flex align-items-center justify-content-between">
    <!-- Botón menú lateral -->
    <button
      class="navbar-toggler"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasDarkNavbar"
      aria-controls="offcanvasDarkNavbar"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Título centrado -->
    <a class="navbar-brand text-white mx-auto" href="index.php">Proyecto La canchita de los pibes</a>

    <!-- Botones de usuario a la derecha -->
    <div class="ms-auto d-flex align-items-center">

      <!--
      Esta porcion de codigo es para que el boton de ingresar y registrate se vea en la parte superior derecha
      si no hay nadie logueado, si hay alguien logueado se ve el boton de cerrar sesion. 
      -->
      <?php if (!isset($_SESSION['usuario']) || empty($_SESSION['usuario'])) { ?>
        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLoguin">
          Ingresar
        </button>
        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
          Registrate
        </button>
      <?php } else { ?>
        <a class="btn btn-danger" href="<?php echo dirname($_SERVER['PHP_SELF']) . 'src/Controllers/cerrarSesision.php'; ?>">
          <i class="bi bi-box-arrow-right"></i>
        </a>
      <?php } ?>
    </div>
  </div>

  <!-- Offcanvas -->
  <div
    class="offcanvas offcanvas-start text-bg-dark"
    tabindex="-1"
    id="offcanvasDarkNavbar"
    aria-labelledby="offcanvasDarkNavbarLabel">
    <div class="offcanvas-header bg-secondary">
      <h5 class="offcanvas-title" id="offcanvasNavbarLabel">
        Bienvenido: <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : "Ingrese Usuario" ?>
      </h5>
      <button
        type="button"
        class="btn-close btn-close-white"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="/src/Views/listado.php">Listar</a>
        </li>
      </ul>
    </div>
  </div>
</nav>