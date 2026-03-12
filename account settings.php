<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Settings – Classroom Noise</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary: #2563eb;
      --bg: #f8fafc;
      --card-bg: #ffffff;
      --text-dark: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --danger: #ef4444;
      --shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }
    
    * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { margin: 0; background: var(--bg); color: var(--text-dark); line-height: 1.5; }

    /* Header & Drawer (Consistent with Dashboard) */
    header { 
      background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px);
      padding: 14px 40px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
    }
    .header-actions { display: flex; gap: 12px; align-items: center; }
    .icon-btn { 
      background: #fff; border: 1px solid var(--border);
      padding: 8px 12px; border-radius: 10px; cursor: pointer; font-size: 18px; 
    }

    .drawer {
      position: fixed; top: 0; right: -320px; width: 320px; height: 100%;
      background: #fff; padding: 40px 30px; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: -10px 0 50px rgba(0,0,0,0.1); z-index: 1001;
    }
    .drawer.open { right: 0; }
    .close-btn { background: none; border: none; font-size: 30px; cursor: pointer; float: right; }

    /* Content */
    .container { max-width: 1000px; margin: 40px auto; padding: 0 24px; }
    .card { background: var(--card-bg); padding: 40px; border-radius: 20px; border: 1px solid var(--border); box-shadow: var(--shadow); display: grid; grid-template-columns: 280px 1fr; gap: 60px; }
    
    .profile-sidebar { text-align: center; }
    .profile-img { width: 160px; height: 160px; border-radius: 50%; background: #f1f5f9; object-fit: cover; margin-bottom: 20px; }
    
    h3 { font-size: 16px; margin: 0 0 24px 0; font-weight: 700; }
    .section { margin-bottom: 40px; }
    label { display: block; font-size: 12px; font-weight: 600; margin-bottom: 8px; color: var(--text-muted); text-transform: uppercase; }
    input { width: 100%; padding: 12px; margin-bottom: 20px; border: 1px solid var(--border); border-radius: 10px; background: #fcfcfd; }
    
    .btn-save { background: var(--primary); color: #fff; border: none; padding: 12px 24px; border-radius: 10px; font-weight: 600; cursor: pointer; }
    .btn-photo { background: #f1f5f9; color: var(--text-dark); border: 1px solid var(--border); padding: 10px 20px; border-radius: 10px; display: block; width: 100%; cursor: pointer; }

    @media (max-width: 768px) { .card { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<header>
  <strong>Account Settings</strong>
  <div class="header-actions">
    <a href="dashboard.php" class="icon-btn">🏠</a>
    <button id="menuBtn" class="icon-btn">☰</button>
  </div>
</header>

<nav id="navDrawer" class="drawer">
  <button id="closeBtn" class="close-btn">&times;</button>
  <div style="margin-top: 60px;">
    <h4 style="color: var(--text-muted); font-size: 12px; text-transform: uppercase;">Menu</h4>
    <a href="Alert configuration.php" style="display:block; padding: 14px 0; text-decoration:none; color:inherit; border-bottom:1px solid #eee;">Alert Configuration</a>
    <a href="Report.php" style="display:block; padding: 14px 0; text-decoration:none; color:inherit; border-bottom:1px solid #eee;">Reports</a>
    
    <div style="margin-top: 40px;">
      <a href="logout.php" style="display:block; padding: 14px; text-decoration:none; color: var(--danger); border: 1px solid var(--danger); border-radius: 10px; text-align: center;">Logout</a>
    </div>
  </div>
</nav>

<div class="container">
  <div class="card">
    <div class="profile-sidebar">
      <img id="profilePreview" src="https://via.placeholder.com/150" alt="Profile" class="profile-img">
      <input type="file" id="photoUpload" style="display:none;" onchange="previewImage(event)">
      <label for="photoUpload" class="btn-photo">Change Photo</label>
    </div>

    <div>
      <form class="section">
        <h3>Profile Information</h3>
        <label>Full Name</label>
        <input type="text" value="Administrator">
        <label>School ID</label>
        <input type="text" placeholder="2026-0001">
        <label>Email Address</label>
        <input type="email" value="admin@school.edu">
        <button type="button" class="btn-save">Save Changes</button>
      </form>

      <form class="section">
        <h3>Security & Authentication</h3>
        <label>New Password</label>
        <input type="password" placeholder="••••••••">
        <label>2FA Email</label>
        <input type="email" placeholder="secondary@school.edu">
        <button type="button" class="btn-save">Save Changes</button>
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