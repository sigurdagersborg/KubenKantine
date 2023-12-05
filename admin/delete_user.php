<?php
require_once "../include/config_session.inc.php";
require_once '../include/dbconn.php';

if (!isset($_SESSION['isAdmin'])) {
    header("location: ../signup.php");
    exit();
}
if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    $query = "SELECT * FROM users WHERE id = :id";
    $statement = $pdo->prepare($query);
    $statement->bindParam(':id', $userId, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        header("Location: users.php");
        exit();
    }
} else {
    header("Location: users.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $getOrderQuery = "SELECT Bestillingsnummer FROM bestilling WHERE Kundenummer = :id";
    $getOrdernmberStmt = $pdo->prepare($getOrderQuery);
    $getOrdernmberStmt->bindParam(':id', $userId, PDO::PARAM_INT);

    $getOrdernmberStmt->execute();
    $bestillingsnummer = $getOrdernmberStmt->fetch(PDO::FETCH_ASSOC);

    if ($bestillingsnummer) {
        $deleteQuery = "DELETE FROM produkt_i_bestilling WHERE bestillingsnummer = :bestillingsnummer";
        $deleteStatement = $pdo->prepare($deleteQuery);
        $deleteStatement->bindParam(':bestillingsnummer', $bestillingsnummer['Bestillingsnummer'], PDO::PARAM_INT);
        $deleteStatement->execute();

        $deleteQuery = "DELETE FROM bestilling WHERE Kundenummer = :id";
        $deleteStatement = $pdo->prepare($deleteQuery);
        $deleteStatement->bindParam(':id', $userId, PDO::PARAM_INT);
        $deleteStatement->execute();


    }

    $deleteQuery = "DELETE FROM users WHERE id = :id";
    $deleteStatement = $pdo->prepare($deleteQuery);
    $deleteStatement->bindParam(':id', $userId, PDO::PARAM_INT);
    $deleteStatement->execute();

    header("Location: users.php");
    exit();






    // if ($deleteStatement->execute()) {
    //     header("Location: users.php");
    //     exit();
    // } else {
    //     echo "Error deleting user.";
    // }
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
        <h1 class="text-center">Delete User</h1>
        <p>Are you sure you want to delete the user <strong>
                <?= $user['username'] ?>
            </strong>?</p>
        <form method="post">
            <button type="submit" class="btn btn-danger">Yes, Delete User</button>
        </form>
        <a href="users.php" class="btn btn-secondary mt-3">Cancel</a>
    </div>
    <a href="index.php" class="btn btn-primary">Tilbake til valgside</a>
</body>

</html>