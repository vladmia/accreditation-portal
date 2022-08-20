<?php

session_start();

$errors = array();
$url_1 = 'owner.php';
// $url_1 = 'vlad';
$url_2 = 'admin.php';
$url_3 = 'inspector.php';

include_once '../connection.php';

include_once '../globals.php';

if (isset($_POST['reg'])) { // registration
    $fname = sanitize($_POST['fname']);
    $lname = sanitize($_POST['lname']);
    $phone = sanitize($_POST['phone']);
    $email = sanitize($_POST['email']);
    $pass1 = sanitize($_POST['password_1']);
    $pass2 = sanitize($_POST['password_2']);

    $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = $conn->query($user_check_query);
    $user = $result->fetch_assoc();

    if ($user) {
        if ($user['email'] === $email) {
            array_push($errors, "The email address is already taken. Sign in instead");
        }
    } 
   
    if (!ctype_alpha($fname) || !ctype_alpha($lname)) {
        array_push($errors, 'Invalid name!');
    }
    if (!is_numeric($phone) || has_data($phone) < 9) {
        array_push($errors, 'Invalid phone number!');
    }
   
    if (!valid_pass($pass1)) {
        array_push($errors, 'The password format: at least 1 number, 1 uppercase letter and 8 or more characters');
    } 
    if ($pass1 != $pass2) {
        array_push($errors, "The two passwords do not match!");
    }

    if (count($errors) == 0) {
        $password = md5($pass1);

        $query = "INSERT INTO users ( fname, lname, phone, email, password) VALUES ('$fname','$lname', '$phone','$email', '$password')";
        $conn->query($query);

        $get_id_sql = "SELECT user_id FROM users WHERE users.email = '$email'";
        $exec = $conn->query($get_id_sql);
        $user = $exec->fetch_assoc();

        $_SESSION['id'] = sanitize($user['user_id']);
        $_SESSION['username'] = $fname;

        formResponse(true, $url_1);
    } else {
        formResponse(false, $errors);
    }

}

function valid_pass($candidate) {
    $r1='/[A-Z]/';  //Uppercase
    $r2='/[a-z]/';  //lowercase
    $r3='/[!@#$%^&*()\-_=+{};:,<.>]/';  // whatever you mean by 'special char'
    $r4='/[0-9]/';  //numbers
 
    if(preg_match_all($r1,$candidate, $o)<1) return FALSE;
 
    if(preg_match_all($r2,$candidate, $o)<2) return FALSE;
 
 //    if(preg_match_all($r3,$candidate, $o)<2) return FALSE;
 
    if(preg_match_all($r4,$candidate, $o)<1) return FALSE;
 
    if(strlen($candidate)<8) return FALSE;
 
    return TRUE;
 }

if (isset($_POST['login'])) { // login
    $email = sanitize($_POST['email']);
    $password = sanitize($_POST['password']);

    if (!has_data($email || !has_data($password))) {
        array_push($errors, "Cannot submit empty fields!");
    } else {
        $check_email = "SELECT * FROM users WHERE email='$email'";
        $check_exec = $conn->query($check_email);
        $results = $check_exec->fetch_assoc();

        if ($check_exec->num_rows < 1) {
            array_push($errors, "No account is registered with that email. Please sign up to create an account");
            formResponse(false, $errors);
        } else {
            $password = md5($password);
            if ($results['password'] !== $password) {
                array_push($errors, "Incorrect password!");
                formResponse(false, $errors);
            } else {
                $_SESSION['id'] = sanitize($results['user_id']);
                $_SESSION['username'] = sanitize($results['fname']);
                formResponse(true, $url_1);
            }
        }
    }
}

if (isset($_POST['admin_login'])) {

    $role = strtolower(sanitize($_POST['role']));

    if (!has_data($role)) {
        array_push($errors, 'Please select your role before attempting to log in');
        formResponse(false, $errors);
    } else {
        if ($role == 'admin') {
            $username = sanitize($_POST['username']);
            $password = sanitize($_POST['password']);

            $password = md5($password);
            $query = "SELECT * FROM admin WHERE username='$username' AND pass='$password'";
            $results = $conn->query($query);

            if (mysqli_num_rows($results) == 1) {
                $_SESSION['admin_uname'] = $username;
                formResponse(true, $url_2);
            } else {
                array_push($errors, "wrong username/password combination");
                formResponse(false, $errors);
            }

        } else if ($role == 'inspector') {
            $username = sanitize($_POST['username']);
            $password = sanitize($_POST['password']);

            $password = md5($password);
            $query = "SELECT * FROM evaluators WHERE username='$username' AND password='$password'";
            $results = $conn->query($query);
            $rowData = $results->fetch_assoc();

            if (mysqli_num_rows($results) == 1) {
                $_SESSION['ins_uname'] = $username;
                $_SESSION['eval_id'] = $rowData['evaluator_id'];
                formResponse(true, $url_3);
            } else {
                array_push($errors, "wrong username/password combination");
                formResponse(false, $errors);
            }

        }
    }
}

mysqli_close($conn);
