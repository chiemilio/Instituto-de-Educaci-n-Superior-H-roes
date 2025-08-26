<?php
session_start();
$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=sql109.infinityfree.com;dbname=if0_39627297_INSTITUTO", "if0_39627297", "ftwc0s24jdb7");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $id = $_POST["idusuario"];
        $password = $_POST["password"];

        $stmt = $pdo->prepare("SELECT * FROM USUARIOS WHERE IDUsuario = ?");
        $stmt->execute([$id]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            $mensaje = "Usuario no registrado.";
        } elseif ($usuario["Password"] !== $password) {
            $mensaje = "Contraseña incorrecta.";
        } else {
            $_SESSION["usuario"] = $usuario;
            $mensaje = "¡Bienvenido " . $usuario["Nombre"] . " " . $usuario["ApellidoPaterno"] . " " . $usuario["ApellidoMaterno"] . "! Has ingresado como " . $usuario["TipoUsuario"] . ".";
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
    <title>Inicio de sesión</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-5 pt-3">
        <h1>Inicio de sesión</h1>
        <?php if (!isset($_SESSION["usuario"])): ?>
            <form method="POST" action="" class="mt-4 p-4 border rounded bg-light" style="max-width: 400px; margin:auto;">
                <div class="mb-3">
                    <label for="idusuario" class="form-label">ID Usuario:</label>
                    <input type="text" class="form-control" id="idusuario" name="idusuario" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
            </form>
        <?php endif; ?>
        <p><?php echo $mensaje; ?></p>
    </div>

</body>
</html>
