<?php
session_start();
include "conf.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);

$u_name = mysqli_real_escape_string($conn, $_POST["name"]);
$u_email = mysqli_real_escape_string($conn, $_POST["email"]);
$u_pass = mysqli_real_escape_string($conn, $_POST["pass"]);
$u_re_pass = mysqli_real_escape_string($conn, $_POST["re_pass"]);
$u_city = mysqli_real_escape_string($conn, $_POST["city"]);
$u_district = mysqli_real_escape_string($conn, $_POST["district"]);
$u_address = mysqli_real_escape_string($conn, $_POST["address"]);
$role_id = mysqli_real_escape_string($conn, $_POST["user_type"]); 

if (!empty($u_name) && !empty($u_email) && !empty($u_pass) && !empty($role_id)) { 
    if (filter_var($u_email, FILTER_VALIDATE_EMAIL)) {
        $q = mysqli_query($conn, "SELECT * FROM `register` WHERE email = '{$u_email}'");
        if (mysqli_num_rows($q) > 0) {
            echo "$u_email - This email already exists";
        } else {
            if ($u_pass != $u_re_pass) {
                echo "Your passwords do not match";
            } else {
                $status = "signal_cellular_4_bar";
                $unique_id = rand(time(), 10000);
                $hash = password_hash($u_pass, PASSWORD_BCRYPT) ; 

                $final = $conn->query("INSERT INTO `register`(`unique_id`, `Name`, `email`, `password`, `status`, `role_id`, `city`, `district`, `address`) 
                VALUES ('$unique_id', '$u_name', '$u_email', '$hash', '$status', '$role_id', '$u_city', '$u_district', '$u_address')");
                
                if ($final === true) {
                    $q3 = $conn->query("SELECT * FROM `register` WHERE email = '$u_email'");
                    if (mysqli_num_rows($q3) > 0) {
                        $row = mysqli_fetch_assoc($q3);
                        $_SESSION["unique_id"] = $row["unique_id"];
                        $_SESSION["u_id"] = $row["u_id"];
                        $_SESSION["role_id"] = $row["role_id"];
                        echo true;
                    }
                    header("Location: ../index.php") ;
                } else {
                    echo 'Query failed: ' . $conn->error;
                }
            }
        }
    } else {
        echo "$u_email - This email is not valid";
    }
} else {
    echo "All input fields are required";
}


?>
