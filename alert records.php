<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Alerts Record</title>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600&display=swap" rel="stylesheet">

  <style>
    :root {
      --bg: #f4f5f7;
      --card: #ffffff;
      --text: #171a1f;
      --muted: #6b7280;
      --border: #e5e7eb;
    }

    * { box-sizing: border-box; font-family: 'Archivo', sans-serif; }
    body { margin: 0; background: var(--bg); color: var(--text); }

    header {
      background: #fff;
      border-bottom: 1px solid var(--border);
      padding: 16px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 { font-size: 18px; margin: 0; }
    nav { display: flex; align-items: center; gap: 20px; }
    
    .btn-refresh { cursor: pointer; padding: 6px 12px; font-size: 12px; border: 1px solid var(--border); border-radius: 4px; background: #fff; font-weight: 600; }
    .btn-refresh:hover { background: #f0f0f0; }

    .container { max-width: 1000px; margin: 32px auto; padding: 0 24px; }
    .card { background: var(--card); border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0,0,0,0.05); }
    
    table { width: 100%; border-collapse: collapse; margin-top: 16px; }
    th { color: var(--muted); font-size: 12px; text-align: left; padding: 12px; border-bottom: 2px solid var(--bg); }
    td { padding: 16px 12px; border-bottom: 1px solid var(--border); font-size: 14px; color: var(--muted); }
  </style>
</head>
<body>

<header>
  <h1>Notification</h1>
  <nav>
    <a href="dashboard.php" style="color:#000; font-weight:600; text-decoration:none; font-size:14px;">Home</a>
  </nav>
</header>

<div class="container">
  <div class="card">
    <h3 style="margin-top:0">Recent Alert History</h3>
    <table>
      <thead>
        <tr>
          <th>Classroom</th> <th>Timestamp</th>
          <th>Level</th>
          <th>Severity</th>
        </tr>
      </thead>
      <tbody id="alertBody">
        <tr><td>Laboratory 1</td><td class="time">--</td><td class="lvl">--</td><td class="sev">--</td></tr>
        <tr><td>Laboratory 2</td><td class="time">--</td><td class="lvl">--</td><td class="sev">--</td></tr>
        <tr><td>Laboratory 3</td><td class="time">--</td><td class="lvl">--</td><td class="sev">--</td></tr>
      </tbody>
    </table>
  </div>
</div>

<script>
  function simulateAlerts() {
    const rows = document.querySelectorAll("#alertBody tr");
    rows.forEach(row => {
      // Simulate noise levels (40dB to 90dB)
      const db = Math.floor(Math.random() * (90 - 40 + 1)) + 40;
      let color = "#6b7280";
      let label = db + " dB";

      // Severity Color Logic
      if (db > 80) { color = "#d32f2f"; label += " (Critical)"; }
      else if (db > 65) { color = "#f57c00"; label += " (Warning)"; }
      else { color = "#388e3c"; label += " (Normal)"; }

      row.querySelector('.time').innerText = new Date().toLocaleTimeString();
      row.querySelector('.lvl').innerText = "Lvl " + Math.floor(Math.random() * 3 + 1);
      
      const sevCell = row.querySelector('.sev');
      sevCell.innerText = label;
      sevCell.style.color = color;
      sevCell.style.fontWeight = "600";
    });
  }

  // Auto-refresh every 5 seconds
  setInterval(simulateAlerts, 5000);
</script>

</body>
</html>