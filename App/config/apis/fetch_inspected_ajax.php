<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$data = "";
$dataArr = array();
$id = sanitize($_SESSION['eval_id']);

$fetch_sql = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications`  NATURAL JOIN `evaluator_assignment` NATURAL JOIN `inspection` WHERE `evaluator_assignment`.inspected = '1' and `evaluator_assignment`.eval_id = '$id'";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reg = $row['reg_num'];
            $name = $row['nursery_name'];
            $dateAss = explode(' ', $row['date_assigned'])[0];
            $dateIns = explode(' ', $row['inspection_date'])[0];
            $score = $row['score'];
            $rating = $row['rate'];
            $status;
            if ($row['status'] == "rejected") {
                $status = 'declined';
            } else {
                $status = $row['status'];
            }
            $app_id = $row['application_id'];
            // global $dataArr;
            // array_push($dataArr, $reg, $name, $man, $phone, $dateAss, $assignment_id);

            global $data;
            $data .= "<tr class=\"data flex-sb-aic\">
           <td class=\"column1\">$reg</td>
           <td class=\"column2\">$name</td>
           <td class=\"column3\">$dateAss</td>
           <td class=\"column6 date__ins\">$dateIns</td>
           <td class=\"column5 btn\">$score%</td>
           <td class=\"column7 btn\">$rating-star</td>
           <td class=\"column4 status btn\">$status</td><td class=\"column8 btn\"><i class=\"fa fa-comment view__feedback\" id=\"fbk-$app_id\"></i></td></tr>";
        }
    }
    $data .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
    formResponse(true, $data);
} else {
    formResponse(true, 'no fetch data');
}
