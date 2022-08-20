<?php 
    //include '../globals.php';
    if (file_get_contents('https://counties-kenya.herokuapp.com/api/v1')) {
        $url = file_get_contents('https://counties-kenya.herokuapp.com/api/v1');
        $json_response = json_decode($url);
        $counties = array();
        for ($i = 0; $i < count($json_response); $i++) {
            array_push($counties, $json_response[$i]->name);
        }
        sort($counties);
       foreach($counties as $county) {
            echo "<option value=\"$county\" name='county'>$county</option>";
        }
    }

    //formResponse(true, $counties);
