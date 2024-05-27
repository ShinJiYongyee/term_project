<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

$sql = "SELECT * FROM projectTBL";

$ret = mysqli_query($con, $sql);
if($ret) {
    $count = mysqli_num_rows($ret);
}
else {
    echo "projectTBL 데이터 검색 실패!!!"."<br>";
    echo "실패 원인 :".mysqli_error($con);
    exit();
}

echo "<H1>프로젝트 검색 결과</H1>";
echo "<TABLE BORDER=1>";
echo "<TR>";
echo "<TH>프로젝트명</TH> <TH>정보</TH> <TH>단계</TH> <TH>직원</TH> <TH>날짜</TH>";
echo "</TR>";
while($row = mysqli_fetch_array($ret)) {
    echo "<TR>";
    echo "<TD>", $row['projectname'], "</TD>";
    echo "<TD>", $row['intel'], "</TD>";
    echo "<TD>", $row['phase'], "</TD>";
    echo "<TD>", $row['employee'], "</TD>";
    echo "<TD>", $row['deadline'], "</TD>";
    echo "<TD>", "<A HREF='update.php?projectname=", $row['projectname'], "'>수정</A></TD>";
    echo "<TD>", "<A HREF='delete.php?projectname=", $row['projectname'], "'>삭제</A></TD>";
    echo "</TR>";
}

mysqli_close($con);
echo "</TABLE>";
echo "<BR> <A HREF='main.html'> <--초기 화면</A> ";
?>

