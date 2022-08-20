<?php
session_start();
$errors = array();
include_once "../connection.php";
include_once "../globals.php";

if (isset($_POST['upNursery'])) {
    // formResponse(true, 'success');
    $man = sanitize($_POST['manager']);
    $phone = sanitize($_POST['manager_phone']);
    $area = sanitize($_POST['area']);
    $purpose = sanitize($_POST['purpose']);
    $cap = sanitize($_POST['capacity']);
    // $kfs = sanitize($_POST['kfs_registered']);
    $reg_num = sanitize($_POST['reg_num']);
    $speciesCat = explode(",", sanitize($_POST['speciesCat']));
    $speciesName = explode(",", sanitize($_POST['speciesName']));
    $quantity = explode(",", sanitize($_POST['quantity']));
    $source = explode(",", sanitize($_POST['source']));

    $res = array();
    $insertion = true;

    $modifiable = "UPDATE `nursery_details` SET `manager`='$man',`manager_phone`='$phone',`purpose`='$purpose',`capacity`='$cap',`area`='$area' WHERE `nursery_details`.reg_num ='$reg_num'";

    if ($conn->query($modifiable)) {
        //formResponse(true, 'nurseryDetails inserted successfully');
        array_push($res, "Nursery $reg_num is up to date");
        $del_sql = "DELETE FROM `species` WHERE `species`.reg_num = '$reg_num'";
        if ($conn->query($del_sql)) {
            array_push($res, 'deleted all rows');
            $index = 0;
            foreach ($speciesCat as $spec) {
                $species_insert = "INSERT INTO `species`(`category`, `species`, `seed_source`, `quantity`, `reg_num`) VALUES ('$spec','$speciesName[$index]','$source[$index]','$quantity[$index]','$reg_num')";
                $index += 1;

                if ($conn->query($species_insert)) {
                    array_push($res, 'species inserted');
                } else {
                    array_push($res, 'species failed');
                    $insertion = false;
                }
            }

            
        } else {
            array_push($res, 'species deletion failed');
        }
    } else {
        array_push($res, 'nursery details failed ');
        $insertion = false;
    }

    formResponse($insertion, $res);

}

mysqli_close($conn);
