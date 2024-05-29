<?php
session_start();
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

if (!isset($_SESSION["username"])) {
    echo json_encode(["status" => "error", "message" => "Unauthorized"]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $projectname = mysqli_real_escape_string($con, $_POST["projectname"]);
    $intel = mysqli_real_escape_string($con, $_POST["intel"]);
    $phase = mysqli_real_escape_string($con, $_POST["phase"]);
    $employee = mysqli_real_escape_string($con, $_POST["employee"]);
    $deadline = mysqli_real_escape_string($con, $_POST["deadline"]);

    $sql = "UPDATE projectTBL SET intel='$intel', phase='$phase', employee='$employee', deadline='$deadline' WHERE projectname='$projectname'";
    if (mysqli_query($con, $sql)) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => mysqli_error($con)]);
    }
}
mysqli_close($con);
?>
