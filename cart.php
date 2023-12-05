<?php
require_once 'include/config_session.inc.php';
require_once 'include/signup/signup_view.inc.php';
require_once 'include/login/login_view.inc.php';
require_once "include/meny.inc.php";
require_once "include/dbconn.php";



if (!isset($_SESSION['handlekurv'])) {
    $_SESSION['handlekurv'] = array();
}

if (isset($_GET['delete']) && isset($_SESSION['handlekurv'][$_GET['delete']])) {
    unset($_SESSION['handlekurv'][$_GET['delete']]);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brukerprofil</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>


    <div class="container mt-5">
        <h1 class="text-center">Shopping Cart</h1>
        <?php if (!empty($_SESSION['handlekurv'])): ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['handlekurv'] as $index => $item): ?>
                        <tr>
                            <td>
                                <?= $item['product_id'] ?>
                            </td>
                            <td>
                                <?= $item['name'] ?>
                            </td>
                            <td>
                                <?= $item['quantity'] ?>
                            </td>
                            <td>
                                <?= $item['price'] ?> kr
                            </td>
                            <td>
                                <a href="?delete=<?= $index ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <form method="post" action="checkout.php">
                <button type="submit" name="checkout" class="btn btn-success">Fullfør bestilling</button>
            </form>
        <?php else: ?>
            <p>Your shopping cart is empty.</p>
        <?php endif; ?>
        <a href="order.php" class="btn btn-primary">Back to Products</a>
    </div>
</body>

</html>