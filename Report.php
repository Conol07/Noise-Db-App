<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>System Reports – Classroom Noise</title>
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
      --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }

    * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
    body { margin: 0; background: var(--bg); color: var(--text-dark); line-height: 1.5; }

    /* Header & Nav */
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

    /* Drawer Styles */
    .drawer {
      position: fixed; top: 0; right: -320px; width: 320px; height: 100%;
      background: #fff; padding: 40px 30px; transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: -10px 0 50px rgba(0,0,0,0.1); z-index: 1001;
    }
    .drawer.open { right: 0; }
    .close-btn { background: none; border: none; font-size: 30px; cursor: pointer; float: right; color: var(--text-muted); }
    .drawer-section { margin-top: 60px; }
    .drawer-section a { display: block; padding: 14px 0; text-decoration: none; color: var(--text-dark); border-bottom: 1px solid #f1f5f9; font-weight: 500; }

    /* Container */
    .container { max-width: 1100px; margin: 40px auto; padding: 0 24px; }
    h1 { font-size: 24px; font-weight: 700; margin-bottom: 20px; }

    /* Filter & Table */
    .filter-bar { background: var(--card); padding: 20px; border-radius: 16px; border: 1px solid var(--border); margin-bottom: 24px; display: flex; gap: 15px; align-items: center; }
    select { padding: 8px 12px; border-radius: 8px; border: 1px solid var(--border); background: #fcfcfd; }
    
    .report-card { background: var(--card); border-radius: 16px; border: 1px solid var(--border); box-shadow: var(--shadow); overflow: hidden; }
    table { width: 100%; border-collapse: collapse; text-align: left; }
    th { background: #f8fafc; padding: 16px; font-size: 13px; color: var(--text-muted); border-bottom: 1px solid var(--border); }
    td { padding: 16px; border-bottom: 1px solid var(--border); font-size: 14px; }
    
    .btn-export { background: var(--primary); color: #fff; border: none; padding: 10px 20px; border-radius: 10px; cursor: pointer; font-weight: 600; margin-left: auto; }
  </style>
</head>
<body>

  <header>
    <strong>System Reports</strong>
    <div class="header-actions">
      <a href="dashboard.php" class="icon-btn">🏠</a>
      <button id="menuBtn" class="icon-btn">☰</button>
    </div>
  </header>

  <nav id="navDrawer" class="drawer">
    <button id="closeBtn" class="close-btn">&times;</button>
    <div class="drawer-section">
      <a href="dashboard.php">Dashboard</a>
      <a href="Alert configuration.php">Alert Configuration</a>
      <a href="account settings.php">Account Settings</a>
    </div>
  </nav>

  <div class="container">
    <h1>Noise Analytics Report</h1>
    
    <div class="filter-bar">
      <label>Period:</label>
      <select>
        <option>Last 24 Hours</option>
        <option>Last 7 Days</option>
        <option>Last 30 Days</option>
      </select>
      <button class="btn-export">Export CSV</button>
    </div>

    <div class="report-card">
      <table>
        <thead>
          <tr>
            <th>Date</th>
            <th>Location</th>
            <th>Avg dB</th>
            <th>Alerts Triggered</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>2026-03-11</td>
            <td>Laboratory 1</td>
            <td>48 dB</td>
            <td>0</td>
          </tr>
          <tr>
            <td>2026-03-11</td>
            <td>Laboratory 3</td>
            <td>62 dB</td>
            <td>2</td>
          </tr>
        </tbody>
      </table>
    </div>
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