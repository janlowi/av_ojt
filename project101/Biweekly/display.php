<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avega OJT Responses Form</title>
    <style>
        /* Add your CSS styles here */
        /* For example: */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Avega OJT Responses Form</h2>
    <form action="submit_response.php" method="POST">
        <label for="timestamp">Timestamp:</label>
        <input type="text" id="timestamp" name="timestamp" required><br>

        <label for="email">Email Address:</label>
        <input type="text" id="email" name="email" required><br>

        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required><br>

        <label for="department">Assigned Department:</label>
        <input type="text" id="department" name="department" required><br>

        <label for="start_date">Assigned Period Start:</label>
        <input type="text" id="start_date" name="start_date" placeholder="YYYY-MM-DD" required><br>

        <label for="end_date">Assigned Period End:</label>
        <input type="text" id="end_date" name="end_date" placeholder="YYYY-MM-DD" required><br>

        <label for="summary">Summary or Scope of Work:</label>
        <textarea id="summary" name="summary" rows="4" required></textarea><br>

        <label for="accomplishment">Accomplishment:</label>
        <textarea id="accomplishment" name="accomplishment" rows="4" required></textarea><br>

        <label for="challenges">Challenges:</label>
        <textarea id="challenges" name="challenges" rows="4" required></textarea><br>

        <label for="learning">Learning & Conclusion:</label>
        <textarea id="learning" name="learning" rows="4" required></textarea><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>