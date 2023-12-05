<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $username = $_POST['username'];
    $passord = $_POST['passord'];

    try {
        require_once 'dbconn.php';
        require_once 'login/login_model.inc.php';
        require_once 'login/login_contr.inc.php';

        $errors = [];

        if (is_input_empty($username, $passord)) {
            $errors["empty_input"] = "Fill in all the fields!";
        }


        $result = get_user($pdo, $username);

        require_once 'config_session.inc.php';
        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        if (!is_username_wrong($result) && is_password_wrong($passord, $result["password"])) {
            $errors["login_incorrect"] = "Incorrect login info!";
        }
        if ($errors) {
            $_SESSION["errors_login"] = $errors;

            header("location: ../signup.php");
            die();
        }
        $newSessionId = session_create_id();
        $sessionId = $newSessionId . "_" . $result["id"];
        session_id($sessionId);

        $_SESSION["user_id"] = $result["id"];
        $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        $_SESSION["user_email"] = htmlspecialchars($result["email"]);

        if ($result["isAdmin"] === 1 || $result["isAdmin"] === 2) {
            $_SESSION["isAdmin"] = true;
        }
        
    
        if ($result["isAdmin"] === 2) {
        $_SESSION["isMaster"] = true;
        }

        $_SESSION["last_regeneration"] = time();

        if ($_SESSION["isAdmin"]) {
            header("location: ../admin");
        } else {
            header("location:  ../signup.php?login=success");
        }

        $pdo = null;
        $statement = null;

        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }

} else {
    header("location: ../signup.php");
    die();
}