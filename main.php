<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

$sql = "SELECT * FROM projectTBL";

$ret = mysqli_query($con, $sql);
if($ret) {
    $count = mysqli_num_rows($ret);
} else {
    echo "검색 실패";
}
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");
$username = $_SESSION["username"];

$sql = "SELECT * FROM managerTBL WHERE username='$username'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>데이터베이스 기말과제 팀프로젝트 웹사이트창</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
</head>
<body>
<h2>Welcome, <?php echo $user["username"]; ?></h2>
<p>Rank: <?php echo $user["emprank"]; ?></p>
<p>Department: <?php echo $user["department"]; ?></p>

<br>
<div class="warp">
    <div class="intro_bg">
        <div class="display">
            <h1>프로젝트 검색 결과</h1>
            <table border="1">
                <tr>
                    <th>프로젝트명</th>
                    <th>정보</th>
                    <th>단계</th>
                    <th>직원</th>
                    <th>날짜</th>
                    <th>수정</th>
                    <th>삭제</th>
                </tr>
                <?php
                while($row = mysqli_fetch_array($ret)) {
                    echo "<tr>";
                    echo "<td>".$row['projectname']."</td>";
                    echo "<td>".$row['intel']."</td>";
                    echo "<td>".$row['phase']."</td>";
                    echo "<td>".$row['employee']."</td>";
                    echo "<td>".$row['deadline']."</td>";
                    echo "<td><a href='update.php?projectname=".$row['projectname']."'>수정</a></td>";
                    echo "<td><a href='delete.php?projectname=".$row['projectname']."'>삭제</a></td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <br>
        </div>
        <ul class="nav">
            <li><a href="insert.php">새 프로젝트 작성</a></li>
            <li>
                <form method="get" action="update.php">
                    <input type="text" name="projectname" placeholder="프로젝트명을 입력해주세요">
                    <input type="submit" value="기존 프로젝트 수정">
                </form>
            </li>
            <li>
                <form method="get" action="delete.php">
                    <input type="text" name="projectname" placeholder="프로젝트명을 입력해주세요">
                    <input type="submit" value="기존 프로젝트 삭제">
                </form>
            </li>
        </ul>
    </div>
    <a href="logout.php">Logout</a><br>
    <a href="manage_account.php">Manage Account</a>
</div>
<br>
</body>
</html>

<?php
mysqli_close($con);
?>