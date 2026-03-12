function goToPage() {
  window.location.href = "reports.html";
}

// Simulation function nga connected to mic nga mo fetch into dashboard data 
let isSim = true;


const THRESHOLD = 70;

let alertActive = false;

setInterval(() => {

  let db = Math.floor(Math.random() * 40 + 40);

  const dbDisplay = document.getElementById("dbValue");

  if(dbDisplay){
    dbDisplay.innerHTML = db + " <span>dB</span>";
  }


  if(typeof noiseChart !== "undefined"){
    noiseChart.data.datasets[0].data.shift();
    noiseChart.data.datasets[0].data.push(db);
    noiseChart.update();
  }


  if(db >= THRESHOLD && !alertActive){

    alert("⚠️ Noise level exceeded! (" + db + " dB)");
    alertActive = true;

   
    let formData = new FormData();
    formData.append("type","alert");
    formData.append("db",db);

    fetch("server.php",{
      method:"POST",
      body:formData
    });

  }

  if(db < THRESHOLD){
    alertActive = false;
  }

},3000);

// 1. Define your classroom data
const classrooms = [
  { id: 'lab1', name: 'Laboratory 1' },
  { id: 'lab2', name: 'Laboratory 2' },
  { id: 'lab3', name: 'Laboratory 3' }
];

// 2. Initial Render
const listContainer = document.getElementById('classroomList');
classrooms.forEach(room => {
  listContainer.innerHTML += `
    <div class="classroom">
      <span>${room.name}</span>
      <div>
        <span id="${room.id}-db" style="font-weight:700; margin-right:10px;">0 dB</span>
        <span id="${room.id}-status" class="status normal">Normal</span>
      </div>
    </div>
  `;
});

// 3. Logic to update status dynamically
function updateClassroomStatuses() {
  classrooms.forEach(room => {
    let db = Math.floor(Math.random() * 40 + 40); // Simulated DB
    const dbEl = document.getElementById(`${room.id}-db`);
    const statusEl = document.getElementById(`${room.id}-status`);

    dbEl.innerText = db + " dB";

    if (db > 70) {
      statusEl.innerText = "Noisy";
      statusEl.style.backgroundColor = "#fee2e2";
      statusEl.style.color = "#991b1b";
    } else {
      statusEl.innerText = "Normal";
      statusEl.style.backgroundColor = "#dcfce7";
      statusEl.style.color = "#15803d";
    }
  });
}