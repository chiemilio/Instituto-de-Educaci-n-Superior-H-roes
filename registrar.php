<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
?>
<?php include 'navbar.php'; ?>
<?php
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=sql109.infinityfree.com;dbname=if0_39627297_INSTITUTO", "if0_39627297", "ftwc0s24jdb7");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("INSERT INTO EXAMENES (IDUsuario, Asignatura, DocenteAsignatura, FechaAplicacion, HoraAplicacion, AulaAplicacion) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $_POST["idusuario"],
            $_POST["asignatura"],
            $_POST["docente"],
            $_POST["fecha"],
            $_POST["hora"],
            $_POST["aula"]
        ]);
        $mensaje = "Examen registrado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Examen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h1>Registrar Examen</h1>
    <div class="container d-flex justify-content-center">
        <form method="POST" class="w-100" style="max-width:900px;">
            <div class="row g-3">
                <div class="col-lg-4 col-md-6 col-12">
                    <label for="idusuario" class="form-label">ID Usuario:</label>
                    <input type="text" class="form-control" id="idusuario" name="idusuario" data-bs-toggle="tooltip" title="Ingresa tu identificador de usuario proporcionado por el sistema.">
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <label for="asignatura" class="form-label">Asignatura:</label>
                    <input type="text" class="form-control" id="asignatura" name="asignatura" data-bs-toggle="tooltip" title="Nombre de la asignatura que presentarás.">
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <label for="docente" class="form-label">Docente Asignatura:</label>
                    <input type="text" class="form-control" id="docente" name="docente" data-bs-toggle="tooltip" title="Nombre completo del docente encargado de la asignatura.">
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <label for="fecha" class="form-label">Fecha Aplicación:</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" data-bs-toggle="tooltip" title="Selecciona la fecha en la que se aplicará el examen.">
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <label for="hora" class="form-label">Hora Aplicación:</label>
                    <input type="time" class="form-control" id="hora" name="hora" data-bs-toggle="tooltip" title="Selecciona la hora de inicio del examen.">
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <label for="aula" class="form-label">Aula Aplicación:</label>
                    <input type="text" class="form-control" id="aula" name="aula" data-bs-toggle="tooltip" title="Indica el aula donde se realizará el examen.">
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <button type="submit" class="btn btn-success w-100">Registrar</button>
                </div>
            </div>
        </form>
    </div>
    <p><?php echo $mensaje; ?></p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>
</body>

</html>