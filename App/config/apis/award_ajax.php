<?php
session_start();

include_once "../connection.php";
include_once "../globals.php";

if (isset($_POST['award'])) {
    // formResponse(true, 'success');
    $score = sanitize($_POST['score']);
    $rating = sanitize($_POST['rating']);
    $verdict = sanitize($_POST['verdict']);
    $ass_id = sanitize($_POST['ass_id']);
    $corrective = explode('ππ', $_POST['corrective']);
    
    $insp_id = '';
    $status = '';

    $res = array();
    $insertion = true;

    if ($verdict == 'qualifies') {
        $status = 'certified';
    } else {
        $status = 'rejected';
    }

    $score_sql = "INSERT INTO `inspection`(
        `score`, `rate`, `message`, `assignment_id`) VALUES ('$score','$rating','$verdict','$ass_id')";

    if ($conn->query($score_sql)) {
        // array_push($res, $score);

        $update_assigned = "UPDATE `evaluator_assignment` SET `inspected`= '1' WHERE `evaluator_assignment`.assignment_id = '$ass_id'";

        if ($conn->query($update_assigned)) {
            // array_push($res, 'updated inspected');

            $fetch_app_id = "SELECT application_id FROM `evaluator_assignment` WHERE evaluator_assignment.assignment_id = '$ass_id'";

            if ($exec = $conn->query($fetch_app_id)) {
                // array_push($res, 'fetch app_id successful');

                $result = $exec->fetch_assoc();
                $app_id = $result['application_id'];

                $update_status = "UPDATE `applications` SET `status`= '$status' WHERE `applications`.application_id = '$app_id'";

                $fetch_reg = "SELECT reg_num from applications WHERE applications.application_id = '$app_id'";
                if ($conn->query($update_status)) {
                    if ($reg_execute = $conn->query($fetch_reg)) {
                        $reg_assoc = $reg_execute->fetch_assoc();
                        $reg = $reg_assoc['reg_num'];
                        $normal_update = "UPDATE normal SET inspected = '1' WHERE normal.app_id = '$app_id'";
                        if ($conn->query($normal_update)) {
                            array_push($res, $score, $rating, $verdict);
                        } else {
                            array_push($res, 'update normal failed');
                            $insertion = false;
                        }
                    }

                    // array_push($res, 'update status successful');
                } else {
                    array_push($res, 'update status failed');
                    $insertion = false;
                }
            } else {
                array_push($res, 'fetch app_id failed');
                $insertion = false;
            }
        } else {
            array_push($res, 'couldn\'t update inspected');
            $insertion = false;
        }

        $fetch_insp_id = "SELECT inspection_id FROM inspection WHERE assignment_id = '$ass_id' ORDER BY inspection_id DESC LIMIT 1"; // use this for corrective actions to fetch inspection id
        if ($fetch_exec = $conn->query($fetch_insp_id)) {
            $result = $fetch_exec->fetch_assoc();
            $insp_id = sanitize($result['inspection_id']);
  

            if (isset($insp_id)) {
                foreach ($corrective as $corr) {
                    $corr_arr = explode('†,', $corr);
                    $first_char = str_split($corr_arr[0])[0];
                    if ($first_char == ',') {
                        $corr_arr[0] = substr($corr_arr[0], 1);
                    }
                  
                    if (count($corr_arr) == 3) {
                        $corr1 = sanitize($corr_arr[0]);
                        $corr2 = sanitize($corr_arr[1]);
                        $corr3 = sanitize($corr_arr[2]);
                        $corr_insert = "INSERT INTO `feedback`(`inspection_id`, `subject`, `obs`, `corrective_action`) VALUES ('$insp_id','$corr1','$corr2','$corr3')";

                        if ($conn->query($corr_insert)) {
                            array_push($res, 'corr inserted');
                        } else {
                            array_push($res, 'corr failed');
                            $insertion = false;
                        }
                    }
                }
            }
             else {
                array_push($res, 'insp_id not set');
                $insertion = false;
            }
        } else {
            array_push($res, 'insp_id fetch failed');
            $insertion = false;
        }
    } else {
        array_push($res, 'score insertion failed');
        $insertion = false;
    }

    formResponse($insertion, $res);

}

mysqli_close($conn);
