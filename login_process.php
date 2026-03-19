<?php
session_start();
require_once 'db.php';

if(isset($_POST['login'])){
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id,name,email,password,role FROM users WHERE email=? OR name=?");
    $stmt->bind_param("ss",$usernameOrEmail,$usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $user = $result->fetch_assoc();

        // Verify hashed password
        if(password_verify($password, $user['password'])){
            $_SESSION['username'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Role-based redirect
            if($user['role'] === 'admin'){
                header("Location: admin_dashboard.php");
            } elseif($user['role'] === 'manager'){
                header("Location: manager_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } else {
        $error = "Invalid username or password";
    }

    if(isset($error)){
        echo "<script>alert('$error');window.location='login.php';</script>";
    }
}
?>