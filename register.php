<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>
<h2>Create Account</h2>
<form action="register_process.php" method="POST">
<input type="text" name="name" placeholder="Full Name" required><br>
<input type="email" name="email" placeholder="Email" required><br>
<input type="password" name="password" placeholder="Password" required><br>
<select name="role" required>
    <option value="user">User</option>
    <option value="manager">Manager</option>
    <option value="admin">Admin</option>
</select><br><br>
<button type="submit" name="register">Register</button>
</form>
<a href="login.php">Already have an account? Login</a>
</body>
</html>