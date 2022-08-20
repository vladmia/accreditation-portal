<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$data = "";
$dataArr = array();
$id = sanitize($_SESSION['eval_id']);

$fetch_sql = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications`  NATURAL JOIN `evaluator_assignment` WHERE `evaluator_assignment`.inspected = '0' and `evaluator_assignment`.eval_id = '$id'";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reg = $row['reg_num'];
            $name = $row['nursery_name'];
            $man = $row['manager'];
            $phone = $row['manager_phone'];
            $dateAss = explode(' ', $row['date_assigned'])[0];
            $assignment_id = $row['assignment_id'];
            // global $dataArr;
            // array_push($dataArr, $reg, $name, $man, $phone, $dateAss, $assignment_id);

            global $data;
            $data .= "<tr class=\"data flex-sb-aic\">
           <td class=\"column1\">$reg</td>
           <td class=\"column2\">$name</td>
           <td class=\"column3\">$man</td>
           <td class=\"column4\">$phone</td>
           <td class=\"column5 date__ass\">$dateAss</td>
           <td class=\"column7 btn\"><i id=\"$reg\"class=\"fa fa-eye view__button\"></i></td>
           <td class=\"column6\">
             <button id=\"$assignment_id\" class=\"button inspectBtn apply_button\">Inspect</button>
           </td></tr>";
        }
    }
    $data .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
    formResponse(true, $data);
} else {
    formResponse(true, 'no fetch data');
}
