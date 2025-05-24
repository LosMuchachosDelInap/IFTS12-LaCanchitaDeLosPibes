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
      <?php if (!isset($_SESSION['email']) || empty($_SESSION['email'])) { ?>
        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalLoguin">
          Ingresar
        </button>
        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
          Registrate
        </button>
      <?php } else { ?><!--cambiar la ruta en casa-->
        <a class="btn btn-danger" href="/Mis%20proyectos/IFTS12-LaCanchitaDeLosPibes/src/Controllers/cerrarSesision.php"><!-- PARA USAR EN EL TRABAJO-->
          <!--<a class="btn btn-danger" href="../Controllers/cerrarSesision.php"> PARA USAR EN CASA-->
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
        Bienvenido:
        <?php
        echo isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email'], ENT_QUOTES, 'UTF-8') : 'Inicie Secion';
        echo ' / ';
        echo isset($_SESSION['nombre_rol']) ? htmlspecialchars($_SESSION['nombre_rol'], ENT_QUOTES, 'UTF-8') : '';
        ?>
      </h5>
      <button
        type="button"
        class="btn-close btn-close-white"
        data-bs-dismiss="offcanvas"
        aria-label="Close"></button>
    </div>

    <!--LISTADO DE TABLA LATERAL SEGUN ROL-->
    <div class="list-group-flush text-start p-3 m-0 border-0 bd-example m-0 border-0">
      <ul class="list-group list-group-flush bg-dark text-white text-start">
        <li class="list-group-item bg-dark text-white">
          <!-- esta porcion de codigo "dirname($_SERVER['PHP_SELF'])" inserta la ruta hasta donde esta el proyecto 
       ejemplo: http://localhost/Mis%20proyectos/IFTS12-lacanchitadelospibes , luego colocamos la ruta que falta hasta el archivo-->
          <!--<a href="<?php
                        //echo dirname($_SERVER['PHP_SELF']) . '../../../index.php'; 
                        ?>" class="bg-dark text-white text-decoration-none">Home</a>--> <!--USAR EN EL TRABAJO-->
          <a href="../src/index.php" class="bg-dark text-white text-decoration-none">Home</a> <!--USAR EN casa-->
        </li>
        <!--SE MUESTRA SEGUN ROL-->
        <?php require_once __DIR__ . '/../Controllers/navBarListGroup.php'; ?>
      </ul>
    </div>


    <!--LISTADO DE TABLA LATERAL SEGUN ROL-->

  </div>
</nav>