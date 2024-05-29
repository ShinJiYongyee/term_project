<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

$sql = "SELECT * FROM projectTBL WHERE projectname='".$_GET['projectname']."'";

$ret = mysqli_query($con, $sql);
if($ret) {
    $count = mysqli_num_rows($ret);
    if($count == 0) {
        echo $_GET['projectname']." 프로젝트 없음!!!"."<BR>";
        echo "<BR> <A HREF='main.html'> <--초기 화면</A> ";
        exit();
    }
} else {
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

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>프로젝트 정보 수정</title>
</head>
<body>

<h1>프로젝트 정보 수정</h1>
<form method="post" action="update_result.php">
    프로젝트 이름: <input type="text" name="projectname" value="<?php echo $projectname; ?>" required> <br>
    정보: <input type="text" name="intel" value="<?php echo $intel; ?>" required> <br>
    단계:
    <select name="phase" required>
        <option value="절차확립" <?php if($phase == '절차확립') echo 'selected'; ?>>절차확립</option>
        <option value="예산확보" <?php if($phase == '예산확보') echo 'selected'; ?>>예산확보</option>
        <option value="공정확보" <?php if($phase == '공정확보') echo 'selected'; ?>>공정확보</option>
        <option value="원자재준비" <?php if($phase == '원자재준비') echo 'selected'; ?>>원자재준비</option>
        <option value="공정가동" <?php if($phase == '공정가동') echo 'selected'; ?>>공정가동</option>
        <option value="홍보" <?php if($phase == '홍보') echo 'selected'; ?>>홍보</option>
        <option value="상품출시" <?php if($phase == '상품출시') echo 'selected'; ?>>상품출시</option>
        <option value="진행" <?php if($phase == '진행') echo 'selected'; ?>>진행</option>
        <option value="중간평가" <?php if($phase == '중간평가') echo 'selected'; ?>>중간평가</option>
        <option value="계획수정" <?php if($phase == '계획수정') echo 'selected'; ?>>계획수정</option>
        <option value="종결평가" <?php if($phase == '종결평가') echo 'selected'; ?>>종결평가</option>
        <option value="프로젝트종결" <?php if($phase == '프로젝트종결') echo 'selected'; ?>>프로젝트종결</option>
    </select>
    <br>
    담당자: <input type="text" name="employee" value="<?php echo $employee; ?>" required> <br>
    마감일: <input type="date" name="deadline" value="<?php echo $deadline; ?>" required> <br>
    <br>
    <input type="submit" value="정보 수정">
</form>

</body>
</html>
