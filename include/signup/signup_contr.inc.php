<?php

declare(strict_types=1);

function is_input_empty($username, $email, $passord){
    if (empty($username) || empty($email) || empty($passord)) {
        return true;
    }else{
        return false;
    }
}

function is_email_invalid(string $email){
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
    }else{
        return false;
    } 
}
function is_username_taken(object $pdo, string $username){
    if (get_username($pdo, $username)) {
        return true;
    }else{
        return false;
    }
}
function is_email_registered(object $pdo, string $email){
    if (get_email($pdo, $email)) {
        return true;
    }else{
        return false;
    }
}
function create_user(object $pdo, string $passord, string $username, string $email){
    set_user($pdo, $passord, $username, $email);
}