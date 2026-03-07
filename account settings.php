<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings – Classroom Noise</title>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    :root {
      --primary: #2489ff;
      --bg: #f4f5f7;
      --card-bg: #ffffff;
      --text-dark: #171a1f;
      --border: #e5e7eb;
    }
    body { font-family: 'Archivo', sans-serif; background: var(--bg); margin: 0; color: var(--text-dark); }
    
    header { background: #fff; border-bottom: 1px solid var(--border); padding: 16px 32px; display: flex; justify-content: space-between; align-items: center; }
    header .header-inner { max-width: 1200px; width: 100%; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
    
    header h1 { font-size: 20px; margin: 0; }
    
    .home-btn { font-size: 14px; color: #000000; text-decoration: none; font-weight: 600; transition: opacity 0.2s; }
    .home-btn:hover { opacity: 0.6; }
    
    .container { max-width: 1200px; margin: 24px auto; padding: 0 24px; }
    .card { background: var(--card-bg); padding: 24px; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    
    h3 { font-size: 18px; margin-top: 0; color: var(--primary); }
    .section { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--border); }
    
    label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; }
    input { width: 100%; padding: 10px; margin-bottom: 16px; border: 1px solid var(--border); border-radius: 6px; box-sizing: border-box; }
    
    .btn { padding: 12px 24px; border-radius: 6px; border: none; font-size: 14px; font-weight: 600; cursor: pointer; transition: background 0.2s; text-align: center; text-decoration: none; display: inline-block; }
    .btn-primary { background: var(--primary); color: #fff; }
    .btn-primary:hover { background: #1d72d6; }
    .btn-save { background: #059669; color: #fff; margin-top: 8px; }
    .btn-save:hover { background: #047857; }
    .btn-logout { background: #fee2e2; color: #991b1b; margin-top: 12px; display: block; width: 100%; max-width: 200px; }
  </style>
</head>
<body>

<header>
  <div class="header-inner">
    <h1>Account Settings</h1>
    <a href="dashboard.php" class="home-btn">Home</a>
  </div>
</header>

<div class="container">
  <div class="card">
    <form action="update_profile.php" method="POST" class="section">
      <h3>Profile Information</h3>
      <label>Full Name</label>
      <input type="text" value="Administrator" name="fullname">
      
      <label>School ID</label>
      <input type="text" placeholder="e.g., 2026-0001" name="school_id">
      
      <label>Email Address</label>
      <input type="email" value="admin@school.edu" name="email">
      
      <button type="submit" class="btn btn-save">Save Profile Changes</button>
    </form>

    <form action="update_security.php" method="POST" class="section">
      <h3>Security & Authentication</h3>
      <label>Current Password</label>
      <input type="password" name="current_pass" placeholder="••••••••">
      <label>New Password</label>
      <input type="password" name="new_pass" placeholder="••••••••">
      <label>2FA - Email Verification</label>
      <input type="email" name="2fa_email" placeholder="e.g., secondary-email@school.edu">
      <label>2FA - Phone Number</label>
      <input type="tel" name="2fa_phone" placeholder="+63 9XX XXX XXXX">
      
      <button type="submit" class="btn btn-save">Save Security Changes</button>
    </form>

    <div>
      <button class="btn btn-primary" onclick="window.location.href='switch_account.php'">Switch Account</button>
      <a href="logout.php" class="btn btn-logout">Log Out</a>
    </div>
  </div>
</div>

</body>
</html>