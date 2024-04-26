<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Time Tracking</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f0f0f0;
    }

    .container {
        max-width: 500px;
        margin: 50px auto;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
    }

    h1 {
        margin-top: 0;
        color: #007bff;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
        margin-top: 20px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #0056b3;
    }

    #clock {
        font-size: 32px;
        margin-top: 20px;
        color: #333;
    }

    #date {
        font-size: 18px;
        margin-top: 10px;
        color: #666;
    }

    #status {
        margin-top: 20px;
        color: #666;
    }
</style>
</head>
<body>
  
<form action="table.php" method="POST">
    <div class="container">
        <h1>Time Tracking</h1>
        <div id="clock"></div>
        <div id="date"></div>
        <button id="timeButton">Time In</button>
        <p id="status"></p>
    

    
    <script>
    const timeButton = document.getElementById('timeButton');
    const status = document.getElementById('status');
    const clock = document.getElementById('clock');
    const dateElement = document.getElementById('date');

    let isTimeIn = false;

    function updateTime() {
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');
        const year = now.getFullYear();
        const month = (now.getMonth() + 1).toString().padStart(2, '0');
        const day = now.getDate().toString().padStart(2, '0');
        clock.textContent = `${hours}:${minutes}:${seconds}`;
        dateElement.textContent = `${year}-${month}-${day}`;
    }

    updateTime();
    setInterval(updateTime, 1000);

    timeButton.addEventListener('click', function() {
        let event_type = isTimeIn ? 'Out' : 'In';

        
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "submit.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                status.textContent = xhr.responseText;
            }
        };
        xhr.send("event_type=" + event_type);

        if (isTimeIn) {
            status.textContent = 'Time Out recorded.';
            timeButton.textContent = 'Time In';
            isTimeIn = false;
        } else {
            status.textContent = 'Time In recorded.';
            timeButton.textContent = 'Time Out';
            isTimeIn = true;
        }
    });
</script>
</body>
</html>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 