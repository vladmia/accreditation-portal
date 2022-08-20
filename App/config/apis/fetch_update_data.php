<?php

session_start();
if (isset($_POST['updateNursery'])) {
    $reg = $_POST['reg_num'];

    include '../globals.php';
    include '../connection.php';
    $sql = "SELECT * FROM `nursery` NATURAL JOIN `nursery_details` WHERE `nursery`.reg_num = '$reg'";

    $sql_2 = "SELECT category, species, seed_source, quantity FROM `species` WHERE `species`.reg_num = '$reg'";
    
    $exec = $conn->query($sql);
    $res = $exec->fetch_assoc();
    $reg_num = $res['reg_num'];
    // $uid = $res['user_id'];
    $man = $res['manager'];
    $phone = $res['manager_phone'];
    $name = $res['nursery_name'];
    $cat = $res['nursery_category'];
    $sub_cat = $res['sub_category'];
    $yoe = $res['YoE'];
    $area = $res['area'];
    $purpose = $res['purpose'];
    $cap = $res['capacity'];
    $county = $res['county'];
    $subcounty = $res['subcounty'];
    $town = $res['nearestTown'];
    $kfs = $res['kfs_registered'];
    $gps = $res['gps'];

    
    
    $res = [$reg_num, $man, $phone, $name, $cat, $sub_cat, $yoe, $area, $purpose, $cap, $county, $subcounty, $town, $gps, $kfs];

    $spec = array();

    $exec = $conn->query($sql_2);
    if ($exec->num_rows > 0) {
        while ($res_2 = $exec->fetch_assoc()) {
            array_push($spec, $res_2);
        }
    }
   
    formResponse(true, [$res, $spec]);
}


