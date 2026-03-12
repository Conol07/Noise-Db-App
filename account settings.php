<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary: #2563eb; --bg: #f8fafc; --text-dark: #0f172a; 
      --text-muted: #64748b; --border: #e2e8f0; --danger: #ef4444;
    }
    * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { margin: 0; background: var(--bg); color: var(--text-dark); }

    /* Header */
    header { 
      background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px);
      padding: 14px 40px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
    }
    .icon-btn { 
      background: #fff; border: 1px solid var(--border);
      padding: 8px 12px; border-radius: 10px; cursor: pointer; 
    }

    /* Drawer - Correctly positioned outside header flow */
    .drawer {
      position: fixed; top: 0; right: -320px; width: 320px; height: 100%;
      background: #fff; padding: 40px 30px; transition: 0.4s;
      box-shadow: -10px 0 50px rgba(0,0,0,0.1); z-index: 1001;
      display: flex; flex-direction: column;
    }
    .drawer.open { right: 0; }
    .close-btn { background: none; border: none; font-size: 30px; cursor: pointer; align-self: flex-end; }
    .drawer-section a { display: block; padding: 12px 0; text-decoration: none; color: var(--text-dark); border-bottom: 1px solid #f1f5f9; }
    
    /* Layout */
    .container { max-width: 1000px; margin: 40px auto; padding: 0 24px; }
    .card { background: #fff; padding: 40px; border-radius: 20px; border: 1px solid var(--border); display: grid; grid-template-columns: 280px 1fr; gap: 60px; }
    @media (max-width: 768px) { .card { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<header>
  <strong>Account settings</strong>
  <div class="header-actions">
    <a href="dashboard.php" class="icon-btn">🏠</a>
    <button id="menuBtn" class="icon-btn">☰</button>
  </div>
</header>

<nav id="navDrawer" class="drawer">
  <button id="closeBtn" class="close-btn">&times;</button>
  <div class="drawer-section">
    <h3>System & Account</h3>
    <a href="Alert configuration.php">Alert Configuration</a>
    <a href="account settings.php">Account Settings</a>
    <a href="Alert records.php">Alert Records</a>
    <a href="user_logs.php">User Logs</a>
    <a href="Report.php">Report</a>
  </div>
  <a href="login.php" style="color: var(--danger); margin-top: 20px; text-decoration: none; font-weight: 600;">Log Out</a>
</nav>

<div class="container">
  <div class="card">
    <div class="profile-sidebar">
      <img id="profilePreview" src="https://via.placeholder.com/150" style="width:160px; height:160px; border-radius:50%; background:#f1f5f9;">
      <input type="file" id="photoUpload" style="display:none;" onchange="previewImage(event)">
      <label for="photoUpload" style="display:block; cursor:pointer; margin-top:20px; padding:10px; background:#f1f5f9; border-radius:10px; text-align:center;">Change Photo</label>
    </div>
    <div>
      <form id="profileForm">
        <h3>Profile Information</h3>
        <label>Full Name</label>
        <input type="text" id="fullName" style="width:100%; padding:12px; margin-bottom:20px; border:1px solid var(--border); border-radius:10px;">
        <label>School ID</label>
        <input type="text" id="schoolID" style="width:100%; padding:12px; margin-bottom:20px; border:1px solid var(--border); border-radius:10px;">
        <label>Email Address</label>
        <input type="email" id="email" style="width:100%; padding:12px; margin-bottom:20px; border:1px solid var(--border); border-radius:10px;">
        <button type="button" class="btn-primary" onclick="updateProfile()" style="background:var(--primary); color:#fff; border:none; padding:10px 20px; border-radius:10px;">Save Changes</button>
      </form>
      <form class="section">
        <h3>Security & Authentication</h3>
        <label>New Password</label>
        <input type="password" id="newPassword" style="width:100%; padding:12px; margin-bottom:20px; border:1px solid var(--border); border-radius:10px;">
        <button type="button" class="btn-primary" onclick="updatePassword()" style="background:var(--primary); color:#fff; border:none; padding:10px 20px; border-radius:10px;">Update Password</button>
      </form>
    </div>
  </div>
</div>

<script>
  // Drawer logic
  const menuBtn = document.getElementById('menuBtn');
  const navDrawer = document.getElementById('navDrawer');
  const closeBtn = document.getElementById('closeBtn');

  menuBtn.onclick = () => navDrawer.classList.add('open');
  closeBtn.onclick = () => navDrawer.classList.remove('open');

  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function(){ document.getElementById('profilePreview').src = reader.result; }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>
</body>
</html>