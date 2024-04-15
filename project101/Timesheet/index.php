<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Timesheet</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
}

.container {
  max-width: 600px;
  margin: 50px auto;
  background-color: #fff;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  padding: 30px;
}

h2 {
  margin-bottom: 20px;
  text-align: center;
}

.button-container {
  text-align: center;
}

button {
  padding: 10px 20px;
  font-size: 18px;
  margin: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #0056b3;
}

input[type="time"],
input[type="date"] {
  width: calc(50% - 20px);
  padding: 10px;
  margin: 10px;
  box-sizing: border-box;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="time"]:focus,
input[type="date"]:focus {
  outline: none;
  border-color: #007bff;
}

#timeInOutForm {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: center;
}

.timesheet {
  margin-top: 30px;
}

.timesheet table {
  width: 100%;
  border-collapse: collapse;
}

.timesheet th,
.timesheet td {
  border: 1px solid #ccc;
  padding: 8px;
  text-align: center;
}

.timesheet th {
  background-color: #007bff;
  color: #fff;
}

.timesheet tr:nth-child(even) {
  background-color: #f2f2f2;
}
</style>
</head>
<body>
<div class="container">
  <h2>Timesheet</h2>
  <div class="button-container">
    <div id="timeInOutForm">
      <input type="time" id="time" required>
      <input type="date" id="date" required>
      <button id="timeInOutBtn" onclick="toggleTimeInOut()">TIME-IN</button>
    </div>
  </div>
  <div class="timesheet">
    <h3>Your Time Entries</h3>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Time In</th>
          <th>Time Out</th>
        </tr>
      </thead>
      <tbody id="timeEntries">
        
      </tbody>
    </table>
  </div>
</div>
<script>
let isTimeIn = true;

function toggleTimeInOut() {
  const timeInOutBtn = document.getElementById('timeInOutBtn');
  const timeInput = document.getElementById('time');
  const dateInput = document.getElementById('date');
  const timeEntries = document.getElementById('timeEntries');
  
  if (isTimeIn) {
    timeInOutBtn.textContent = 'TIME-OUT';
    timeInOutBtn.style.backgroundColor = '#28a745'; 
    
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
      <td>${dateInput.value}</td>
      <td>${formatTime(timeInput.value)}</td>
      <td>-</td>
    `;
    timeEntries.appendChild(newRow);
  } else {
    timeInOutBtn.textContent = 'TIME-IN';
    timeInOutBtn.style.backgroundColor = '#007bff'; 
   
    const rows = timeEntries.getElementsByTagName('tr');
    const lastRow = rows[rows.length - 1];
    lastRow.getElementsByTagName('td')[2].textContent = formatTime(timeInput.value)
    

    
    
      
  }
  
  timeInput.value = '';
  dateInput.value = '';
  
  isTimeIn = !isTimeIn;
}

function formatTime(time) {
  const [hours, minutes] = time.split(':');
  const period = hours >= 12 ? 'PM' : 'AM';
  const hour = hours % 12 || 12;
  return `${hour}:${minutes} ${period}`;
  function
}
</script>
</body>
</html>