<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$data = "";
$dataArr = array();

function getMonth($val) {
    $month = '';
    if ($val == '01') {
        $month = 'Jan';
    } else if ($val == '02') {
        $month = 'Feb';
    } else if ($val == '03') {
        $month = 'Mar';
    } else if ($val == '04') {
        $month = 'Apr';
    } else if ($val == '05') {
        $month = 'May';
    } else if ($val == '06') {
        $month = 'June';
    } else if ($val == '07') {
        $month = 'July';
    } else if ($val == '08') {
        $month = 'Aug';
    } else if ($val == '09') {
        $month = 'Sep';
    } else if ($val == '10') {
        $month = 'Oct';
    } else if ($val == '11') {
        $month = 'Nov';
    } else if ($val == '12') {
        $month = 'Dec';
    } else {
        null;
    }
    return $month;
}

$fetch_sql = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` NATURAL JOIN `applications`  NATURAL JOIN `evaluator_assignment` NATURAL JOIN `inspection` WHERE applications.status = 'certified'";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reg = $row['reg_num'];
            $name = $row['nursery_name'];
            $owner = $row['sub_category'];
            $county = $row['county'];
            $rating = $row['rate'];
            $cap = $row['capacity'];
            $dateArray = explode("-", (explode(" ", $row['inspection_date'])[0]));
            $date_insp = getMonth($dateArray[1]) . ', ' . $dateArray[2] . ' ' . $dateArray[0];
            $class = $row['class'];
           
            // global $dataArr;
            // array_push($dataArr, $reg, $name, $man, $phone, $dateAss, $assignment_id);

            global $data;
            $data .= "<tr class=\"data flex-sb-aic\">
           <td class=\"column1\">$reg</td>
           <td class=\"column2\">$name</td>
           <td class=\"column3\">$county</td>
           <td class=\"column4 d-none\">$rating-star</td>
           <td class=\"column5\">$class</td>
           <td class=\"column6 d-none\">$date_insp</td>           
           <td class=\"column7 d-none\">$owner</td>           
           </tr>";
        }
    }
    $data .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
    formResponse(true, $data);
} else {
    formResponse(false, 'no fetch data');
}
