<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Time-In System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container-wrapper {
            border: 2px solid #000;
            border-radius: 10px;
            padding: 20px;
            background-color: #000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            color: #fff;
        }

        .container {
            max-width: 400px;
        }

        h1 {
            text-align: center;
            color: #fff;
        }

        .time-form {
            margin-top: 30px;
        }

        label {
            font-weight: bold;
            margin-bottom: 10px;
            display: block;
            color: #fff;
        }

        input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
            background-color: #fff; 
            color: #000; 
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container-wrapper">
        <div class="container">
            <h1>Time-In System</h1>
            <div class="time-form">
                <form action="update.php" method="POST">
                    <label for="time_out">Time Out:</label>
                    <input type="time" name="time_out" id="time_out" required><br>
                    
                    <input type="submit" value="Time Out">

                </form>
            </div>

        </div>
    </div>
</body>
</html>