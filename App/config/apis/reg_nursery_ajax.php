<?php
session_start();
$errors = array();
include_once "../connection.php";
include_once "../globals.php";

if (isset($_POST['regNursery'])) {
    // formResponse(true, 'success');
    $man = sanitize($_POST['manager']);
    $phone = sanitize($_POST['manager_phone']);
    $nursery = sanitize($_POST['nurseryname']);
    $cat = sanitize($_POST['nursery_category']);
    $sub = sanitize($_POST['sub_category']);
    $yoe = sanitize($_POST['YoE']);
    $area = sanitize($_POST['area']);
    $purpose = sanitize($_POST['purpose']);
    $cap = sanitize($_POST['capacity']);
    $county = sanitize($_POST['county']);
    $subcounty = sanitize($_POST['subcounty']);
    $town = sanitize($_POST['town']);
    $gps = sanitize($_POST['gps']);
    $kfs = sanitize($_POST['kfs_registered']);
    $user_id = sanitize($_SESSION['id']);
    $reg_num = "";
    $speciesCat = explode(",", sanitize($_POST['speciesCat']));
    $speciesName = explode(",", sanitize($_POST['speciesName']));
    $quantity = explode(",", sanitize($_POST['quantity']));
    $source = explode(",", sanitize($_POST['source']));
    $class = "";

    if ($cap == 'Below 5,000' || $cap == 'small scale') {
        $class = "3";
    } else if ($cap == 'medium scale') {
        $class = "2";
    } else if ($cap == 'large scale') {
        $class = "1";
    }
    
    $res = array();
    $insertion = true;
    $reg_num = "";

    $permanents = "INSERT INTO `nursery`( `user_id`, `nursery_name`, `nursery_category`, `sub_category`, `YoE`, `county`, `subcounty`, `nearestTown`, `kfs_registered`, `gps`) VALUES ('$user_id','$nursery','$cat','$sub','$yoe','$county','$subcounty','$town','$kfs','$gps')";

    if ($conn->query($permanents)) {
        array_push($res, 'permanents inserted');
        global $reg_num;

        $fetch_reg_num = "SELECT reg_num FROM nursery WHERE user_id = '$user_id' ORDER BY reg_num DESC LIMIT 1";
        if ($fetch_exec = $conn->query($fetch_reg_num)) {
            //formResponse(true, 'reg_num fetched successfully');
            $result = $fetch_exec->fetch_assoc();
            $reg_num = sanitize($result['reg_num']);
        } else {
            array_push($res, 'reg_num fetch failed');
            $insertion = false;
        }
    } else {
        array_push($res, 'permanents failed');
        $insertion = false;
    }

    if (isset($reg_num)) {
        $modifiable = "INSERT INTO `nursery_details`( `manager`, `manager_phone`, `purpose`, `capacity`, `area`, `class`, `reg_num`) VALUES ('$man','$phone','$purpose','$cap','$area', '$class','$reg_num')";

        if ($conn->query($modifiable)) {
            //formResponse(true, 'nurseryDetails inserted successfully');
            array_push($res, "modifiable inserted => id($user_id) => reg => ($reg_num)");

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
            array_push($res, 'nursery details failed ');
            $insertion = false;
        }
    }

    formResponse($insertion, $res);

}

mysqli_close($conn);
