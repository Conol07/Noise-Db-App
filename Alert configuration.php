<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Alerts Configuration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  
  <style>
    :root {
      --primary: #2563eb;
      --bg: #f8fafc;
      --card: #ffffff;
      --text-dark: #0f172a;
      --text-muted: #64748b;
      --border: #e2e8f0;
      --danger: #ef4444;
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { margin: 0; background: var(--bg); color: var(--text-dark); line-height: 1.5; }

    /* Header & Navigation */
    header { 
      background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(12px);
      padding: 14px 40px; border-bottom: 1px solid var(--border);
      display: flex; align-items: center; justify-content: space-between;
      position: sticky; top: 0; z-index: 100;
    }
    
    .header-actions { display: flex; gap: 12px; align-items: center; }
    .icon-btn {
      background: #fff; border: 1px solid var(--border);
      padding: 8px 12px; border-radius: 10px; cursor: pointer;
      font-size: 18px; transition: 0.2s;
    }
    .icon-btn:hover { background: #f1f5f9; }

    /* Drawer Menu */
    .drawer {
      position: fixed; top: 0; right: -320px; width: 320px; height: 100%;
      background: #fff; padding: 40px 30px; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: -10px 0 50px rgba(0,0,0,0.1); z-index: 1001;
    }
    .drawer.open { right: 0; }
    .close-btn { background: none; border: none; font-size: 30px; cursor: pointer; float: right; color: var(--text-muted); }
    .drawer-section { margin-top: 60px; }
    .drawer-section a { display: block; padding: 14px 0; text-decoration: none; color: var(--text-dark); border-bottom: 1px solid #f1f5f9; font-weight: 500; }
    .btn-logout { margin-top: auto; background: #fff1f2; color: var(--danger); text-align: center; text-decoration: none; padding: 14px; border-radius: 12px; font-weight: 600; display: block; border: 1px solid #fee2e2; }

    /* Main Content */
    .container { max-width: 1100px; margin: 40px auto; padding: 0 24px; }
    h1 { margin-bottom: 25px; font-size: 24px; font-weight: 700; }
    .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 120px; }
    .card { background: var(--card); padding: 25px; border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow); }
    .card h2 { font-size: 16px; margin-bottom: 10px; }
    .card p { font-size: 13px; color: var(--text-muted); margin-bottom: 20px; }

    /* Inputs */
    label { font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px; }
    input[type="range"] { width: 100%; margin: 10px 0; accent-color: var(--primary); }
    input[type="number"], input[type="email"], textarea { width: 100%; padding: 10px; border: 1px solid var(--border); border-radius: 8px; }
    
    .save-footer { text-align: right; padding: 20px 40px; background: rgba(255,255,255,0.8); backdrop-filter: blur(12px); border-top: 1px solid var(--border); position: fixed; bottom: 0; width: 100%; }
    .btn-save { background: var(--primary); color: #fff; border: none; padding: 12px 30px; border-radius: 10px; cursor: pointer; font-weight: 600; }
  </style>
</head>
<body>

  <header>
    <strong>Alerts Configuration</strong>
    <div class="header-actions">
      <a href="dashboard.php" class="icon-btn">🏠</a>
      <button id="menuBtn" class="icon-btn">☰</button>
    </div>
  </header>

  <nav id="navDrawer" class="drawer">
    <button id="closeBtn" class="close-btn">&times;</button>
    <div class="drawer-section">
      <a href="dashboard.php">Dashboard</a>
      <a href="account settings.php">Account Settings</a>
      <a href="#">Reports</a>
    </div>
    <a href="login.php" class="btn-logout" onclick="return confirm('Log out?')">Log Out</a>
  </nav>

  <div class="container">
    <h1>Settings Adjustment</h1>
    <div class="cards">
      <div class="card">
        <h2>Apply Settings To</h2>
        <p>Choose which laboratories will use these configuration settings.</p>
        <label><input type="checkbox" checked> Laboratory 1</label>
        <label><input type="checkbox" checked> Laboratory 2</label>
        <label><input type="checkbox" checked> Laboratory 3</label>
      </div>

      <div class="card">
        <h2>Decibel Thresholds</h2>
        <label>Minimum Threshold (dB)</label>
        <input type="range" min="30" max="100" value="50">
        <label>Maximum Threshold (dB)</label>
        <input type="range" min="30" max="120" value="80">
      </div>

      <div class="card">
        <h2>Notification Methods</h2>
        <label><input type="checkbox" checked> Visual Alert</label>
        <label><input type="checkbox"> Sound Alert</label>
        <label><input type="checkbox" checked> Email Notification</label>
        <label style="margin-top:10px">Recipient Email</label>
        <input type="email" value="admin@classroomdb.com">
      </div>

      <div class="card">
        <h2>Quiet Periods</h2>
        <label><input type="checkbox"> Enable Quiet Periods</label>
        <label style="margin-top:15px">Notes / Exclusions</label>
        <textarea placeholder="E.g. exclude during fire drills..."></textarea>
      </div>
    </div>
  </div>

  <div class="save-footer">
    <button class="btn-save">Save Changes</button>
  </div>

  <script>
    const menuBtn = document.getElementById('menuBtn');
    const navDrawer = document.getElementById('navDrawer');
    const closeBtn = document.getElementById('closeBtn');
    menuBtn.onclick = () => navDrawer.classList.add('open');
    closeBtn.onclick = () => navDrawer.classList.remove('open');
  </script>
</body>
</html>