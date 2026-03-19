<?php
session_start();

// ✅ ADMIN ONLY ACCESS
if(!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin'){
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
<title>Admin Dashboard – Noise Monitoring</title>

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;800&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body { font-family: 'Inter'; margin:0; background:#f1f5f9; }
header { background:#fff; padding:15px 30px; display:flex; justify-content:space-between; }
.container { padding:30px; max-width:1200px; margin:auto; }

.card {
  background:#fff;
  padding:20px;
  border-radius:12px;
  margin-bottom:20px;
}

.grid { display:grid; grid-template-columns: repeat(3,1fr); gap:20px; }

button { padding:6px 12px; cursor:pointer; }

.status-ok { color:green; }
.status-off { color:red; }
</style>
</head>

<body>

<header>
  <h2>Admin Dashboard</h2>
  <div>
    <a href="login.php">Logout</a>
  </div>
</header>

<div class="container">

<!-- SYSTEM OVERVIEW -->
<div class="grid">

<div class="card">
<h3>Total Rooms</h3>
<?php
$r = $conn->query("SELECT COUNT(*) as total FROM classrooms")->fetch_assoc();
echo "<h1>".$r['total']."</h1>";
?>
</div>

<div class="card">
<h3>Total Users</h3>
<?php
$u = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc();
echo "<h1>".$u['total']."</h1>";
?>
</div>

<div class="card">
<h3>Active Alerts</h3>
<h1 id="alertCount">0</h1>
</div>

</div>

<!-- ROOM MANAGEMENT -->
<div class="card">
<h3>Manage Rooms</h3>

<input type="text" id="roomName" placeholder="New Room">
<button onclick="addRoom()">Add</button>

<table width="100%" border="1" cellpadding="8">
<tr><th>Room</th><th>Action</th></tr>

<?php
$res = $conn->query("SELECT * FROM classrooms");
while($row = $res->fetch_assoc()){
  echo "<tr>
  <td>".$row['name']."</td>
  <td><button onclick='deleteRoom(".$row['id'].")'>Delete</button></td>
  </tr>";
}
?>
</table>

</div>

<!-- USER MANAGEMENT -->
<div class="card">
<h3>User Management</h3>

<table width="100%" border="1" cellpadding="8">
<tr><th>Username</th><th>Role</th><th>Action</th></tr>

<?php
$res = $conn->query("SELECT * FROM users");
while($row = $res->fetch_assoc()){
  echo "<tr>
  <td>".$row['username']."</td>
  <td>".$row['role']."</td>
  <td><button onclick='deleteUser(".$row['id'].")'>Delete</button></td>
  </tr>";
}
?>
</table>

</div>

<!-- ALERTS -->
<div class="card">
<h3>Recent Alerts</h3>
<table width="100%" id="alerts">
<tr><th>Room</th><th>Time</th><th>dB</th></tr>
</table>
</div>

<!-- DEVICE STATUS -->
<div class="card">
<h3>Device Status</h3>
<ul>
<li>Lab 1 Sensor: <span class="status-ok">Online</span></li>
<li>Lab 2 Sensor: <span class="status-off">Offline</span></li>
</ul>
</div>

<!-- REPORTS -->
<div class="card">
<h3>Reports</h3>
<a href="Report.php">View Reports</a>
</div>

<!-- LOGS -->
<div class="card">
<h3>System Logs</h3>
<a href="user_logs.php">View Logs</a>
</div>

</div>

<script>

// ADD ROOM
function addRoom(){
  let name = document.getElementById("roomName").value;

  fetch("add_lab.php",{
    method:"POST",
    body:new URLSearchParams({name:name})
  })
  .then(res=>res.json())
  .then(data=>{
    alert("Room added");
    location.reload();
  });
}

// DELETE ROOM
function deleteRoom(id){
  if(!confirm("Delete room?")) return;

  fetch("delete_room.php",{
    method:"POST",
    body:new URLSearchParams({id:id})
  })
  .then(()=>location.reload());
}

// DELETE USER
function deleteUser(id){
  if(!confirm("Delete user?")) return;

  fetch("delete_user.php",{
    method:"POST",
    body:new URLSearchParams({id:id})
  })
  .then(()=>location.reload());
}

// ALERT SIMULATION
function addAlert(){
  let row = `<tr>
  <td>Lab 1</td>
  <td>${new Date().toLocaleTimeString()}</td>
  <td>${Math.floor(Math.random()*40+60)} dB</td>
  </tr>`;
  document.getElementById("alerts").innerHTML += row;
}
setInterval(addAlert,4000);

</script>

</body>
</html>