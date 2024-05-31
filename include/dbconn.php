<?php
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'KubenKantine';
    
    
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo -> setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        die("Connection failed: ".  $e->getMessage());
    }
