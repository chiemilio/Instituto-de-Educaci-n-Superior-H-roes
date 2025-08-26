<?php
// Barra de navegación Bootstrap 5 reutilizable
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">Instituto</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <?php if (!isset($_SESSION["usuario"])): ?>
          <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
          <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
          <li class="nav-item"><a class="nav-link" href="consultar.php">Consultar</a></li>
          <?php if (isset($_SESSION["usuario"]) && isset($_SESSION["usuario"]["TipoUsuario"]) && $_SESSION["usuario"]["TipoUsuario"] === "CE"): ?>
            <li class="nav-item"><a class="nav-link" href="registrar.php">Registrar</a></li>
            <li class="nav-item"><a class="nav-link" href="modificar.php">Modificar</a></li>
            <li class="nav-item"><a class="nav-link" href="eliminar.php">Eliminar</a></li>
          <?php elseif (isset($_SESSION["usuario"]) && isset($_SESSION["usuario"]["TipoUsuario"]) && $_SESSION["usuario"]["TipoUsuario"] === "ES"): ?>
            <li class="nav-item"><a class="nav-link" href="registrar.php">Registrar</a></li>
            <li class="nav-item"><a class="nav-link" href="login.php">Inicio de sesión</a></li>
          <?php endif; ?>
          <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
