<?php
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
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
</head>
<body>
<h2>Welcome, <?php echo $user["username"]; ?></h2>
<p>Rank: <?php echo $user["emprank"]; ?></p>
<p>Department: <?php echo $user["department"]; ?></p>
<a href="logout.php">Logout</a>
<a href="manage_account.php">Manage Account</a>
</body>
</html>
