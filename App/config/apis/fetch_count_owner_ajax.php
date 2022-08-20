<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$user_id = sanitize($_SESSION['id']);
$countArr = array();
$output = 0;

function getCount($conn, $someSql)
{
    if ($res = $conn->query($someSql)) {
        $count = $res->num_rows;
        global $output,
            $countArr;
        array_push($countArr, $count);

        $output = 1;
    }
}

$sql_1 = "SELECT * FROM `nursery` WHERE nursery.user_id = '$user_id'";
$sql_2 = "SELECT * FROM `nursery` WHERE nursery.applied = '1' AND nursery.user_id = '$user_id'";
$sql_3 = "SELECT * FROM `nursery` WHERE nursery.applied = '0' AND nursery.user_id = '$user_id'";
$sql_4 = "SELECT * FROM `nursery` NATURAL JOIN `applications` WHERE nursery.user_id = '$user_id' AND applications.status = 'pending'";
$sql_5 = "SELECT * FROM `nursery` NATURAL JOIN `applications` WHERE nursery.user_id = '$user_id' AND applications.status = 'certified'";
$sql_6 = "SELECT * FROM `nursery` NATURAL JOIN `applications` WHERE nursery.user_id = '$user_id' AND applications.status = 'rejected'";

getCount($conn, $sql_1);
getCount($conn, $sql_2);
getCount($conn, $sql_3);
getCount($conn, $sql_4);
getCount($conn, $sql_5);
getCount($conn, $sql_6);
if ($output) {
    formResponse(true, $countArr);
} else {
    formResponse(false, 'no query executed!');
}
