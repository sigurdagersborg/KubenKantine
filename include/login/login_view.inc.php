<?php

declare(strict_types=1);

function output_username()
{
    if (isset($_SESSION["user_id"])) {
        echo '<p class="dropdown-item"> ' . $_SESSION["user_username"] . '</p>';
        echo '<div class="dropdown-divider"></div>';
        IsAdmin();
    } else {
        echo '<a class="dropdown-item" href="signup.php">Logg inn / Registrering</a>';
    }
}
function IsAdmin()
{
    if (isset($_SESSION["isAdmin"])) {
        echo '<a class="dropdown-item" href="admin">Admin</a>';
    }
}
function logged_in()
{
    if (isset($_SESSION["user_id"])) {
        echo '<form action="include/logout.inc.php" method="post">
                <button class="dropdown-item">Logg ut</button>
              </form>';
    } else {
        echo '';
    }
}


function check_login_errors()
{
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        echo "<br>";

        foreach ($errors as $error) {
            echo '<p class="form-errors">' . $error . '<p>';
        }

        unset($_SESSION["errors_login"]);
    } elseif (isset($_GET['login']) && $_GET['login'] === 'success') {
        header("location: index.php?login=success");
    }

}