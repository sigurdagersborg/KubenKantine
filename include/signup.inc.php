<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $username = $_POST['username'];
    $email = $_POST['epost'];
    $passord = $_POST['passord']; 

    try {
        require_once 'dbconn.php';
        require_once 'signup/signup_model.inc.php';
        require_once 'signup/signup_contr.inc.php';
        
        $errors = [];

        //error handlers
        if (is_input_empty($username, $email, $passord)) {
            $errors["empty_input"] = "Fill in all the fields!";
        }
        if (is_email_invalid($email) ) {
            $errors["invalid_email"] = "invalid email used!";
        }
        if (is_username_taken($pdo, $username)) {
            $errors["username_taken"] = "username taken!";
        }
        if (is_email_registered($pdo, $email)) {
            $errors["email_used"] = "email already registred!";
        }
        require_once 'config_session.inc.php';



        if ($errors) {
            $_SESSION["error_signup"] = $errors;

            $SignupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_Data"] = $SignupData;

            header("location: ../signup.php");
            die();
        }
    
        create_user($pdo, $passord, $username, $email);

        header("location: ../signup.php?signup=success");

        $pdo = null;
        $stmt = null;
         
        die();
    } catch (PDOException $e) {
        die("Query Failed: " . $e->getMessage());
    }


} else {
    header("location: ../signup.php");
    die();
}