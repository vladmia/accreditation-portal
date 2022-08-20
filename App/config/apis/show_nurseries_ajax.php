<?php

session_start();

include_once '../connection.php';
include_once '../globals.php';

if (isset($_POST['showNursery'])) {

    $data = "";
    $spec = "";
    $reg_num = sanitize($_POST['reg_num']);

    $fetch_sql = "SELECT * FROM `nursery` NATURAL JOIN nursery_details WHERE `nursery`.reg_num = '$reg_num'";

    if ($result = $conn->query($fetch_sql)) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $reg = $row['reg_num'];
                $name = $row['nursery_name'];
                $man = $row['manager'];
                $phone = $row['manager_phone'];
                $cat = $row['nursery_category'];
                $sub = $row['sub_category'];
                $yoe = $row['YoE'];
                $sub_county = $row['subcounty'];
                $town = $row['nearestTown'];
                $purpose = $row['purpose'];
                $cap = $row['capacity'];
                $area = $row['area'];
                $kfs = $row['kfs_registered'];
                $gps = $row['gps'];
                $reg_date = explode(' ', $row['dateRegistered'])[0];
                $county = $row['county'];

                global $data;
              
                $data .= "
                <div class=\"data__content\">
                    <label>Reg. No:</label>
                    <p>$reg</p>
                </div>
                <div class=\"data__content\">
                    <label>manager:</label>
                    <p>$man</p>
                </div>
                <div class=\"data__content\">
                    <label>manager's contact:</label>
                    <p>$phone</p>
                </div>
                <div class=\"data__content cat__name\">
                    <label>category:</label>
                    <p>$cat</p>
                </div>
                <div class=\"data__content\">
                    <label>category name:</label>
                    <p>$sub</p>
                </div>
                <div class=\"data__content\">
                    <label>Established:</label>
                    <p>$yoe</p>
                </div>
                <div class=\"data__content\">
                    <label>county:</label>
                    <p>$county</p>
                </div>
                <div class=\"data__content\">
                    <label>Sub-county:</label>
                    <p>$sub_county</p>
                </div>
                <div class=\"data__content\">
                    <label>Town:</label>
                    <p>$town</p>
                </div>
                <div class=\"data__content\">
                    <label>purpose:</label>
                    <p>$purpose</p>
                </div>
                <div class=\"data__content\">
                    <label>capacity:</label>
                    <p>$cap</p>
                </div>
                <div class=\"data__content\">
                    <label>area:</label>
                    <p>$area acres</p>
                </div>
                <div class=\"data__content\">
                    <label>Registered(KFS):</label>
                    <p>$kfs</p>
                </div>
                <div class=\"data__content gps\">
                    <label>GPS-Coordinates:</label>";
                if ($gps) {
                    $data .= "<p>$gps</p>";
                } else {
                    $data .= "<p>not provided</p>";
                }
                $data .= "</div>
                <div class=\"data__content\">
                    <label>date registered:</label>
                    <p>$reg_date</p>
                </div>
                ";
            }
        }

        $fetch_spec = "SELECT category, species, seed_source, quantity FROM `nursery` NATURAL JOIN `species` WHERE `nursery`.reg_num = '$reg_num'";

        if ($res = $conn->query($fetch_spec)) {
            if ($res->num_rows > 0) {
                while ($row_2 = $res->fetch_assoc()) {
                    $spec_cat = $row_2['category'];
                    $spec_name = $row_2['species'];
                    $spec_source = $row_2['seed_source'];
                    $spec_q = $row_2['quantity'];

                    global $spec;
                    $spec .= "<div class=\"species__row flex-se-aic\">
                    <p>$spec_cat</p>
                    <p>$spec_name</p>
                    <p>$spec_source</p>
                    <p>$spec_q</p>
                  </div>";
                }

            }
            formResponse(true, [$data, $spec]);
        } else {
            formResponse(false, 'species problem');
        }
       
    } else {
        formResponse(false, 'failed to fetch');
    }
}
