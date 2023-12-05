<?php
require_once "../include/config_session.inc.php";
require_once '../include/dbconn.php';
try {
    // Your code

    if (!isset($_SESSION['isAdmin'])) {
        header("location: ../signup.php");
        exit();
    }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->beginTransaction();

        // Check if 'isReady' is submitted
        if (isset($_POST['isReady'])) {
            $checkedReady = $_POST['isReady'];
            $query = "UPDATE bestilling SET IsReady = 0";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            foreach ($checkedReady as $bestillingsnummer) {
                $query = "UPDATE bestilling SET IsReady = 1 WHERE Bestillingsnummer = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$bestillingsnummer]);
            }
        }

        // Check if 'isPickedUp' is submitted
        if (isset($_POST['isPickedUp'])) {
            $checkedPickedUp = $_POST['isPickedUp'];
            $query = "UPDATE bestilling SET isPickedUp = 0";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            foreach ($checkedPickedUp as $bestillingsnummer) {
                $query = "UPDATE bestilling SET isPickedUp = 1 WHERE Bestillingsnummer = ?";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$bestillingsnummer]);
            }
        }

        $pdo->commit();
    } catch (Exception $e) {
        // An error occurred, rollback changes
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

$query = "SELECT * FROM bestilling";
$statement = $pdo->query($query);
$Bestillinger = $statement->fetchAll(PDO::FETCH_ASSOC);
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
        <h1 class="text-center">Admin Panel - Order Management</h1>
        <form method="post" action="">
            <table class="table">
                <thead>
                    <tr>
                        <th>Bestillingsnummer</th>
                        <th>Kundenummer</th>
                        <th>Bestillingsdato</th>
                        <th>IsReady</th>
                        <th>isPickedUp</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Bestillinger as $bestilling): ?>
                        <tr>
                            <td><?= $bestilling['Bestillingsnummer'] ?></td>
                            <td><?= $bestilling['Kundenummer'] ?></td>
                            <td><?= $bestilling['Bestillingsdato'] ?></td>
                            <td>
                                <input type="checkbox" name="isReady[]" value="<?= $bestilling['Bestillingsnummer'] ?>" <?= $bestilling['IsReady'] ? 'checked' : '' ?>>
                            </td>
                            <td>
                                <input type="checkbox" name="isPickedUp[]" value="<?= $bestilling['Bestillingsnummer'] ?>" <?= $bestilling['isPickedUp'] ? 'checked' : '' ?>>
                            </td>
                            <td>
                                <a href="edit_order.php?id=<?= $bestilling['Bestillingsnummer'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="delete_order.php?id=<?= $bestilling['Bestillingsnummer'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>

        <a href="index.php" class="btn btn-primary">Tilbake til valgside</a>
    </div>
</body>
</html>
<?php
} catch (Exception $e) {
    error_log("Error: " . $e->getMessage(), 0);
    echo "An error occurred. Please try again.";
}

?>