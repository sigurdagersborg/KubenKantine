<?php
require_once 'include/config_session.inc.php';
require_once 'include/signup/signup_view.inc.php';
require_once 'include/login/login_view.inc.php';
require_once "include/meny.inc.php";
require_once "include/dbconn.php";

function calculateTotalPrice($handlekurv) {
    $totalPrice = 0;
    foreach ($handlekurv as $item) {
        $totalPrice += $item['quantity'] * $item['price'];
    }
    return $totalPrice;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    global $pdo;
    if (!isset($_SESSION['user_id'])) {
        header("location: signup.php");
        exit();
    }
    $query = "INSERT INTO bestilling (Kundenummer) VALUES (:user_id);";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();
 
    $bestillingsnummer = $pdo->lastInsertId();
    $_SESSION['bestillingsnummer'] = $bestillingsnummer;

    foreach ($_SESSION['handlekurv'] as $item) {
        $query = "INSERT INTO produkt_i_bestilling (Bestillingsnummer, ProduktID, Antall, Pris) VALUES (:bestillingsnummer, :ProduktID, :Antall, :Pris);";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':bestillingsnummer', $bestillingsnummer);
        $stmt->bindParam(':ProduktID', $item['product_id']);
        $stmt->bindParam(':Antall', $item['quantity']);
        $stmt->bindParam(':Pris', $item['price']);
        $stmt->execute();
    }

   
}

    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body>
<html>

<table class="table">
<thead>
    <tr>
        <th>Produkt ID</th>
        <th>Antall</th>
        <th>Navn</th>
        <th>Pris per enhet</th>
        <th>Total pris</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($_SESSION['handlekurv'] as $item): ?>
        <tr>
            <td><?= $item['product_id'] ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= $item['name'] ?></td>
            <td><?= $item['price'] ?> kr</td>
            <td><?= number_format($item['quantity'] * $item['price'], 2) ?> kr</td>
        </tr>
    <?php endforeach; ?>
</tbody>
</table>

<p>Total pris for bestillingen: <?= number_format(calculateTotalPrice($_SESSION['handlekurv']), 2) ?> kr</p>

<h3>Ditt bestillingsnummer er: <?php echo $_SESSION['bestillingsnummer']; ?></h3>


<?php
 unset($_SESSION['handlekurv']);
 ?>
 </html>
</body>