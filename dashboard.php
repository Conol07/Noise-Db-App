<?php
session_start();

// ✅ Role protection (MANAGER ONLY)
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'manager'){
  header("Location: login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Manager Dashboard – Noise Monitoring</title>

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
body { margin: 0; background: var(--bg); }

header {
  background: #fff;
  border-bottom: 1px solid var(--border);
  padding: 14px 32px;
  display: flex; justify-content: space-between; align-items: center;
}

.icon-btn {
  background: #fff; border: 1px solid var(--border);
  padding: 8px 10px; border-radius: 10px; cursor: pointer;
}

.drawer {
  position: fixed; top: 0; right: -300px;
  width: 300px; height: 100%;
  background: #fff; padding: 30px;
  transition: 0.3s;
}
.drawer.open { right: 0; }

.container { max-width: 1100px; margin: 40px auto; padding: 0 20px; }

.card {
  background: var(--card);
  padding: 25px;
  border-radius: 16px;
  margin-bottom: 20px;
  border: 1px solid var(--border);
}

.db-value { font-size: 70px; font-weight: bold; text-align:center; }

.grid { display: grid; grid-template-columns: 1.6fr 1fr; gap: 20px; }

.classroom {
  display: flex; justify-content: space-between;
  padding: 12px 0; border-bottom: 1px solid #eee;
}

.status { padding: 4px 10px; border-radius: 10px; font-size: 12px; }
.normal { background: #dcfce7; color: green; }
.warning { background: #fef3c7; color: orange; }
.critical { background: #fee2e2; color: red; }

button { cursor:pointer; }

#map { height: 300px; border-radius: 10px; }
</style>
</head>

<body>

<header>
  <h2>Manager Dashboard</h2>
  <div>
    <button id="menuBtn" class="icon-btn">☰</button>
  </div>
</header>

<!-- Sidebar -->
<div id="drawer" class="drawer">
  <h3>Manager Panel</h3>
  <a href="dashboard.php">Dashboard</a><br><br>
  <a href="Alert records.php">Alerts</a><br><br>
  <a href="Report.php">Reports</a><br><br>
  <a href="account settings.php">Account</a><br><br>
  <a href="login.php">Logout</a>
</div>

<div class="container">

<!-- Live -->
<div class="card">
  <h3>Live Intensity (Selected Room)</h3>
  <select id="roomSelect">
    <option>Laboratory 1</option>
    <option>Laboratory 2</option>
  </select>
  <div class="db-value" id="dbValue">50 dB</div>
</div>

<div class="grid">

<!-- Chart -->
<div class="card">
  <h3>Noise Trend</h3>
  <canvas id="chart"></canvas>
</div>

<!-- Rooms -->
<div class="card">
  <h3>Classroom Status</h3>

<?php
require_once 'db.php';
$res = $conn->query("SELECT name,status FROM classrooms");

while($row = $res->fetch_assoc()){
  echo '
  <div class="classroom">
    <div>
      <strong>'.$row['name'].'</strong><br>
      <small>Updated just now</small>
    </div>
    <div>
      <span class="status '.strtolower($row['status']).'">'.$row['status'].'</span>
      <button onclick="ackRoom(\''.$row['name'].'\')">✔</button>
    </div>
  </div>';
}
?>

</div>

</div>

<!-- Alerts -->
<div class="card">
<h3>Recent Alerts</h3>
<table width="100%">
<thead>
<tr><th>Room</th><th>Time</th><th>Level</th><th>Action</th></tr>
</thead>
<tbody id="alertBody"></tbody>
</table>
</div>

<!-- Insights -->
<div class="card">
<h3>Manager Insights</h3>
<ul>
<li>Lab 1 is noisy every afternoon</li>
<li>Peak noise during class change</li>
<li>Average today: 58 dB</li>
</ul>
</div>

<!-- Quick Action -->
<div class="card">
<h3>Quick Actions</h3>
<button onclick="sendWarning()">Send Warning</button>
</div>

<!-- Map -->
<div class="card">
<h3>Lab Locations</h3>
<div id="map"></div>
</div>

</div>

<script>
// Sidebar
menuBtn.onclick = () => drawer.classList.toggle("open");

// Chart
const ctx = document.getElementById('chart');
new Chart(ctx, {
  type:'line',
  data:{
    labels:["1h","50m","40m","30m","20m","Now"],
    datasets:[{data:[50,60,55,70,65,50]}]
  }
});

// Live simulation
setInterval(()=>{
  let db = Math.floor(Math.random()*40+40);
  document.getElementById("dbValue").innerText = db+" dB";
},2000);

// Acknowledge
function ackRoom(name){
  alert(name+" checked");
}

// Alerts simulation
function addAlert(){
  let row = `<tr>
  <td>Lab 1</td>
  <td>${new Date().toLocaleTimeString()}</td>
  <td>75 dB</td>
  <td><button onclick="resolve(this)">Resolve</button></td>
  </tr>`;
  alertBody.innerHTML = row + alertBody.innerHTML;
}
setInterval(addAlert,5000);

function resolve(btn){
  btn.innerText="Done";
  btn.disabled=true;
}

// Warning
function sendWarning(){
  alert("Warning sent!");
}

// Map
const map = L.map('map').setView([8.3597,124.8691],17);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

L.marker([8.359731,124.869193]).addTo(map).bindPopup("Lab 1");
L.marker([8.359675,124.869180]).addTo(map).bindPopup("Lab 2");
L.marker([8.359619,124.869167]).addTo(map).bindPopup("Lab 3");

</script>

</body>
</html>