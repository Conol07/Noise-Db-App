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
    nav a { color: #000; font-weight: 600; text-decoration: none; font-size: 14px; }

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
    <a href="dashboard.php">Home</a>
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Laboratory 1</td>
          <td>--</td>
          <td>--</td>
          <td>--</td>
          <td>--</td>
        </tr>
        <tr>
          <td>Laboratory 2</td>
          <td>--</td>
          <td>--</td>
          <td>--</td>
          <td>--</td>
        </tr>
        <tr>
          <td>Laboratory 3</td>
          <td>--</td>
          <td>--</td>
          <td>--</td>
          <td>--</td>
        </tr>
      </tbody>
    </table>
  </div>
</div>

</body>
</html>