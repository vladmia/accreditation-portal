<?php

    include_once('../connection.php');
    include_once('../globals.php');

    $response = "";
    $evals = "";

    $fetch_unassigned = "SELECT * FROM nursery NATURAL JOIN nursery_details NATURAL JOIN applications WHERE applications.assigned = 0 ORDER BY application_id DESC";

    $fetch_evals = "SELECT evaluator_id, f_name, l_name, region FROM evaluators WHERE active = '1'";
    
    if ($fetch_eval_res = $conn->query($fetch_evals)) {
        $evals .= "<select><option  value=\"\" selected  >--.--</option>";
        while ($data = $fetch_eval_res->fetch_assoc()) {
            $eval_id = $data['evaluator_id'];
            $name = $data['f_name'] . " " . $data['l_name'];
            $region = $data['region'];
            $evals .= "<option value='$eval_id'>$name-$region</option>";
            // $evals .= "<option value=\"$data['evaluator_id']\">" . $data['f_name'] . $data['l_name'] . " - " . $data['region'] . "</option>"
        }
        $evals .= "</select>";
    }

    if ( $result = $conn->query($fetch_unassigned)) {
        if ($result->num_rows > 0) {
            while ($data = $result->fetch_assoc()) {
                $response .= "<tr class=\"data flex-sb-aic\"><td class='reg'>" . $data['reg_num'] . "</td><td class=\"column2\">" . $data['nursery_name'] . "</td><td class=\"date__reg\">" . explode(' ', $data['dateRegistered'])[0] . "</td><td>" . $data['county'] . "</td><td>$evals</td><td class=\"btn\"><i id=\"" . $data['reg_num'] . "\"class=\"fa fa-eye view__button\"></i></td></tr>";
            }
        }
        $response .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
        formResponse(true, $response);
    } else {
        formResponse(false, 'query failed');
    }


