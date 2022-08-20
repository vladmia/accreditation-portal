<?php

function sanitize($message)
{
    include "connection.php";
    return mysqli_real_escape_string($conn, $message);
}

function has_data($message)
{
    return strlen(trim($message));
}

function formResponse($bool, $param)
{
    $success = $bool;
    $response = [$success, $param];
    echo json_encode($response);
}