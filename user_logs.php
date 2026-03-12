<?php
session_start();
require_once 'db.php';

$from = $_GET['from_date'] ?? '';
$to = $_GET['to_date'] ?? '';
$sql = "SELECT u.username, l.action, l.ip_address, l.timestamp 
        FROM user_logs l 
        JOIN users u ON l.user_id = u.id";

if (!empty($from) && !empty($to)) {
    $sql .= " WHERE l.timestamp BETWEEN ? AND ?";
}
$sql .= " ORDER BY l.timestamp DESC LIMIT 50";

$stmt = $conn->prepare($sql);
if (!empty($from) && !empty($to)) {
    $start = $from . " 00:00:00";
    $end = $to . " 23:59:59";
    $stmt->bind_param("ss", $start, $end);
}
$stmt->execute();
$logs = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>System Logs</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root { --primary: #2563eb; --bg: #f8fafc; --card: #ffffff; --border: #e2e8f0; --text-dark: #0f172a; --text-muted: #64748b; }
        body { margin: 0; background: var(--bg); color: var(--text-dark); font-family: 'Inter', sans-serif; }
        .container { max-width: 900px; margin: 40px auto; padding: 0 24px; }
        .card { background: var(--card); padding: 25px; border-radius: 20px; border: 1px solid var(--border); margin-bottom: 24px; }
        
        header { background: #fff; border-bottom: 1px solid var(--border); padding: 14px 32px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .icon-btn { background: #fff; border: 1px solid var(--border); padding: 8px 10px; border-radius: 10px; cursor: pointer; }
        
        /* Drawer Styles */
        .drawer { position: fixed; top: 0; right: -320px; width: 320px; height: 100%; background: #fff; padding: 40px 30px; transition: 0.3s; box-shadow: -5px 0 15px rgba(0,0,0,0.1); z-index: 1001; display: none; flex-direction: column; }
        .drawer.open { right: 0; display: flex; }
        .close-btn { background: none; border: none; font-size: 24px; cursor: pointer; align-self: flex-end; }
        .drawer-section a { display: block; padding: 10px 0; text-decoration: none; color: var(--text-dark); }

        .filter-bar { display: flex; gap: 10px; align-items: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th { text-align: left; padding: 12px; border-bottom: 2px solid var(--border); }
        td { padding: 14px 12px; border-bottom: 1px solid #f1f5f9; }
    </style>
</head>
<body>

<header>
    <strong>User Logs</strong>
    <button id="menuBtn" class="icon-btn">☰</button>
</header>

<nav id="navDrawer" class="drawer">
    <button id="closeBtn" class="close-btn">&times;</button>
    <div class="drawer-section">
        <h3>Menu</h3>
        <a href="dashboard.php">Dashboard</a>
       <a href="Alert configuration.php">Alert Configuration</a>
<a href="account settings.php">Account Settings</a>
<a href="Alert records.php">Alert Records</a>
<a href="Report.php">Report</a>
    </div>
</nav>

<div class="container">
    <div class="card">
        <form method="GET" class="filter-bar">
            <input type="date" name="from_date" value="<?= htmlspecialchars($from) ?>" required>
            <span>to</span>
            <input type="date" name="to_date" value="<?= htmlspecialchars($to) ?>" required>
            <button type="submit" class="icon-btn">Filter</button>
            <a href="?">Reset</a>
        </form>
        <table>
            <thead><tr><th>User</th><th>Action</th><th>IP</th><th>Time</th></tr></thead>
            <tbody>
                <?php while ($row = $logs->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['username']) ?></td>
                    <td><?= htmlspecialchars($row['action']) ?></td>
                    <td><?= htmlspecialchars($row['ip_address']) ?></td>
                    <td><?= htmlspecialchars($row['timestamp']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    const menuBtn = document.getElementById('menuBtn');
    const closeBtn = document.getElementById('closeBtn');
    const navDrawer = document.getElementById('navDrawer');

    menuBtn.addEventListener('click', () => navDrawer.classList.add('open'));
    closeBtn.addEventListener('click', () => navDrawer.classList.remove('open'));
</script>
</body>
</html>