<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$res = '';

$fetch_sql = "SELECT * from evaluators";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $eval_id = $row['evaluator_id'];
            $fname = $row['f_name'];
            $lname = $row['l_name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $region = $row['region'];
            $centre = $row['center'];
            $active = $row['active'];
            global $res; 

            if ($active) {
                $res .= "<tr class=\"data active flex-sb-aic\">";
            } else {
                $res .= "<tr class=\"data inactive flex-sb-aic\">";
            }


            $res .= "<td class=\"column1\">$fname</td>
            <td class=\"column2 last__name\">$lname</td>
            <td class=\"column3\">$email</td>
            <td class=\"column3\">$phone</td>
            <td class=\"column4\">$region</td>
            <td class=\"column5\">$centre</td>";
            if ($active) {
                $res .= "<td class=\"column6 btn\"><label class=\"switch activated\"><input id=\"$eval_id\" type=\"checkbox\" checked><span class=\"slider\"></span>
                </label></td></tr>";
            } else {
                $res .= "<td class=\"column6 btn\"><label class=\"switch\"><input id=\"$eval_id\" type=\"checkbox\"><span class=\"slider\"></span>
                </label></td></tr>";
            }

            
        }
    }
    $res .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
    // foreach($result as $res) {
    //     array_push($data, $res);
    // }
    formResponse(true, $res);
} else {
    formResponse(true, 'failed to fetch');
}
