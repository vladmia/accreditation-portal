<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

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

$sql_unass = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications` WHERE `applications`.`assigned` = '0' ";

$sql_totalApp = "SELECT * FROM `nursery`  NATURAL JOIN `nursery_details` NATURAL JOIN `applications` WHERE nursery.applied = '1'";

$sql_pending = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications` NATURAL JOIN `evaluator_assignment` WHERE `evaluator_assignment`.inspected = '0'";

$sql_assigned = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications` WHERE applications.assigned = '1'";

$sql_owners = "SELECT * FROM `users`";

$sql_complete = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications` WHERE applications.status != 'pending'";

$sql_Total_Nurseries = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details`";

$sql_certified = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications` WHERE applications.status = 'certified'";

$sql_rej = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications` WHERE applications.status = 'rejected'";

getCount($conn, $sql_Total_Nurseries);
getCount($conn, $sql_totalApp);
getCount($conn, $sql_unass);
getCount($conn, $sql_assigned);
getCount($conn, $sql_pending);
getCount($conn, $sql_complete);
getCount($conn, $sql_owners);
getCount($conn, $sql_certified);
getCount($conn, $sql_rej);

if ($output) {
    formResponse(true, $countArr);
} else {
    formResponse(false, 'no query executed!');
}
