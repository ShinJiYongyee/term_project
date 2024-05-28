<?php
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($con, $_POST["username"]);
    $password = mysqli_real_escape_string($con, $_POST["password"]);
    $emprank = mysqli_real_escape_string($con, $_POST["emprank"]);
    $department = mysqli_real_escape_string($con, $_POST["department"]);
    $email = mysqli_real_escape_string($con, $_POST["email"]);

    // 비밀번호 해시화
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO managerTBL (username, password, emprank, department, email) VALUES ('$username', '$hashed_password', '$emprank', '$department', '$email')";

    if (mysqli_query($con, $sql)) {
        echo "새로운 레코드가 성공적으로 생성되었습니다!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form method="post" action="register.php">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Rank: <input type="text" name="emprank" required><br>
    Department: <input type="text" name="department" required><br>
    Email: <input type="email" name="email" required><br>
    <input type="submit" value="Register">
</form>
<a href="login.php">Login</a>
</body>
</html>

