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
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
    }

    .container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 20px;
        text-align: center;
    }

    button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        background-color: #007bff;
        color: #fff;
        cursor: pointer;
        border-radius: 4px;
        margin-top: 10px;
    }
</style>
</head>
<body>
    <div class="container">
        <h1>Time Tracking</h1>
        <p>Click the button below to log your time.</p>
        <button id="timeButton">Time In</button>
        <p id="status"></p>
    </div>

    <script>
    const timeButton = document.getElementById('timeButton');
    const status = document.getElementById('status');

    let isTimeIn = false;

    timeButton.addEventListener('click', function() {
        let event_type = isTimeIn ? 'Out' : 'In';

        
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "log_time.php", true);
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