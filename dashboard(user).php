

<?php
session_start();

if(!isset($_SESSION['username'])){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Classroom Noise Detection – Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<style>
:root {
  --primary: #2563eb;
  --bg: #f8fafc;
  --card: #ffffff;
  --text-dark: #0f172a;
  --text-muted: #64748b;
  --border: #e2e8f0;
  --danger: #ef4444;
  --success: #22c55e;
}

* { box-sizing: border-box; font-family: 'Inter', sans-serif; }
body { margin: 0; background: var(--bg); color: var(--text-dark); -webkit-font-smoothing: antialiased; }

header {
  background: rgba(255, 255, 255, 0.8);
  backdrop-filter: blur(12px);
  position: sticky; top: 0; z-index: 100;
  border-bottom: 1px solid var(--border);
  padding: 14px 32px;
  display: flex; justify-content: space-between; align-items: center;
}

header h1 { margin: 0; font-size: 18px; font-weight: 700; letter-spacing: -0.5px; }
header h1 span { color: var(--primary); }

.header-actions { display: flex; gap: 12px; align-items: center; }

.icon-btn {
  background: #fff; border: 1px solid var(--border);
  padding: 8px 10px; border-radius: 10px; cursor: pointer;
  text-decoration: none; font-size: 18px; transition: 0.2s;
}
.icon-btn:hover { background: #f1f5f9; transform: translateY(-1px); }

.drawer {
  position: fixed; top: 0; right: -320px;
  width: 320px; height: 100%;
  background: #fff; padding: 40px 30px;
  transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  box-shadow: -10px 0 50px rgba(0,0,0,0.1);
  display: flex; flex-direction: column; z-index: 1001;
}
.drawer.open { right: 0; }

.close-btn {
  background: none; border: none; font-size: 30px;
  cursor: pointer; align-self: flex-end; color: var(--text-muted);
}

.drawer-section { margin-top: 20px; }
.drawer-section h3 { font-size: 11px; text-transform: uppercase; letter-spacing: 1.5px; color: var(--text-muted); margin-bottom: 20px; }
.drawer-section a {
  display: block; padding: 14px 0; text-decoration: none;
  font-weight: 500; color: var(--text-dark); border-bottom: 1px solid #f1f5f9;
}
.drawer-section a:hover { color: var(--primary); padding-left: 8px; }

.btn-logout {
  margin-top: auto; background: #fff1f2; color: var(--danger);
  text-align: center; text-decoration: none; padding: 14px;
  border-radius: 12px; font-weight: 600; border: 1px solid #fee2e2;
}

.container { max-width: 1100px; margin: 40px auto; padding: 0 24px; }

.card {
  background: var(--card); padding: 30px; border-radius: 24px;
  margin-bottom: 24px; border: 1px solid var(--border);
  box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
}

#map { height: 400px; border-radius: 16px; margin-bottom: 20px; }

.live-db { text-align: center; }
.live-db h2 { font-size: 13px; text-transform: uppercase; letter-spacing: 1px; color: var(--text-muted); margin-bottom: 15px; }

.db-value { font-size: 84px; font-weight: 800; color: var(--text-dark); margin: 15px 0; letter-spacing: -2px; }
.db-value span { font-size: 24px; font-weight: 500; color: var(--text-muted); margin-left: 5px; letter-spacing: 0; }

.btn-primary {
  background: var(--primary); color: #fff; border: none;
  padding: 12px 32px; border-radius: 50px; font-weight: 600;
  cursor: pointer; box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3); transition: 0.2s;
}
.btn-primary:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4); }

.grid { display: grid; grid-template-columns: 1.6fr 1fr; gap: 24px; }

.card h3 { font-size: 16px; font-weight: 700; margin-top: 0; margin-bottom: 25px; color: var(--text-dark); }

.classroom {
  display: flex; justify-content: space-between; align-items: center;
  padding: 16px 0; border-bottom: 1px solid #f1f5f9;
}
.classroom:last-child { border: none; }
.classroom span { font-weight: 500; font-size: 15px; }

