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

<link href="https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
:root{
  --primary:#2489ff;
  --bg:#f4f5f7;
  --card-bg:#fff;
  --text-dark:#171a1f;
  --text-muted:#6b7280;
  --border:#e5e7eb;
  --danger:#ff4d4f;
}

*{box-sizing:border-box;font-family:'Archivo',sans-serif;}
body{margin:0;background:var(--bg);}

header{
  background:#fff;
  border-bottom:1px solid var(--border);
  padding:16px 32px;
  display:flex;
  justify-content:space-between;
  align-items:center;
}

header h1{margin:0;font-size:20px;}

.header-actions{
  display:flex;
  gap:20px;
  align-items:center;
}

.hamburger{
  background:none;
  border:none;
  font-size:24px;
  cursor:pointer;
}



.drawer{
  position:fixed;
  top:0;
  right:-280px;
  width:280px;
  height:100%;
  background:#fff;
  padding:24px;
  transition:.3s;
  box-shadow:-2px 0 10px rgba(0,0,0,0.1);
  display:flex;
  flex-direction:column;
}

.drawer.open{
  right:0;
}

.close-btn{
  background:none;
  border:none;
  font-size:24px;
  cursor:pointer;
  align-self:flex-end;
}

.drawer-section{
  margin-top:40px;
  border-bottom:1px solid var(--border);
  padding-bottom:20px;
}

.drawer-section a{
  display:block;
  padding:10px 0;
  text-decoration:none;
  font-weight:600;
  color:#000;
}

.drawer-footer{
  margin-top:auto;
  display:flex;
  flex-direction:column;
  gap:10px;
}

.btn{
  padding:12px;
  border-radius:6px;
  border:none;
  cursor:pointer;
}

.btn-outline{
  border:1px solid var(--border);
  background:#fff;
}

.btn-primary{
  background:var(--primary);
  color:#fff;
}

.btn-logout{
  background:var(--danger);
  color:#fff;
  text-align:center;
  text-decoration:none;
  padding:12px;
  border-radius:6px;
}



.container{
  max-width:1200px;
  margin:24px auto;
  padding:0 24px;
}

.card{
  background:#fff;
  padding:24px;
  border-radius:8px;
  margin-bottom:24px;
  box-shadow:0 1px 2px rgba(0,0,0,0.05);
}

.live-db{
  text-align:center;
}

.db-value{
  font-size:56px;
  font-weight:700;
}

.grid{
  display:grid;
  grid-template-columns:2fr 1fr;
  gap:24px;
}

.classroom{
  display:flex;
  justify-content:space-between;
  padding:12px 0;
  border-bottom:1px solid var(--border);
}

.status{
  padding:4px 10px;
  border-radius:999px;
  font-size:12px;
  font-weight:600;
}

.normal{
  background:#dcfce7;
  color:#166534;
}

@media(max-width:900px){
.grid{grid-template-columns:1fr;}
}
</style>
</head>

<body>

<header>
<h1>Classroom Noise Detection</h1>

<div class="header-actions">
<a href="Alert records.php">🔔</a>
<button id="menuBtn" class="hamburger">☰</button>
</div>
</header>

<nav id="navDrawer" class="drawer">

<button id="closeBtn" class="close-btn">&times;</button>

<div class="drawer-section">
<h3>System & Account</h3>
<a href="Alert configuration.php">Alert Configuration</a>
<a href="account settings.php">Account Settings</a>
<a href="#">Reports</a>
</div>

<div class="drawer-footer">

<a href="login.php" class="btn-logout"
onclick="return confirm('Are you sure you want to log out?')">
Log Out
</a>

</div>

</nav>

<div class="container">

<div class="card live-db">
<h2>🔔 Live Decibel Reading</h2>
<div class="db-value" id="dbValue">48 <span>dB</span></div>
<button class="btn btn-primary" onclick="toggleSim()">Activate DB</button>
</div>

<div class="grid">

<div class="card">
<h3>Last Hour Noise Trend</h3>
<canvas id="noiseChart"></canvas>
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

</div>

<footer style="text-align:center;padding:20px;color:#777">
© 2026 Classroom Noise Alert
</footer>

<script>



const menuBtn = document.getElementById('menuBtn');
const navDrawer = document.getElementById('navDrawer');
const closeBtn = document.getElementById('closeBtn');

menuBtn.onclick = () => navDrawer.classList.add('open');
closeBtn.onclick = () => navDrawer.classList.remove('open');


// Chart "simulation rani dri pwede ni ma live pero mic ang nahimung decibel"

const ctx = document.getElementById('noiseChart');

const noiseChart = new Chart(ctx,{
type:'line',
data:{
labels:['1h','50m','40m','30m','20m','Now'],
datasets:[{
data:[52,63,58,67,55,48],
borderColor:'#2489ff',
backgroundColor:'rgba(36,137,255,0.1)',
fill:true,
tension:0.4
}]
},
options:{
plugins:{legend:{display:false}}
}
});


// Simulation

let isSim = true;

setInterval(()=>{

let db = Math.floor(Math.random()*40+40);

document.getElementById("dbValue").innerHTML = db + " <span>dB</span>";

noiseChart.data.datasets[0].data.shift();
noiseChart.data.datasets[0].data.push(db);
noiseChart.update();

},3000);


function toggleSim(){

isSim = !isSim;

alert("Mode: " + (isSim ? "Simulation" : "Live"));

}

</script>

</body>
</html>