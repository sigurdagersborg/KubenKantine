<?php
require_once 'include/config_session.inc.php';
require_once "include/meny.inc.php";
require_once 'include/dbconn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css">
</head>
<body>

<div class="container">
    <h1>FAQ</h1>
    <div class="table-responsive">
        <?php
        try {
            $sql = "SELECT question, answer FROM faq";
            $stmt = $pdo->query($sql);

            if ($stmt->rowCount() > 0) {
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Question</th><th>Answer</th></tr></thead><tbody>";
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr><td>" . $row["question"] . "</td><td>" . $row["answer"] . "</td></tr>";
                }
                echo "</tbody></table>";
            } else {
                echo "<p>Ingen spørsmål og svar tilgjengelig.</p>";
            }
        } catch (PDOException $e) {
            echo "<p>Feil: " . $e->getMessage() . "</p>";
        }
        ?>
    </div>
    
    <h2>Flere spørsmål?</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="question">Spørsmål:</label>
            <input type="text" class="form-control" id="question" name="question" required>
        </div>
        <button type="submit" class="btn btn-primary">Send inn</button>
    </form>


    <?php
    //sjekke om formen er sendt inn
    if (isset($_POST["question"])) {
       $question = $_POST["question"];
       
       $query = "INSERT INTO faq (question) VALUES (:question);";
       $stmt = $pdo->prepare($query);
       $stmt->bindParam(':question', $question);
       $stmt->execute();


    }





    ?>

</div>

</body>
</html>

<?php
$pdo = null;
?>
