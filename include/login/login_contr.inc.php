<?php 


declare(strict_types=1);

function is_input_empty(string $username, string $passord){
    if (empty($username) || empty($passord)) {
        return true;
    }else{
        return false;
    }
}
function is_username_wrong(bool|array $result) {
    if (!$result) {
        return true;
    }else {
        return false;
    }
}
function is_password_wrong(string $passord, string $hashedpwd) {
    if (!password_verify($passord, $hashedpwd)) {
        return true;
    }else {
        return false;
    }
}