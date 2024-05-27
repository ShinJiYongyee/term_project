<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");
$sql ="SELECT * FROM projectTBL WHERE projectname='".$_GET['projectname']."'";

$ret = mysqli_query($con, $sql);
if($ret) {
    $count = mysqli_num_rows($ret);
    if($count==0) {
        echo $_GET['projectname']." 프로젝트가 없음!!!"."<BR>";
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
$projectname = $row['projectname'];

?>

<HTML>
<HEAD>
    <META http-equiv="content-type" content="text/html; charset=utf-8">
</HEAD>
<BODY>
　
<H1>프로젝트 삭제</H1>
<FORM METHOD="post" ACTION="delete_result.php">
    프로젝트명 : <INPUT TYPE="text" NAME="projectname" VALUE=<?php echo $projectname ?> READONLY> <BR>
    <BR>
    <BR><BR>
    위 프로젝트를 삭제하겠습니까?
    <INPUT TYPE="submit" VALUE="프로젝트 삭제">
</FORM>

</BODY>
</HTML>
