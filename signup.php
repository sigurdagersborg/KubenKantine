<?php
require_once 'include/config_session.inc.php';
require_once 'include/signup/signup_view.inc.php';
require_once 'include/login/login_view.inc.php';
require_once "include/meny.inc.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logg inn / Registrering</title>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 class="text-center">Vennligst logg inn:</h2>
      <form action="include/login.inc.php" method="post">
        <div class="form-group">
          <label for="username">Brukernavn:</label>
          <input type="text" class="form-control" name="username" required>
        </div>
        <div class="form-group">
          <label for="passord">Passord:</label>
          <input type="password" class="form-control" name="passord" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Logg inn</button>
      </form>
      <?php
      
      check_login_errors();
      ?> 
    </div>

    <div class="col-md-6 offset-md-3">
      <h2 class="text-center">Eller registrer ny bruker:</h2>
      <form action="include/signup.inc.php" method="post">

        <?php
        signup_inputs();
        ?>
        <button type="submit" class="btn btn-primary" name="submit">Registrer deg</button>
      </form>
      <?php
      check_signup_errors();
      ?>
    </div>
  </div>

</body>
</html>