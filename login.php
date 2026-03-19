<?php
session_start();
require_once 'db.php'; // Make sure this connects to noise_monitoring_system

// If already logged in, redirect based on role
if(isset($_SESSION['username']) && isset($_SESSION['role'])){
    if($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
        exit();
    } elseif($_SESSION['role'] === 'manager') {
        header("Location: manager_dashboard.php");
        exit();
    } else {
        header("Location: user_dashboard.php");
        exit();
    }
}

// Handle login form submission
if(isset($_POST['login'])){
    $usernameOrEmail = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user by email or name
    $stmt = $conn->prepare("SELECT id,name,email,password,role FROM users WHERE email=? OR name=?");
    $stmt->bind_param("ss",$usernameOrEmail,$usernameOrEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1){
        $user = $result->fetch_assoc();

        // Verify password
        if(password_verify($password, $user['password'])){
            // Login successful
            $_SESSION['username'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            // Redirect based on role
            if($user['role'] === 'admin') {
                header("Location: admin_dashboard.php");
            } elseif($user['role'] === 'manager') {
                header("Location: manager_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login – Noise Monitoring</title>
<style>
body { font-family: Arial; background:#f1f5f9; }
.container { width:300px; margin:100px auto; background:#fff; padding:20px; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1); }
input, button, select { width:100%; padding:10px; margin:8px 0; }
button { background:#2563eb; color:#fff; border:none; cursor:pointer; }
button:hover { background:#1e40af; }
.error { color:red; text-align:center; }
a { text-decoration:none; font-size:14px; display:block; text-align:center; margin-top:10px; }
</style>
</head>
<body>

<div class="container">
<h2 style="text-align:center;">Login</h2>

<?php if(isset($error)) echo "<div class='error'>$error</div>"; ?>

<form method="POST">
<input type="text" name="username" placeholder="Email or Name" required>
<input type="password" name="password" placeholder="Password" required>
<button type="submit" name="login">Login</button>
</form>

<a href="register.php">Create Account</a>
</div>

</body>
</html>