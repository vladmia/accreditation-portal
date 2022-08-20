<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';


$data = "";
$id = sanitize($_SESSION['eval_id']);

$fetch_sql = "SELECT nursery.reg_num, nursery.nursery_name, applications.status, evaluator_assignment.date_assigned, applications.application_id FROM `nursery` NATURAL JOIN nursery_details NATURAL JOIN applications NATURAL JOIN evaluator_assignment WHERE nursery.applied = '1' AND evaluator_assignment.eval_id = '$id' ORDER BY application_id DESC";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reg = $row['reg_num'];
            $name = $row['nursery_name'];
            $status = $row['status'];
            $date_ass = explode(' ', $row['date_assigned'])[0];
            $app_id = $row['application_id'];

            $get_insp = "SELECT inspected from normal WHERE normal.app_id = '$app_id'";
            if ($insp_res = $conn->query($get_insp)) {
                $insp_assoc = $insp_res->fetch_assoc();
                $insp = $insp_assoc['inspected'];

                global $data;
                $data .= "";
                if ($insp == 0) {
                    $data .= "<tr class=\"data flex-sb-aic\">
                    <td class=\"column1\">$reg</td>
                    <td class=\"column2\">$name</td>
                    <td class=\"column5 date__assigned\">$date_ass</td>
                    <td class=\"column3 date__inspected\">__</td>
                    <td class=\"column6 btn\">__</td>
                    <td class=\"column3\">__</td>
                    <td class=\"column4\">$status</td><td class=\"column8 btn\"><i class=\"fa fa-comment view__feedback\" id=\"fbk-$app_id\" disabled></i></td></tr>";
                } else {
                    $fetch_sql_insp = "SELECT nursery.reg_num, nursery.nursery_name, applications.status,evaluator_assignment.date_assigned, 
                    inspection.inspection_date, inspection.score, inspection.rate FROM `nursery` NATURAL JOIN nursery_details NATURAL JOIN applications NATURAL JOIN inspection NATURAL JOIN evaluator_assignment WHERE nursery.applied = '1' AND evaluator_assignment.eval_id = '$id' AND applications.application_id = '$app_id' ORDER BY application_id DESC";

                    if ($fetch_insp_res = $conn->query($fetch_sql_insp)) {
                        if ($fetch_insp_res->num_rows > 0) {
                            while ($fetch_rows = $fetch_insp_res->fetch_assoc()) {
                                $reg = $fetch_rows['reg_num'];
                                $name = $fetch_rows['nursery_name'];
                                $status = $fetch_rows['status'];
                                $date_ass = explode(' ', $fetch_rows['date_assigned'])[0];
                                $date_insp = explode(' ', $fetch_rows['inspection_date'])[0];
                                $score = $fetch_rows['score'];
                                $rating = $fetch_rows['rate'];
                             

                                global $data;
                                $data .= "<tr class=\"data flex-sb-aic\">
                                <td class=\"column1\">$reg</td>
                                <td class=\"column2\">$name</td>
                                <td class=\"column3 date__assigned\">$date_ass</td>
                                <td class=\"column5 date__inspected\">$date_insp</td>
                                <td class=\"column6 btn\">$score%</td>
                                <td class=\"column7 btn\">$rating-star</td>
                                <td class=\"column4 status btn\">$status</td><td class=\"column8 btn\"><i class=\"fa fa-comment view__feedback\" id=\"fbk-$app_id\"></i></td></tr>";
                            }
                        }
                    }
                }

                $data .= "<tr class=\"app__empty d_none hide flex-col-jcaic\"><td class=\"message\">There is no data to display here</td><td class=\"image\"></td></tr>";
            }

          
        }
    }
    // foreach($result as $res) {
    //     array_push($data, $res);
    // }
    formResponse(true, $data);
} else {
    formResponse(true, 'failed to fetch');
}

// $message = 'accessed the fetch_app api';
// formResponse(true, $message);
