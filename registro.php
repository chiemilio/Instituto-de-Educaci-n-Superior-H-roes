<?php
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=sql109.infinityfree.com;dbname=if0_39627297_INSTITUTO", "if0_39627297", "ftwc0s24jdb7");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST["idusuario"];
        $nombre = $_POST["nombre"];
        $apellidop = $_POST["apellidop"];
        $apellidom = $_POST["apellidom"];
        $edad = $_POST["edad"];
        $sexo = $_POST["sexo"];
        $email = $_POST["email"];
        $telefono = $_POST["telefono"];
        $password = $_POST["password"];
        $confirmacion = $_POST["confirmar"];

        if (
            empty($id) || empty($nombre) || empty($apellidop) || empty($apellidom) || empty($edad) ||
            empty($sexo) || empty($email) || empty($telefono) || empty($password) || empty($confirmacion)
        ) {
            $mensaje = "Todos los campos son obligatorios.";
        } elseif ($password !== $confirmacion) {
            $mensaje = "Las contraseñas no coinciden.";
        } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\\d)(?=.*[#\\$\\-_%&]).{8,}$/", $password)) {
            $mensaje = "La contraseña no cumple con los requisitos de seguridad.";
        } else {
            $stmt = $pdo->prepare("SELECT IDUsuario FROM USUARIOS WHERE IDUsuario = ?");
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                $mensaje = "El ID de usuario ya existe.";
            } else {
                $stmt = $pdo->prepare("INSERT INTO USUARIOS 
                    (IDUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, Telefono, TipoUsuario, Password)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'ES', ?)");
                $stmt->execute([$id, $nombre, $apellidop, $apellidom, $edad, $sexo, $email, $telefono, $password]);
                $mensaje = "Usuario registrado correctamente.";
            }
        }
    } catch (PDOException $e) {
        $mensaje = "Error en la base de datos: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Estudiantes</title>
    <!-- Agregar enlaces a Bootstrap CSS y JavaScript -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Instituto</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="registro.php">Registrarse</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Iniciar sesión</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Formulario de registro con tooltips Bootstrap 5 -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h1 class="text-center">Formulario de Registro</h1>
                <form method="POST" action="" class="row g-3">
                    <!-- Nombre -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu nombre completo.">
                    </div>
                    <!-- Apellido Paterno -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="apellidoPaterno" class="form-label">Apellido Paterno</label>
                        <input type="text" class="form-control" id="apellidoPaterno" name="apellidoPaterno" required
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu primer apellido.">
                    </div>
                    <!-- Apellido Materno -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="apellidoMaterno" class="form-label">Apellido Materno</label>
                        <input type="text" class="form-control" id="apellidoMaterno" name="apellidoMaterno" required
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Escribe tu segundo apellido.">
                    </div>
                    <!-- ID Usuario -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="idusuario" class="form-label">ID Usuario</label>
                        <input type="text" class="form-control" id="idusuario" name="idusuario" required
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Ingresa tu matrícula o número de usuario.">
                    </div>
                    <!-- Correo Electrónico -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Introduce un correo electrónico válido.">
                    </div>
                    <!-- Contraseña -->
                    <div class="col-12 col-md-6 col-lg-4">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required
                            data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Longitud mínima de 8 posiciones, con letras y números y por lo menos un carácter especial (#,$,-,_,&,%).">
                    </div>
                    <!-- Botón -->
                     <br>
                    <div class="col-12 text-center mt-20">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
                <p class="text-danger text-center"><?php echo $mensaje; ?></p>
            </div>
        </div>
    </div>

    <!-- Inicialización de tooltips Bootstrap 5 -->
    <script>
      document.addEventListener('DOMContentLoaded', function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function (tooltipTriggerEl) {
          new bootstrap.Tooltip(tooltipTriggerEl);
        });
      });
    </script>
</body>

</html>