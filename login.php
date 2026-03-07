<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login – Classroom Noise</title>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    body { 
      font-family: 'Archivo', sans-serif; 
      background: #f4f5f7; 
      display: flex; 
      justify-content: center; 
      align-items: center; 
      height: 100vh; 
      margin: 0; 
    }
    .container { 
      background: #ffffff; 
      padding: 40px; 
      border-radius: 8px; 
      box-shadow: 0 4px 6px rgba(0,0,0,0.1); 
      width: 100%; 
      max-width: 350px; 
    }
    h2 { font-size: 18px; color: #171a1f; margin-bottom: 8px; text-align: center; }
    p { font-size: 14px; color: #64748b; text-align: center; margin-bottom: 24px; }
    input { width: 100%; padding: 12px; margin-bottom: 16px; border: 1px solid #e5e7eb; border-radius: 6px; box-sizing: border-box; }
    
    button { 
      width: 100%; 
      padding: 12px; 
      background-color: #2489ff; 
      color: white; 
      border: none; 
      border-radius: 6px; 
      cursor: pointer; 
      font-weight: 600; 
      font-size: 14px; 
      transition: background 0.2s; 
    }
    button:hover { background-color: #1d72d6; }
    
    .link { margin-top: 20px; text-align: center; font-size: 14px; }
    a { color: #2489ff; text-decoration: none; font-weight: 600; }
  </style>
</head>
<body>

<div class="container">
  <h2>Computer Laboratory Noise Indicator</h2>
  <p>Please sign in to continue</p>
  
  <form action="login_process.php" method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="login">Login</button>
  </form>

  <div class="link">
    Don't have an account? <a href="register.php">Create Account</a>
  </div>
</div>

</body>
</html>