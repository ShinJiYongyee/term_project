<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

$projectname = $_POST["projectname"];
$intel = $_POST["intel"];
$phase = $_POST["phase"];
$employee = $_POST["employee"];
$deadline = $_POST["deadline"];

$sql = "INSERT INTO projectTBL (projectname, intel, phase, employee, deadline) VALUES ('$projectname', '$intel', '$phase', '$employee', '$deadline')";

$ret = mysqli_query($con, $sql);

echo "<H1>입력 결과</H1>";
if($ret) {
    echo "데이터가 성공적으로 입력됨.";
}
else {
    echo "데이터 입력 실패!!!"."<BR>";
    echo "실패 원인 :".mysqli_error($con);
}
mysqli_close($con);

echo "<BR> <A HREF='main.html'> <--초기 화면</A> ";
?>

