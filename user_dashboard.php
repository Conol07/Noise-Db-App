<?php
session_start();

// ✅ USER ONLY ACCESS
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'user'){
  header("Location: login.php");
  exit();
}
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Dashboard – Noise Monitoring</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { font-family: 'Inter'; margin:0; background:#f1f5f9; }
header { background:#fff; padding:15px 30px; display:flex; justify-content:space-between; }
.container { padding:30px; max-width:1100px; margin:auto; }

.card {
  background:#fff;
  padding:20px;
  border-radius:12px;
  margin-bottom:20px;
}

.db-value { font-size:60px; text-align:center; margin-top:10px; }

.grid { display:grid; grid-template-columns: 1.5fr 1fr; gap:20px; }

#map { height:300px; border-radius:12px; }
</style>
</head>

<body>

<header>
  <h2>User Dashboard</h2>
  <div>
    <a href="login.php">Logout</a>
  </div>
</header>

<div class="container">

<!-- LIVE NOISE -->
<div class="card">
<h3>Live Noise Level</h3>
<select id="roomSelect">
<?php
$res = $conn->query("SELECT name FROM classrooms");
while($row = $res->fetch_assoc()){
  echo "<option>".$row['name']."</option>";
}
?>
</select>
<div class="db-value" id="dbValue">50 dB</div>
</div>

<div class="grid">

<!-- Noise Trend -->
<div class="card">
<h3>Noise Trend (Last Hour)</h3>
<canvas id="chart"></canvas>
</div>

<!-- Recent Alerts -->
<div class="card">
<h3>Recent Alerts</h3>
<table width="100%" id="alerts">
<tr><th>Room</th><th>Time</th><th>Level</th></tr>
</table>
</div>

</div>

<!-- MAP -->
<div class="card">
<h3>Lab Locations</h3>
<div id="map"></div>
</div>

</div>

<script>
// Chart
const ctx = document.getElementById('chart');
new Chart(ctx, {
  type:'line',
  data:{
    labels:["1h","50m","40m","30m","20m","Now"],
    datasets:[{data:[50,55,52,60,58,50], borderColor:'#2563eb', fill:false}]
  }
});

// Live simulation
setInterval(()=>{
  let db = Math.floor(Math.random()*40+40);
  document.getElementById("dbValue").innerText = db+" dB";
},2000);

// Alerts simulation
function addAlert(){
  let row = `<tr>
  <td>Lab 1</td>
  <td>${new Date().toLocaleTimeString()}</td>
  <td>${Math.floor(Math.random()*40+60)} dB</td>
  </tr>`;
  document.getElementById("alerts").innerHTML = row + document.getElementById("alerts").innerHTML;
}
setInterval(addAlert,5000);

// Map
const map = L.map('map').setView([8.3597,124.8691],17);
L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);
L.marker([8.359731,124.869193]).addTo(map).bindPopup("Lab 1");
L.marker([8.359675,124.869180]).addTo(map).bindPopup("Lab 2");
L.marker([8.359619,124.869167]).addTo(map).bindPopup("Lab 3");
</script>

</body>
</html>