<?php

session_start();


include_once '../connection.php';
include_once '../globals.php';

$user_id = sanitize($_SESSION['id']);
$res = '';
$bool = true;

if (isset($_POST['applyNursery'])) {
    $reg_num = sanitize($_POST['reg_num']);

    $updateStatus = "UPDATE `nursery` SET `applied`='1' WHERE nursery.reg_num = '$reg_num'";

    if ($conn->query($updateStatus)) {
        $apply_sql = "INSERT INTO `applications`(`reg_num`) VALUES ('$reg_num')";
        if ($conn->query($apply_sql)) {

            $fetch_app_id = "SELECT application_id FROM applications WHERE applications.reg_num = '$reg_num' ORDER BY application_id DESC LIMIT 1";
            if ($fetch_app_id_exec = $conn->query($fetch_app_id)) {
                $res .= 'fetched app_id';
                if ($fetch_app_id_exec->num_rows > 0) {
                    $fetch_id_assoc = $fetch_app_id_exec->fetch_assoc();
                    $app_id = $fetch_id_assoc['application_id'];
                    $normal_insert = "INSERT INTO `normal`(`app_id`, `user_id`) VALUES ('$app_id', '$user_id')";
                    if ($conn->query($normal_insert)) {
                         $res .= ', inserted_normal';
                        $normal_update = "UPDATE `normal` SET `applied`='1' WHERE normal.app_id = '$app_id'";
                        if ($conn->query($normal_update)) {
                            $res .= ', updated normal successful';
                        } else {
                            $res .= ', update normal not successful';
                            $bool = false;
                        }
                    } else {
                        $res .= ', insert normal not successful';  
                        $bool = false;
                    }
                }

            } else {
                $res .= 'id not fetched';
                $bool = false;
            }

        } else {
            $res .= ', insert not successful';
            $bool = false;
        }

    } else {
        $res .= ", couldn't update status";
        $bool = false;
    }
    formResponse($bool, $res);
}
