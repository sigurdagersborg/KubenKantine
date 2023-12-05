<?php

declare(strict_types=1);

function signup_inputs(){

  if (isset($_SESSION["signup_Data"]["username"]) && !isset($_SESSION["error_signup"]["username_taken"])) {
    echo'<div class="form-group">
    <label for="username">Brukernavn:</label>
    <input type="text" class="form-control" name="username" value="' . $_SESSION["signup_Data"]["username"] . '"></div>';
  } else {
    echo '<div class="form-group">
    <label for="username">Brukernavn:</label>
    <input type="text" class="form-control" name="username">
  </div>';
  }
    
if (isset($_SESSION["signup_Data"]["email"]) && !isset($_SESSION["error_signup"]["email_used"]) && !isset($_SESSION["error_signup"]["invalid_email"])) {
    echo'  <div class="form-group">
    <label for="Epost">Epost:</label>
    <input type="email" class="form-control" name="epost" required value="' . $_SESSION["signup_Data"]["email"] . '">
  </div>';
  } else {
    echo '  <div class="form-group">
    <label for="Epost">Epost:</label>
    <input type="email" class="form-control" name="epost" required>
  </div>';
  }
  echo '<div class="form-group">
  <label for="passord">Passord:</label>
  <input type="password" class="form-control" name="passord" required>
</div>';
}

function check_signup_errors(){
    if (isset($_SESSION['error_signup'])) {
    $errors = $_SESSION["error_signup"];

    echo "<br>";
    echo '<script>alert("' . implode("\n", $_SESSION['error_signup']) . '");</script>';
    foreach ($errors as $error) {
        echo '<p class="form-errors">' . $error . '</p>';
    }
    
    unset($_SESSION['errors_signup']);

}elseif (isset($_GET['signup']) && $_GET['signup'] === 'success') {
    echo '<br>';
    echo '<p class form-success">Signup success!</p>';

}
} 