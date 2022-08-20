<?php

include '../globals.php';

if (($open = fopen("../kenya_subcounty.csv", "r")) !== false) {

    while (($data = fgetcsv($open, 1000, ",")) !== false) {
        $array[] = $data;
    }

    fclose($open);
}

//To display array data

function getSubCounty($county)
{
    global $array;
    $sorted = array();
    $res = "<option style='color: #666' value='' selected hidden disabled>
    --sub-county--
  </option>";
    foreach ($array as $arr) {
        if (strtolower($arr[0]) == strtolower($county)) {
            array_push($sorted, $arr[1]);
        }
    }
    sort($sorted);
    foreach($sorted as $name) {
        $res .= "<option value=\"$name\" name='county'>$name</option>";
    }
    return $res;
}

if (isset($_POST['activated'])) {
    $county = $_POST['county'];
    $res = getSubCounty($county);
    formResponse(true, $res);
}


