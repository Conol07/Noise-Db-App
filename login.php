<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Login</h2>

<form action="login_process.php" method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<button type="submit" name="login">Login</button>

</form>

<div class="link">
<a href="register.php">Create Account</a>
</div>

</div>

</body>
</html>