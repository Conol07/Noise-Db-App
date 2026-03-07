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
      --success: #059669;
    }
    body { font-family: 'Archivo', sans-serif; background: var(--bg); margin: 0; color: var(--text-dark); }
    
    header { background: #fff; border-bottom: 1px solid var(--border); padding: 16px 32px; }
    header .header-inner { max-width: 1200px; width: 100%; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; }
    header h1 { font-size: 20px; margin: 0; }
    
    .home-btn { font-size: 14px; color: #000000; text-decoration: none; font-weight: 600; padding: 8px 16px; border: 1px solid var(--border); border-radius: 6px; }
    
    .container { max-width: 1200px; margin: 24px auto; padding: 0 24px; }
    .card { background: var(--card-bg); padding: 24px; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); display: grid; grid-template-columns: 240px 1fr; gap: 40px; }
    
    .profile-sidebar { text-align: center; border-right: 1px solid var(--border); padding-right: 20px; }
    .profile-img { width: 150px; height: 150px; border-radius: 50%; background: #eee; object-fit: cover; margin-bottom: 16px; border: 2px solid var(--border); }
    
    h3 { font-size: 18px; margin-top: 0; color: var(--primary); }
    .section { margin-bottom: 24px; padding-bottom: 24px; border-bottom: 1px solid var(--border); }
    
    label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 6px; }
    input { width: 100%; padding: 8px; margin-bottom: 12px; border: 1px solid var(--border); border-radius: 6px; box-sizing: border-box; }
    
    .btn { padding: 8px 16px; border-radius: 6px; border: none; font-size: 13px; font-weight: 600; cursor: pointer; display: inline-block; text-align: center; text-decoration: none; }
    .btn-primary { background: var(--primary); color: #fff; }
    .btn-save { background: var(--success); color: #fff; }
    .btn-logout { background: #fee2e2; color: #991b1b; }
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
    <div class="profile-sidebar">
      <img id="profilePreview" src="https://via.placeholder.com/150" alt="Profile" class="profile-img">
      <input type="file" id="photoUpload" style="display:none;" onchange="previewImage(event)">
      <label for="photoUpload" class="btn btn-primary" style="cursor:pointer;">Change Photo</label>
    </div>

    <div>
      <form action="update_profile.php" method="POST" class="section">
        <h3>Profile Information</h3>
        <label>Full Name</label>
        <input type="text" value="Administrator" name="fullname">
        <label>School ID</label>
        <input type="text" placeholder="2026-0001" name="school_id">
        <label>Email Address</label>
        <input type="email" value="admin@school.edu" name="email">
        <button type="submit" class="btn btn-save">Save changes</button>
      </form>

      <form action="update_security.php" method="POST" class="section">
        <h3>Security & Authentication</h3>
        <label>Current Password</label>
        <input type="password" name="current_pass" placeholder="••••••••">
        <label>New Password</label>
        <input type="password" name="new_pass" placeholder="••••••••">
        <label>2FA - Email</label>
        <input type="email" name="2fa_email" placeholder="secondary-email@school.edu">
        <label>2FA - Phone</label>
        <input type="tel" name="2fa_phone" placeholder="+63 9XX XXX XXXX">
        <button type="submit" class="btn btn-save">Save changes</button>
      </form>

      <div style="display: flex; gap: 10px;">
        <button class="btn btn-primary" onclick="window.location.href='switch_account.php'">Switch Account</button>
        <a href="login.php" class="btn btn-logout">Log Out</a>
      </div>
    </div>
  </div>
</div>

<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){
      document.getElementById('profilePreview').src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>
</html>