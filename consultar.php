<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login.php");
    exit;
}
try {
    $pdo = new PDO("mysql:host=sql109.infinityfree.com;dbname=if0_39627297_INSTITUTO", "if0_39627297", "ftwc0s24jdb7");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM EXAMENES");
    $examenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Consultar Exámenes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="padding-top: 56px;">
    <?php include 'navbar.php'; ?>
    <h1>Listado de Exámenes</h1>
    <div class="container mt-4">
        <div class="table-responsive">
            <table class="table table-striped table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Folio</th>
                        <th>ID Usuario</th>
                        <th>Asignatura</th>
                        <th>Docente</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Aula</th>
                        <?php if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["TipoUsuario"] === "CE"): ?>
                            <th>Acciones</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($examenes as $examen): ?>
                        <tr>
                            <td><?php echo $examen["FolioExamen"]; ?></td>
                            <td><?php echo $examen["IDUsuario"]; ?></td>
                            <td><?php echo $examen["Asignatura"]; ?></td>
                            <td><?php echo $examen["DocenteAsignatura"]; ?></td>
                            <td><?php echo $examen["FechaAplicacion"]; ?></td>
                            <td><?php echo $examen["HoraAplicacion"]; ?></td>
                            <td><?php echo $examen["AulaAplicacion"]; ?></td>
                            <?php if (isset($_SESSION["usuario"]) && $_SESSION["usuario"]["TipoUsuario"] === "CE"): ?>
                                <td>
                                    <a href="modificar.php?folio=<?php echo $examen['FolioExamen']; ?>" class="btn btn-sm btn-warning me-2">Editar</a>
                                    <a href="eliminar.php?folio=<?php echo $examen['FolioExamen']; ?>" class="btn btn-sm btn-danger">Borrar</a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>