<?php

    $host = 'localhost';
    $user = 'root';
    $db = 'accred_db_2';
    $password = '';

    $conn = new mysqli($host, $user, $password, $db);

    if ($conn->connect_error) {
        die('Connection failed!' . $conn->connect_error);
    }
?>
