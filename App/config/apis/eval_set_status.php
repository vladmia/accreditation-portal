<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$res = '';
$eval_id = sanitize($_GET['evID']);
$fetch_stat = "SELECT active FROM evaluators WHERE evaluator_id = $eval_id";

if ($result = $conn->query($fetch_stat)) {
    $set_stat = 0;
    $stat = $result->fetch_assoc()['active'];
    if ($stat == 1) {
        $set_stat = 0;
    } else {
        $set_stat = 1;
    }

    $update_stat = "UPDATE evaluators SET active = '$set_stat' WHERE evaluator_id = $eval_id";

    if ($conn->query($update_stat)) {
        $res .= 'success updating active';
        formResponse(true, $res);
    } else {
        formResponse(false, 'failed to update active');
    }

} else {
    formResponse(false, "failed to get active");
}
