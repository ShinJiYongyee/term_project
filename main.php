<?php
session_start();
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$sql = "SELECT * FROM managerTBL WHERE username='$username'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

$sql = "SELECT * FROM projectTBL";
$ret = mysqli_query($con, $sql);

if (!$ret) {
    echo "검색 실패";
    exit();
}

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>데이터베이스 기말과제 팀프로젝트 웹사이트창</title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }
        .container {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            margin: 0 auto;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        ul.nav {
            list-style-type: none;
            padding: 0;
        }
        ul.nav li {
            margin: 10px 0;
        }
        .nav form {
            display: inline-block;
        }
        .footer {
            margin-top: 20px;
        }
        .footer a {
            margin: 0 10px;
        }
        .footer a:hover {
            color: blue;
        }

    </style>
</head>
<body>
<div class="container">
    <h2>Welcome, <?php echo $user["empname"]; ?></h2>
    <p>Rank: <?php echo $user["emprank"]; ?></p>
    <p>Department: <?php echo $user["department"]; ?></p>

    <h1>프로젝트 검색 결과</h1>
    <table>
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
            echo "<td><input type='text' name='projectname' value='".$row['projectname']."' readonly></td>";
            echo "<td><input type='text' name='intel' value='".$row['intel']."'></td>";
            echo "<td><select name='phase'>
                      <option value='절차확립' ".($row['phase'] == '절차확립' ? 'selected' : '').">절차확립</option>
                      <option value='예산확보' ".($row['phase'] == '예산확보' ? 'selected' : '').">예산확보</option>
                      <option value='공정확보' ".($row['phase'] == '공정확보' ? 'selected' : '').">공정확보</option>
                      <option value='원자재준비' ".($row['phase'] == '원자재준비' ? 'selected' : '').">원자재준비</option>
                      <option value='공정가동' ".($row['phase'] == '공정가동' ? 'selected' : '').">공정가동</option>
                      <option value='홍보' ".($row['phase'] == '홍보' ? 'selected' : '').">홍보</option>
                      <option value='상품출시' ".($row['phase'] == '상품출시' ? 'selected' : '').">상품출시</option>
                      <option value='진행' ".($row['phase'] == '진행' ? 'selected' : '').">진행</option>
                      <option value='중간평가' ".($row['phase'] == '중간평가' ? 'selected' : '').">중간평가</option>
                      <option value='계획수정' ".($row['phase'] == '계획수정' ? 'selected' : '').">계획수정</option>
                      <option value='종결평가' ".($row['phase'] == '종결평가' ? 'selected' : '').">종결평가</option>
                      <option value='프로젝트종결' ".($row['phase'] == '프로젝트종결' ? 'selected' : '').">프로젝트종결</option>
                  </select></td>";
            echo "<td><input type='text' name='employee' value='".$row['employee']."'></td>";
            echo "<td><input type='date' name='deadline' value='".$row['deadline']."'></td>";
            echo "<td><button onclick='updateProject(this)'>수정</button></td>";
            echo "<td class='footer'><a href='delete.php?projectname=".$row['projectname']."'>삭제</a></td>";
            echo "</tr>";
        }
        ?>
    </table>
    <br>
    <ul class="footer">
        <li><a href="insert.php">새 프로젝트 작성</a></li>
    </ul>
    <div class="footer">
        <a href="logout.php">Logout</a>
        <a href="manage_account.php">Manage Account</a>
    </div>
</div>
<script>
    function updateProject(button) {
        const row = button.closest('tr');
        const projectname = row.querySelector('input[name="projectname"]').value;
        const intel = row.querySelector('input[name="intel"]').value;
        const phase = row.querySelector('select[name="phase"]').value;
        const employee = row.querySelector('input[name="employee"]').value;
        const deadline = row.querySelector('input[name="deadline"]').value;

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_project.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                const response = JSON.parse(xhr.responseText);
                if (response.status === 'success') {
                    alert('프로젝트 정보가 성공적으로 업데이트되었습니다.');
                } else {
                    alert('업데이트 실패: ' + response.message);
                }
            }
        };

        xhr.send(`projectname=${projectname}&intel=${intel}&phase=${phase}&employee=${employee}&deadline=${deadline}`);
    }
</script>
</body>
</html>
