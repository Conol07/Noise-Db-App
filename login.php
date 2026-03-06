    <?php
session_start();
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {

    $_SESSION['user'] = $email;

    header("Location: dashboard.php"); // redirect
    exit();

} else {

    header("Location: login.php?error=Invalid login");
    exit();
}
?>