.status {
  padding: 5px 14px; border-radius: 20px;
  font-size: 11px; font-weight: 700; text-transform: uppercase;
}
.normal { background: #dcfce7; color: #15803d; }

@media(max-width:900px){ .grid { grid-template-columns: 1fr; } }
</style>
</head>

<body>

<header>
  <h1>Noise<span>Sense</span></h1>
  <div class="header-actions">
    <a href="Alert records.php" class="icon-btn">🔔</a>
    <button id="menuBtn" class="icon-btn">☰</button>
  </div>
</header>

<nav id="navDrawer" class="drawer">
  <button id="closeBtn" class="close-btn">&times;</button>
  <div class="drawer-section">
    <h3>System & Account</h3>
    <a href="Alert configuration.php">Alert Configuration</a>
    <a href="account settings.php">Account Settings</a>

  </div>
  <a href="login.php" class="btn-logout" onclick="return confirm('Are you sure you want to log out?')">Log Out</a>
</nav>

<div class="container">
  <div class="card live-db">
    <h2>Live Intensity</h2>
    <div class="db-value" id="dbValue">48<span>dB</span></div>
    <button class="btn-primary" onclick="toggleSim()">Activate DB</button>
  </div>

  <div class="grid">
    <div class="card">
      <h3>Noise Trend (Last Hour)</h3>
      <div style="height: 250px;">
        <canvas id="noiseChart"></canvas>
      </div>
    </div>

    <div class="card">
      <h3>Classroom Status</h3>
      <div class="classroom">
        <span>Laboratory 1</span>
        <span class="status normal">Normal</span>
        
      </div>
      <div class="classroom">
        <span>Laboratory 2</span>
        <span class="status normal">Normal</span>
      </div>
      <div class="classroom">
        <span>Laboratory 3</span>
        <span class="status normal">Normal</span>
      </div>
    </div>
  </div>

  <div class="card">
    <h3>Campus Monitoring Map</h3>
    <div id="map"></div>
  </div>
</div>

<footer style="text-align:center; padding:40px; color:var(--text-muted); font-size:13px;">
  &copy; 2026 Classroom Noise Alert &bull; Environment Monitoring System
</footer>

<script>
const map = L.map('map').setView([8.3615, 124.8724], 17);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

L.marker([8.359731, 124.869193]).addTo(map)
L.marker([8.359675, 124.869180]).addTo(map)
L.marker([8.359619, 124.869167]).addTo(map)
    .bindPopup('Laboratory 1')
    .bindPopup('Laboratory 2')
    .bindPopup('Laboratory 3')
    .openPopup();

const menuBtn = document.getElementById('menuBtn');
const navDrawer = document.getElementById('navDrawer');
const closeBtn = document.getElementById('closeBtn');

menuBtn.onclick = () => navDrawer.classList.add('open');
closeBtn.onclick = () => navDrawer.classList.remove('open');

const ctx = document.getElementById('noiseChart').getContext('2d');
const gradient = ctx.createLinearGradient(0, 0, 0, 300);
gradient.addColorStop(0, 'rgba(37, 99, 235, 0.1)');
gradient.addColorStop(1, 'rgba(37, 99, 235, 0)');

const noiseChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['1h','50m','40m','30m','20m','Now'],
    datasets: [{
      data: [52,63,58,67,55,48],
      borderColor: '#2563eb',
      borderWidth: 3,
      pointRadius: 0,
      fill: true,
      backgroundColor: gradient,
      tension: 0.4
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
      y: { display: false, min: 30, max: 100 },
      x: { grid: { display: false }, border: { display: false }, ticks: { color: '#94a3b8' } }
    }
  }
});

let isSim = true;
setInterval(() => {
  if(!isSim) return;
  let db = Math.floor(Math.random()*40+40);
  document.getElementById("dbValue").innerHTML = db + "<span>dB</span>";
  noiseChart.data.datasets[0].data.shift();
  noiseChart.data.datasets[0].data.push(db);
  noiseChart.update('none'); 
}, 3000);

function toggleSim() {
  isSim = !isSim;
  alert("Mode: " + (isSim ? "Simulation" : "Live"));
}
</script>

</body>
</html>