<?php
// Asegúrate de tener la sesión iniciada antes de este código
$rol = $_SESSION['nombre_rol'] ?? '';
?>

<?php if ($rol === 'Administrador' || $rol === 'Dueño'): ?>
    <!--SE MUESTRA SI ES ADMINISTRADOR O DUEÑO-->
    <li class="list-group-item bg-dark text-white">
      <!--  <a href="/Mis%20proyectos/IFTS12-LaCanchitaDeLosPibes/src/Views/listado.php" class="list-group-item">Listado de empleados</a> PARA USAR EN EL TRABAJO-->
        <a href="/src/Views/listado.php" class="list-group-item">Listado de empleados</a><!-- PARA USAR EN CASA-->
    </li>
        <li class="list-group-item bg-dark text-white">Reservar cancha</li>
<?php elseif ($rol !== 'Administrador' || $rol !== 'Dueño'): ?>
    <!--SI NO ES ADMINISTRADOR NI DUEÑO-->
    <li class="list-group-item bg-dark text-white">Reservar cancha</li>
<?php endif; ?>