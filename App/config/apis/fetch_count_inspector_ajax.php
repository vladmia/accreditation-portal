<?php

session_start();

if (isset($_SESSION['eval_id'])) {

    include_once '../connection.php';
    include_once '../globals.php';

    $id = $_SESSION['eval_id'];
    $countArr = array();
    $output = 0;
    $error = "couldn't push";

    function getCount($conn, $someSql)
    {
        if ($res = $conn->query($someSql)) {
            $count = $res->num_rows;
            global $output,
                $countArr;
            array_push($countArr, $count);

            $output = 1;
        } else {
            global $error,
                   $countArr;
            array_push($countArr, $error);
        }
    }

    $sql_pending = "SELECT * FROM `evaluator_assignment` WHERE evaluator_assignment.eval_id = '$id' AND evaluator_assignment.inspected = '0'";

    $sql_inspected = "SELECT * FROM `evaluator_assignment` WHERE evaluator_assignment.eval_id = '$id' AND evaluator_assignment.inspected = '1'";

    $sql_total= "SELECT * FROM `evaluator_assignment` WHERE evaluator_assignment.eval_id = '$id'";

    $sql_certified= "SELECT * FROM `evaluator_assignment` NATURAL JOIN `applications` WHERE evaluator_assignment.eval_id = '$id' AND applications.status = 'certified'";

    $sql_rejected= "SELECT * FROM `evaluator_assignment` NATURAL JOIN `applications` WHERE evaluator_assignment.eval_id = '$id' AND applications.status = 'rejected'";

    getCount($conn, $sql_pending);
    getCount($conn, $sql_inspected);
    getCount($conn, $sql_total);
    getCount($conn, $sql_certified);
    getCount($conn, $sql_rejected);


    if ($output) {
        formResponse(true, $countArr);
    } else {
        formResponse(false, 'no query executed!');
    }
}
