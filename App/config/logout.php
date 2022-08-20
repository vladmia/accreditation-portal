<?php 
    session_start();
    // 
    if (!isset($_SESSION['username']) && !isset($_SESSION['admin_uname']) && !isset($_SESSION['ins_uname'])){
        header('location: ../../');
    } else {
    
        if (isset($_GET['owner'])) {
            unset($_SESSION['username']);
            if (isset($_SESSION['id'])) {
                unset($_SESSION['id']);
            }
            // session_destroy();
        }
        if (isset($_GET['insp'])) {
            unset($_SESSION['ins_uname']);
            if (isset($_SESSION['eval_id'])) {
                unset($_SESSION['eval_id']);
            }
            // session_destroy();
        }
        if (isset($_GET['admin'])) {
            unset($_SESSION['admin_uname']);
            // session_destroy();
        }
        header('location: ../../');
    }
?>