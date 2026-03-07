<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Classroom Noise Detection – Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <style>
    :root {
      --primary: #2489ff;
      --bg: #f4f5f7;
      --card-bg: #ffffff;
      --text-dark: #171a1f;
      --text-muted: #6b7280;
      --border: #e5e7eb;
    }

    * { box-sizing: border-box; font-family: 'Archivo', sans-serif; }
    body { margin: 0; background: var(--bg); color: var(--text-dark); }

    header {
      background: #fff;
      border-bottom: 1px solid var(--border);
      padding: 16px 32px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    header h1 { font-size: 20px; margin: 0; }

    nav { display: flex; align-items: center; gap: 24px; }
    
    nav a {
      font-size: 14px;
      color: #000000; 
      text-decoration: none;
      font-weight: 600;
      transition: opacity 0.2s;
    }

    nav a:hover { opacity: 0.6; }

    .container { max-width: 1200px; margin: 24px auto; padding: 0 24px; }
    .card { background: var(--card-bg); border-radius: 8px; padding: 24px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); margin-bottom: 24px; }
    
    .live-db { text-align: center; }
    .db-value { font-size: 56px; font-weight: 700; }
    
    .grid { display: grid; grid-template-columns: 2fr 1fr; gap: 24px; }
    .classroom { display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid var(--border); font-size: 14px; }
    .status { padding: 4px 10px; border-radius: 999px; font-size: 12px; font-weight: 600; }
    .normal { background: #dcfce7; color: #166534; }
    
    .btn { width: 100%; padding: 12px; border-radius: 6px; border: none; font-size: 14px; cursor: pointer; margin-top: 8px; }
    .btn-outline { background: #fff; border: 1px solid var(--border); }
    .btn-primary { background: var(--primary); color: #fff; }

    footer { text-align: center; font-size: 12px; color: var(--text-muted); padding: 16px 0; }
    @media (max-width: 900px) { .grid { grid-template-columns: 1fr; } }
  </style>
</head>
<body>

<header>
  <h1>Classroom Noise Detection</h1>
  <nav>
    <a href="Alert configuration.php">Alert Configuration</a>
    <a href="Alert records.php" title="Notifications">🔔</a>
    <a href="account settings.php" title="Account">
      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
        <circle cx="12" cy="7" r="4"></circle>
      </svg>
    </a>
  </nav>
</header>

<div class="container">
  <div class="card live-db">
    <h2>🔔 Live Decibel Reading</h2>
    <div class="db-value"> 48 <span>dB</span></div>
  </div>

  <div class="grid">
    <div class="card">
      <h3>Last Hour Noise Trend</h3>
      <canvas id="noiseChart"></canvas>
    </div>

    <div class="card">
      <h3>Classroom Status</h3>
      <div class="classroom"><span>Laboratory 1</span> <span class="status normal">Normal</span></div>
      <div class="classroom"><span>Laboratory 2</span> <span class="status normal">Normal</span></div>
      <div class="classroom"><span>Laboratory 3</span> <span class="status normal">Normal</span></div> 
      <div class="actions">
        <button class="btn btn-outline">🔇 Mute All Alerts</button>
        <button class="btn btn-primary">Activate Decibel</button>
      </div>
    </div>
  </div>
</div>

<footer>© 2026 Classroom Noise Alert. App.Dev.</footer>

<script>
  const ctx = document.getElementById('noiseChart');
  new Chart(ctx, {
    type: 'line',
    data: {
      labels: ['1h', '50m', '40m', '30m', '20m', 'Now'],
      datasets: [{
        data: [52, 63, 58, 67, 55, 48],
        borderColor: '#2489ff',
        backgroundColor: 'rgba(36,137,255,0.1)',
        fill: true
      }]
    },
    options: { plugins: { legend: { display: false } } }
  });
</script>

</body>
</html>