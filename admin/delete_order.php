<?php
require_once "../include/config_session.inc.php";
require_once '../include/dbconn.php';

if (!isset($_SESSION['isAdmin'])) {
    header("location: ../signup.php");
    exit();
}

if (isset($_GET['bestillingsnummer'])) {
    $bestillingsnummer = $_GET['bestillingsnummer'];

    $query = "SELECT * FROM bestilling WHERE Bestillingsnummer = :bestillingsnummer";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':bestillingsnummer', $bestillingsnummer, PDO::PARAM_INT);
    $statement->execute();
    $order = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$order) {
        header("Location: orders.php");
        exit();
    }
} else {
    header("Location: orders.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $deleteProductQuery = "DELETE FROM produkt_i_bestilling WHERE Bestillingsnummer = :bestillingsnummer";
    $deleteProductStmt = $pdo->prepare($deleteProductQuery);
    $deleteProductStmt->bindParam(':bestillingsnummer', $bestillingsnummer, PDO::PARAM_INT);
    $deleteProductStmt->execute();

    $deleteOrderQuery = "DELETE FROM bestilling WHERE Bestillingsnummer = :bestillingsnummer";
    $deleteOrderStmt = $pdo->prepare($deleteOrderQuery);
    $deleteOrderStmt->bindParam(':bestillingsnummer', $bestillingsnummer, PDO::PARAM_INT);
    $deleteOrderStmt->execute();

    header("Location: orders.php");
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
        <h1 class="text-center">Delete Order</h1>
        <p>Are you sure you want to delete the order with Bestillingsnummer <strong>
                <?= htmlspecialchars($bestillingsnummer) ?>
            </strong>?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Yes, Delete Order</button>
        </form>
        <a href="orders.php" class="btn btn-secondary mt-3">Cancel</a>
    </div>
    <a href="index.php" class="btn btn-primary">Tilbake til valgside</a>
</body>

</html>
