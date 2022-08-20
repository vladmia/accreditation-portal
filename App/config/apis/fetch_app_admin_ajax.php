<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$data = "";
$inspector = "";
// $user_id = sanitize($_SESSION['id']);

$fetch_sql = "SELECT nursery.reg_num, nursery.nursery_name, applications.status, applications.assigned, `applications`.`application date`, applications.application_id FROM `nursery` NATURAL JOIN nursery_details NATURAL JOIN applications WHERE nursery.applied = '1' ORDER BY application_id DESC";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reg = $row['reg_num'];
            $name = $row['nursery_name'];
            $status;
            if ($row['status'] == "rejected") {
                $status = 'declined';
            } else {
                $status = $row['status'];
            }
            $date_app = explode(' ', $row['application date'])[0];
            $app_id = $row['application_id'];

            $get_insp = "SELECT inspected,assigned from normal WHERE normal.app_id = '$app_id'";
            if ($insp_res = $conn->query($get_insp)) {
                $insp_assoc = $insp_res->fetch_assoc();
                $insp = $insp_assoc['inspected'];
                $ass = $insp_assoc['assigned'];

                global $data,
                    $inspector;
                if ($insp == 0) {
                    $data .= "<tr class=\"data flex-sb-aic\">
                    <td class=\"column1\">$reg</td>
                    <td class=\"column2\">$name</td>
                    <td class=\"column3 date__applied\">$date_app</td>";
                    if ($ass == 0) {
                        $data .= "<td class=\"column8 date__ass\">__</td>";
                        $inspector = "__";
                    } else {
                        $get_date_ass_sql = "SELECT * FROM evaluator_assignment WHERE application_id = '$app_id'";

                        if ($ass_exec = $conn->query($get_date_ass_sql)) {
                            $ass_assoc = $ass_exec->fetch_assoc();
                            $date_ass = explode(' ', $ass_assoc['date_assigned'])[0];
                            $evaluator_id = $ass_assoc['eval_id'];
                            $inspector = get_evaluator($conn, $evaluator_id);
                            $data .= "<td class=\"column8 date__ass\">$date_ass</td>";
                        }

                    }
                    $data .= "<td class=\"column5 date__inspected\">__</td>
                    <td class=\"column8\">$inspector</td>
                    <td class=\"column6 btn\">__</td>
                    <td class=\"column7 btn\">__</td>
                    <td class=\"column4 status btn\">$status</td>
                    <td class=\"column8 btn\"><i class=\"fa fa-comment view__feedback\" id=\"fbk-$app_id\" disabled></i></td></tr>";
                } else {
                    $fetch_sql_insp = "SELECT nursery.reg_num, nursery.nursery_name, applications.status,`applications`.`application date`, evaluator_assignment.eval_id, inspection.score, inspection.rate, inspection.inspection_date, date_assigned FROM `nursery` NATURAL JOIN nursery_details NATURAL JOIN applications NATURAL JOIN inspection NATURAL JOIN evaluator_assignment WHERE nursery.applied = '1' AND applications.application_id = '$app_id' ORDER BY application_id DESC";

                    if ($fetch_insp_res = $conn->query($fetch_sql_insp)) {
                        if ($fetch_insp_res->num_rows > 0) {
                            while ($fetch_rows = $fetch_insp_res->fetch_assoc()) {
                                $reg = $fetch_rows['reg_num'];
                                $name = $fetch_rows['nursery_name'];
                                $status;
                                if ($fetch_rows['status'] == "rejected") {
                                    $status = 'declined';
                                } else {
                                    $status = $row['status'];
                                }
                                $date_app = explode(' ', $fetch_rows['application date'])[0];
                                $date_ass = explode(' ', $fetch_rows['date_assigned'])[0];
                                $score = $fetch_rows['score'];
                                $rating = $fetch_rows['rate'];
                                $date_insp = explode(' ', $fetch_rows['inspection_date'])[0];
                                $evaluator_id = $fetch_rows['eval_id'];
                                $inspector = get_evaluator($conn, $evaluator_id);
                                $data .= "<tr class=\"data flex-sb-aic\">
                                <td class=\"column1\">$reg</td>
                                <td class=\"column2\">$name</td>
                                <td class=\"column3 date__applied\">$date_app</td>
                                <td class=\"column8 date__ass\">$date_ass</td>
                                <td class=\"column5 date__inspected\">$date_insp</td>
                                <td class=\"column8\">$inspector</td>
                                <td class=\"column6 btn\">$score%</td>
                                <td class=\"column7 btn\">$rating-star</td>
                                <td class=\"column4 status btn\">$status</td>
                                <td class=\"column8 btn\"><i class=\"fa fa-comment view__feedback\" id=\"fbk-$app_id\"></i></td></tr>";
                            }
                        }
                    }
                }

            }

        }
    }
    global $data;
    $data .= "<tr class=\"app__empty d_none hide flex-col-jcaic\"><td class=\"message\">There is no data to display here</td><td class=\"image\"></td></tr>";
    // foreach($result as $res) {
    //     array_push($data, $res);
    // }

    formResponse(true, $data);
} else {
    formResponse(true, 'failed to fetch');
}

// $message = 'accessed the fetch_app api';
// formResponse(true, $message);
function get_evaluator($db, $evaluator_id)
{
 
    $get_inspector = "SELECT f_name, l_name FROM evaluators WHERE evaluator_id = '$evaluator_id'";
    if ($exec_inspectors = $db->query($get_inspector)) {
        $inspectors_assoc = $exec_inspectors->fetch_assoc();
        return $inspectors_assoc['f_name'] . " " . $inspectors_assoc['l_name'];
    } else {
        return "__ $evaluator_id";
    }
}
