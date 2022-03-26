<?php
session_start();
include "conn.php";
$stu_id = addslashes(strip_tags($_REQUEST['stud']));
$sql_check="SELECT * FROM `student` WHERE `id`='$stu_id'";

$sql_result= mysqli_query($conn,$sql_check);

$sql_result_array = mysqli_fetch_array($sql_result);

$result_count_of_rows = mysqli_num_rows($sql_result);

if($result_count_of_rows == 1){
    $date = date('Y-m-d');
    $sql_check="SELECT * FROM `student_detail` WHERE `student_id`='$stu_id' and `time_stamp`='$date'";
    $sql_result= mysqli_query($conn,$sql_check);
    $sql_result_array = mysqli_fetch_array($sql_result);
    $result_count_of_rows_student = mysqli_num_rows($sql_result);
    if($result_count_of_rows_student >= 1){
        $_SESSION['already_set']=$stu_id;
        header("location: scanner.php");
    }
    else{
        $insert_new_sql= "INSERT INTO `student_detail` (`student_id`, `time_stamp`) VALUES ('$stu_id', '$date');";
        $sql_establish= mysqli_query($conn,$insert_new_sql);
        $_SESSION['set_student']=$stu_id;
        header("location: scanner.php");
    }
}
else{
    $_SESSION['error']="error";

    header("location: scanner.php");
}

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv = "refresh" content = "1; url = ./scanner.html" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attend QR</title>
    <link rel="stylesheet" href="../css/styles.css">

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/favicon-16x16.png">
    <link rel="manifest" href="../assets/site.webmanifest">
</head>

<body>

    <div class="canvas">
        Attendance Taken.
    </div>
</body>
</html>