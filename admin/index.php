<?php
require_once "../include/config_session.inc.php";
require_once '../include/dbconn.php';
if (!isset($_SESSION['isAdmin'])) {
    header("location: ../signup.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">

        <a href="../index.php" class="btn btn-primary">Tilbake til bestillingsside</a>
        <a href="users.php" class="btn btn-primary">Brukerbehandling</a>
        <a href="orders.php" class="btn btn-primary">Ordrebehandling</a>

    </div>
</body>

</html>