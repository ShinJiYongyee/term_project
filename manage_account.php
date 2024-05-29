<?php
session_start();
$con = mysqli_connect("localhost", "cookUser", "1234", "projectDB") or die("MySQL 접속 실패!!");

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["update"])) {
        $email = mysqli_real_escape_string($con, $_POST["email"]);
        $emprank = mysqli_real_escape_string($con, $_POST["emprank"]);
        $department = mysqli_real_escape_string($con, $_POST["department"]);
        $sql = "UPDATE managerTBL SET email='$email', emprank='$emprank', department='$department' WHERE username='$username'";
        if (mysqli_query($con, $sql)) {
            echo "Account updated successfully!";
        } else {
            echo "Error updating account: " . mysqli_error($con);
        }
    } elseif (isset($_POST["delete"])) {
        $sql = "DELETE FROM managerTBL WHERE username='$username'";
        if (mysqli_query($con, $sql)) {
            session_destroy();
            header("Location: login.php");
            exit();
        } else {
            echo "Error deleting account: " . mysqli_error($con);
        }
    }
}

$sql = "SELECT * FROM managerTBL WHERE username='$username'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);

mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Account</title>
</head>
<body>
<h2>Manage Account</h2>
<form method="post" action="manage_account.php">
    Username: <input type="text" name="username" value="<?php echo $user["username"]; ?>" readonly><br>
    Rank: <input type="text" name="emprank" value="<?php echo $user["emprank"]; ?>" required><br>
    Department: <input type="text" name="department" value="<?php echo $user["department"]; ?>" required><br>
    Email: <input type="email" name="email" value="<?php echo $user["email"]; ?>" required><br>
    <input type="submit" name="update" value="Update">
    <input type="submit" name="delete" value="Delete Account">
</form>
<a href="main.php">Back</a>
</body>
</html>

