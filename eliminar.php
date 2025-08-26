<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
$mensaje = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $pdo = new PDO("mysql:host=sql109.infinityfree.com;dbname=if0_39627297_INSTITUTO", "if0_39627297", "ftwc0s24jdb7");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("DELETE FROM EXAMENES WHERE FolioExamen = ?");
        $stmt->execute([$_POST["folio"]]);
        $mensaje = "Examen eliminado correctamente.";
    } catch (PDOException $e) {
        $mensaje = "Error: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Eliminar Examen</title>
</head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
    <nav>
    <?php include 'navbar.php'; ?>
    <form method="POST">
            <div class="mb-3">
                <label for="folio" class="form-label">Folio del examen a eliminar:</label>
                <input type="number" class="form-control" id="folio" name="folio">
            </div>
            <button type="submit" class="btn btn-danger w-100">Eliminar</button>
        </form>
    <p><?php echo $mensaje; ?></p>
</body>

</html>