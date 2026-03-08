function goToPage() {
  window.location.href = "reports.html";
}

// Simulation mode
let isSim = true;

// Noise threshold
const THRESHOLD = 70;

// Prevent multiple alerts
let alertActive = false;

setInterval(() => {

  let db = Math.floor(Math.random() * 40 + 40);

  const dbDisplay = document.getElementById("dbValue");

  if(dbDisplay){
    dbDisplay.innerHTML = db + " <span>dB</span>";
  }

  // Update chart
  if(typeof noiseChart !== "undefined"){
    noiseChart.data.datasets[0].data.shift();
    noiseChart.data.datasets[0].data.push(db);
    noiseChart.update();
  }

  // ALERT CHECK
  if(db >= THRESHOLD && !alertActive){

    alert("⚠️ Noise level exceeded! (" + db + " dB)");
    alertActive = true;

    // Send to database
    let formData = new FormData();
    formData.append("type","alert");
    formData.append("db",db);

    fetch("server.php",{
      method:"POST",
      body:formData
    });

  }

  // Reset alert if noise goes back to normal
  if(db < THRESHOLD){
    alertActive = false;
  }

},3000);