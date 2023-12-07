<?php
require_once 'include/config_session.inc.php';
require_once "include/dbconn.php";
require_once "include/meny.inc.php";

if (isset($_POST['add_to_order'])) {
    $product_id = $_POST['product_id'];
    $quantity = 1;
    addProductToOrder($product_id, $quantity);
}
function addProductToOrder($product_id, $quantity) 
{
    if (isset($_SESSION["user_id"])) {
        if (!isset($_SESSION['handlekurv'])) {
            $_SESSION['handlekurv'] = array();
        }

        $productIndex = array_search($product_id, array_column($_SESSION['handlekurv'], 'product_id'));

        if ($productIndex !== false) {
            $_SESSION['handlekurv'][$productIndex]['quantity'] += $quantity;
        } else {
            $productInfo = getProductInfo($product_id);
            $_SESSION['handlekurv'][] = array(
                'product_id' => $product_id,
                'quantity' => $quantity,
                'name' => $productInfo['Navn'],
                'price' => $productInfo['Pris'],
            );
        }
    } else {
        header("location: signup.php");
    }
}
function getProductInfo($product_id) 
{
    global $pdo;
    $query = "SELECT Navn, Pris FROM produkter WHERE id = ?";
    $statement = $pdo->prepare($query);
    $statement->execute([$product_id]);
    return $statement->fetch(PDO::FETCH_ASSOC);
}

function displayProducts($pdo, $dag) {
    $sql = "SELECT * FROM produkter WHERE dag = '$dag' OR dag = 'alle' ORDER BY (type = 'hovedrett') DESC, type";
    $stmt = $pdo->query($sql);
    $currentType = null;
    
    while ($product = $stmt->fetch(PDO::FETCH_ASSOC)) {
        if ($currentType !== $product['type']) {
            if ($currentType !== null) {
                echo '</div>';
            }
            echo "<h2 class='text-center'>" . $product['type'] . "</h2>";
            echo '<div class="row">';
            $currentType = $product['type'];
        }
        echoProductCard($product);
    }
}

function echoProductCard($row) {
    echo "<div class='col-lg-4 col-md-6 mb-4'>
            <div class='card'>
                <div class='card-body'>
                    <h5 class='card-title'>" . $row['navn'] . "</h5>
                    <p class='card-text'>" . $row['beskrivelse'] . "</p>
                    <p class='card-text'>Pris: " . $row['pris'] . " kr</p>
                    <form method='post' action=''>
                        <input type='hidden' name='product_id' value='" . $row['id'] . "'>
                        <button type='submit' class='btn btn-primary' name='add_to_order'>Legg til i bestilling</button>
                    </form>
                </div>
            </div>
        </div>";
}

$dag = date('l');

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bestill her</title>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h1 class="text-center">Bestill nå!</h1>

        <?php displayProducts($pdo, $dag);?>
    </div>

</body>
</html>
