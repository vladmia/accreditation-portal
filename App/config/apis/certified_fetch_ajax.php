<?php

include_once '../connection.php';
include_once '../globals.php';

$data = "";
$showId = "show";

$fetch_sql = "SELECT nursery.reg_num, nursery.county, nursery.nursery_name, nursery.subcounty, nursery_details.manager, nursery_details.manager_phone FROM `nursery` NATURAL JOIN nursery_details NATURAL JOIN applications WHERE applications.status = 'certified'";

if ($result = $conn->query($fetch_sql)) {
    if ($result->num_rows > 0) {
        $count = 1;
        while ($row = $result->fetch_assoc()) {
            $county = $row['county'];
            $name = $row['nursery_name'];
            $sub = $row['subcounty'];
            $man = $row['manager'];
            $phone = $row['manager_phone'];
            $reg = $row['reg_num'];

            $fetch_species = "SELECT species FROM species WHERE species.reg_num = '$reg'";

            global $data,
                $showId;
            $data .= "<tr class=\"data flex-sb-aic\">
            <td class=\"column1 count\"><span>$count</span><span class=\"cell_info\"></span></td>
            <td class=\"column2\"><span class=\"label\">Nursery Name</span><span class=\"cell_info\">$name</span></td>
            <td class=\"column3 county\"><span class=\"label\">County</span><span class=\"cell_info\">$county</span></td>
            <td class=\"column4 subcounty\"><span class=\"label\">Sub-County</span><span class=\"cell_info\">$sub</span></td>
            <td class=\"column5\"><span class=\"label\">Manager</span><span class=\"cell_info\">$man</span></td>
            <td class=\"column6\"><span class=\"label\">Manager's Contact</span><span class=\"cell_info\">$phone</span></td>
            <td class=\"column7 btn\"><span class=\"label\">View Species</span><span class=\"cell_info\"><i class=\"fa fa-eye show\" id=\"$showId" . $count . "\"></i></span></td></tr>
            <div class=\"species__cont $showId" . $count . " hide\">
              <p class=\"species__caption flex-jc-aic\"></p>
              <div class=\"species__content\">";

            if ($spec_exec = $conn->query($fetch_species)) {
                while ($spec_assoc = $spec_exec->fetch_assoc()) {
                    $spec_name = $spec_assoc['species'];

                    $data .= "<p class=\"species\"><i class=\"fa fa-check bullet\"></i> $spec_name</p>";
                }
            }

            $data .= "</div>
              <div class=\"spec__mask\"></div>
            </div>";

            $count++;
        }
    }
    $data .= '<tr class="app__empty d_none hide flex-col-jcaic"><td class="message">No match found!</td><td class="image"></td></tr>';
    // foreach($result as $res) {
    //     array_push($data, $res);
    // }
    formResponse(true, $data);
} else {
    formResponse(false, 'failed to fetch');
}

// $message = 'accessed the fetch_app api';
// formResponse(true, $message);
