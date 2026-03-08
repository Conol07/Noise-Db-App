<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Alerts Configuration</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <style>
    * { box-sizing: border-box; font-family: "Segoe UI", Tahoma, sans-serif; }
    body { margin: 0; background: #f5f6fa; color: #333; }
    
    .top-bar { 
        background: #ffffff; 
        padding: 15px 30px; 
        border-bottom: 1px solid #e0e0e0;
        display: flex; 
        align-items: center; 
        justify-content: space-between;
    }
    

    .nav-home { 
        text-decoration: none; 
        color: #000000; 
        font-weight: 600; 
    }
    .nav-home:hover { text-decoration: underline; }

    .container { padding: 30px; }
    h1 { margin-bottom: 25px; font-size: 24px; }
    
    .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 25px; margin-bottom: 25px; }
    .card { background: #ffffff; padding: 20px; border-radius: 8px; border: 1px solid #e5e7eb; }
    .card h2 { font-size: 18px; margin-bottom: 10px; }
    .card p { font-size: 13px; color: #666; margin-bottom: 15px; }
    
    label { font-size: 14px; display: block; margin-bottom: 6px; }
    input[type="range"] { width: 100%; margin-bottom: 10px; }
    .value-box { width: 60px; padding: 6px; }
    .checkbox-group { margin-bottom: 10px; }
    input[type="email"], textarea { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 5px; margin-top: 5px; }
    
    .save-footer { text-align: right; padding: 20px 30px; background: white; border-top: 1px solid #e5e7eb; position: sticky; bottom: 0; }
    .btn-save { background: #3b82f6; color: #fff; border: none; padding: 12px 30px; border-radius: 6px; cursor: pointer; font-weight: bold; }
    .btn-save:hover { background: #2563eb; }
  </style>
</head>
<body>

  <div class="top-bar">
    <strong>Alerts Configuration</strong>
    <a href="dashboard.php" class="nav-home">Home</a>
  </div>

  <div class="container">
    <h1>Adjustment</h1>
    
    <div class="cards">
      <div class="card">
        <h2>Apply Settings To</h2>
        <p>Choose which laboratories will use these configuration settings.</p>
        <div class="checkbox-group"><label><input type="checkbox" checked> Laboratory 1</label></div>
        <div class="checkbox-group"><label><input type="checkbox" checked> Laboratory 2</label></div>
        <div class="checkbox-group"><label><input type="checkbox" checked> Laboratory 3</label></div>
      </div>

      <div class="card">
        <h2>Decibel Thresholds</h2>
        <label>Minimum Threshold (dB)</label>
        <input type="range" min="30" max="100" value="50">
        <input class="value-box" type="number" value="50">
        <label style="margin-top:15px">Maximum Threshold (dB)</label>
        <input type="range" min="30" max="120" value="80">
        <input class="value-box" type="number" value="80">
      </div>

      <div class="card">
        <h2>Notification Methods</h2>
        <div class="checkbox-group"><label><input type="checkbox" checked> Visual Alert</label></div>
        <div class="checkbox-group"><label><input type="checkbox"> Sound Alert</label></div>
        <div class="checkbox-group"><label><input type="checkbox" checked> Email Notification</label></div>
        <label>Recipient Email</label>
        <input type="email" value="admin@classroomdb.com">
      </div>

      <div class="card">
        <h2>Quiet Periods</h2>
        <div class="checkbox-group"><label><input type="checkbox"> Enable Quiet Periods</label></div>
        <label>Notes / Exclusions</label>
        <textarea placeholder="E.g. exclude during fire drills..."></textarea>
      </div>
    </div>
  </div>

  <div class="save-footer">
    <button class="btn-save">Save Changes</button>
  </div>

</body>
</html>