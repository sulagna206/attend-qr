<?php
session_start();
include "conn.php";

$user_name = addslashes(strip_tags($_REQUEST['username']));
$password  = addslashes(strip_tags($_REQUEST['password']));

$sql_check="SELECT * FROM `admin` WHERE `admin_username`='$user_name' AND `admin_password`='$password'";


$sql_result= mysqli_query($conn,$sql_check);


$sql_result_array = mysqli_fetch_array($sql_result);


$result_count_of_rows = mysqli_num_rows($sql_result);

if($result_count_of_rows == 1){
    header("location: scanner.php");
}
else {
    
    $_SESSION['error']="error";
    header("location: ../index.php"); }
?>