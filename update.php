<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

$sql = "SELECT * FROM projectTBL WHERE projectname='".$_GET['projectname']."'";

$ret = mysqli_query($con, $sql);
if($ret) {
    $count = mysqli_num_rows($ret);
    if($count==0) {
        echo $_GET['projectname']." 프로젝트 없음!!!"."<BR>";
        echo "<BR> <A HREF='main.html'> <--초기 화면</A> ";
        exit();
    }
}
else {
    echo "데이터 검색 실패!!!"."<BR>";
    echo "실패 원인 :".mysqli_error($con);
    echo "<BR> <A HREF='main.html'> <--초기 화면</A> ";
    exit();
}
$row = mysqli_fetch_array($ret);
$projectname = $row["projectname"];
$intel = $row["intel"];
$phase = $row["phase"];
$employee = $row["employee"];
$deadline = $row["deadline"];
?>

<HTML>
<HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8">
</HEAD>
<BODY>

<H1>프로젝트 정보 수정</H1>
<FORM METHOD="post" ACTION="update_result.php">

    프로젝트 이름 : <INPUT TYPE="text" NAME="projectname" VALUE="<?php echo $projectname?>"> <BR>
    정보 : <INPUT TYPE="text" NAME="intel" VALUE="<?php echo $intel?>"> <BR>
    단계 : <INPUT TYPE="text" NAME="phase" VALUE="<?php echo $phase?>"> <BR>
    담당자 : <INPUT TYPE="text" NAME="employee" VALUE="<?php echo $employee?>"> <BR>
    마감일 : <INPUT TYPE="text" NAME="deadline" VALUE="<?php echo $deadline?>"> <BR>
    <INPUT TYPE="submit" VALUE="정보 수정">
</FORM>

</BODY>
</HTML>

