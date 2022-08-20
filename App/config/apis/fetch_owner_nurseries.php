<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$data = "";
$user_id = sanitize($_SESSION['id']);

$fetch_sql = "SELECT nursery.reg_num, nursery.nursery_name, nursery_details.manager, nursery.dateRegistered FROM `nursery` NATURAL JOIN nursery_details WHERE nursery.user_id = '$user_id' ORDER BY nursery_details.nursery_id DESC";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $reg = $row['reg_num'];
            $name = $row['nursery_name'];
            $man = $row['manager'];
            $reg_date = explode(' ', $row['dateRegistered'])[0];

           global $data;
           $data .= "<tr class=\"data flex-sb-aic\">
           <td class=\"column1\">$reg</td>
           <td class=\"column2\">$name</td>
           <td class=\"column3\">$man</td>
           <td class=\"column5 date__reg\">$reg_date</td>
           <td class=\"column6 btn\"><i id=\"$reg\" class=\"fa fa-eye view__button\"></i></td>
           <td class=\"column4 btn\">
             <i id=\"$reg\" class=\"fa fa-upload update__button\"></i>
           </td></tr>";
        }
    }
    $data .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
    // foreach($result as $res) {
    //     array_push($data, $res);
    // }
    formResponse(true, $data);
} else {
    formResponse(true, 'failed to fetch');
}

// $message = 'accessed the fetch_app api';
// formResponse(true, $message);
