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
    $newUsername = $_POST['username'];
    $newEmail = $_POST['email'];
    $isAdmin = $_POST['admin'];

    $updateQuery = "UPDATE users SET username = :username, email = :email, isAdmin = :isAdmin WHERE id = :id";
    $updateStatement = $pdo->prepare($updateQuery);
    $updateStatement->bindParam(':username', $newUsername, PDO::PARAM_STR);
    $updateStatement->bindParam(':email', $newEmail, PDO::PARAM_STR);
    $updateStatement->bindParam(':isAdmin', $isAdmin, PDO::PARAM_INT);
    $updateStatement->bindParam(':id', $userId, PDO::PARAM_INT);


    if ($updateStatement->execute()) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error";
    }
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
        <h1 class="text-center">Edit User</h1>
        <form method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?= $user['username'] ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" required>
            </div>
            <?php
            if (isset($_SESSION["isMaster"])) { ?>
                <div class="mb-3">
                    <label for="admin" class="form-label">Admin</label>
                    <select class="form-control" id="admin" name="admin">
                        <option value="0" <?php echo $user['isAdmin'] == 0 ? 'selected' : ''; ?>>Kunde</option>
                        <option value="1" <?php echo $user['isAdmin'] == 1 ? 'selected' : ''; ?>>Ansatt</option>
                        <option value="2" <?php echo $user['isAdmin'] == 2 ? 'selected' : ''; ?>>Master</option>
                    </select>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Update User</button>
        </form>
        <a href="users.php" class="btn btn-secondary mt-3">Back to Users</a>
        <a href="index.php" class="btn btn-primary">Tilbake til valgside</a>
    </div>

</body>

</html>