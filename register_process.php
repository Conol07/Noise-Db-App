<?php
include 'db.php';

if(isset($_POST['register'])){

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

$sql = "INSERT INTO users (username, email, password)
VALUES ('$username', '$email', '$password')";

if(mysqli_query($conn,$sql)){
echo "Registration Successful! <a href='login.php'>Login</a>";
}else{
echo "Error: " . mysqli_error($conn);
}

}
?>