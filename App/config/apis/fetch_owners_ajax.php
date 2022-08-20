<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

$res = '';

$fetch_sql = "SELECT * from users";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fname = $row['fname'];
            $lname = $row['lname'];
            $phone = $row['phone'];
            $email = $row['email'];
            
            global $res; 

            $res .= "<tr class=\"data flex-sb-aic\">
            <td class=\"column1\">$fname</td>
            <td class=\"column2\">$lname</td>
            <td class=\"column3\">$phone</td>
            <td class=\"column4\">$email</td></tr>";
            
        }
    }
    $res .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">There is no data to display here</td><td class="image"></td></tr>';
    // foreach($result as $res) {
    //     array_push($data, $res);
    // }
    formResponse(true, $res);
} else {
    formResponse(false, 'failed to fetch');
}
