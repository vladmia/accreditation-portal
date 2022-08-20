<?php
session_start();
if (isset($_POST['assignEval'])) {
    include_once '../connection.php';
    include_once '../globals.php';

    // $response = "";
    // $evals = "";

    // $fetch_evals = "SELECT evaluator_id, f_name, l_name, region FROM evaluators";

    // if ($fetch_eval_res = $conn->query($fetch_evals)) {
    //     $evals .= "<select><option  value=\"\" selected hidden disabled >--.--</option>";
    //     while ($data = $fetch_eval_res->fetch_assoc()) {
    //         $eval_id = $data['evaluator_id'];
    //         $name = $data['f_name'] . " " . $data['l_name'];
    //         $region = $data['region'];

    //         $evals .= "<option value='$eval_id'>$name-$region</option>";
    //         // $evals .= "<option value=\"$data['evaluator_id']\">" . $data['f_name'] . $data['l_name'] . " - " . $data['region'] . "</option>"
    //     }
    //     $evals .= "</select>";
    // }

    // if ($result = $conn->query($fetch_unassigned)) {
    //     if ($result->num_rows > 0) {
    //         while ($data = $result->fetch_assoc()) {
    //             $response .= "<tr class=\"flex-sb-aic\"><td>" . $data['reg_num'] . "</td><td>" . $data['nursery_name'] . "</td><td>" . $data['county'] . "</td><td>$evals</td></tr>";
    //         }
    //     }
    //     formResponse(true, $response);
    // } else {
    //     formResponse(false, 'query failed');
    // }

    $reg_num = explode(",", $_POST['reg']);
    $eval_id = explode(",", $_POST['eval']);
    $data = array();
    $GLOBALS['counter'] = 0;
  

    foreach ($reg_num as $reg) {
        global $data;

        $get_app_id = "SELECT application_id from `applications` WHERE applications.reg_num = '$reg' and applications.status = 'pending'"; //always has to be pending
        if ($res = $conn->query($get_app_id)) {
            $res_assoc = $res->fetch_assoc();
            $id = $res_assoc['application_id'];

            array_push($data, "$reg : fetched id -> 1");

            $ass_update = "UPDATE `applications` SET `assigned`='1' WHERE applications.reg_num = '$reg' AND applications.application_id = '$id'";
            if ($res = $conn->query($ass_update)) {
                array_push($data, "$reg : updated app -> 1");
                $ins_eval_ass = "INSERT INTO `evaluator_assignment`(`eval_id`, `application_id`) VALUES ('$eval_id[$counter]','$id')";
                if ($res = $conn->query($ins_eval_ass)) {
                    // form a response
                    $normal__update = "UPDATE `normal` SET `assigned`='1' WHERE normal.app_id = '$id'";
                    if ($conn->query($normal__update)) {
                        array_push($data, "$reg : updated normal assign -> 1");
                    } else {
                        array_push($data, "$reg : updated normal assign -> 0");
                    }
                    array_push($data, "$reg : inserted evalAss -> 1");
                } else {
                    array_push($data, "$reg : inserted evalAss -> 0");
                }
            } else {
                array_push($data, "$reg : updated app -> 0");
            }
            // array_push($data, $id);
        } else {
            array_push($data, "$reg : fetched id -> 0");
        }
        $counter++;
    }

    formResponse(true, $data);

}
