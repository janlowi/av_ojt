<!DOCTYPE html>
<html>
<head>
    <title>AV Student Intern Report Form</title>
  
       <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
        }

        .container p{
            font-size: 14px;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            padding: 50px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            border: 3px solid #ccc;
        }

        h1 {
            text-align: center;
            font-size: 30;
            margin: 20px 0 10px;
        }

        h2 {
            text-align: center;
            font-size: 16px;
            margin-bottom: 10px;
        }

        form {
            text-align: left;
        }

        label {
            font-weight: bold;
        }
        #department{
            font-size: 17px;
        }
        
        #start_date{
            text-align: center;
            font-size: 18px;
        }

        #end_date{
            text-align: center;
            font-size: 18px;
        }


        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 8px;
            margin: 5px 0 15px;
            border: 5px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #000;
            color: white;
            padding: 12px 16px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
    
    </style>
</head>
<body>
    <form id="reportForm" action="weekly_display.php" method="post" onsubmit="return validateForm()">
        <div class="container">
            <h1>AV Student Intern Bi-weekly Report</h1>
            <p>You must be able to complete this report every 2 weeks after your deployment.</p>
            
            <label for="department">Assigned Department:</label><br>
            <select id="department" name="department" required>
                <option value="">Select Department</option>
                <option value="IT">Information Technology</option>
                <option value="Accounting">Accounting</option>
                <option value="Finance">Finance</option>
                <option value="Admin">Admin</option>
                <option value="Purchasing">Purchasing</option>
                <option value="Warehouse">Warehouse</option>
            </select><br>

            <label for="start_date">Assignment Period Start:</label><br>
            <input type="date" id="start_date" name="start_date" required><br>

            <label for="end_date">Assignment Period End:</label><br>
            <input type="date" id="end_date" name="end_date" required><br>
            <br>

            <label for="summary">Summary or Scope of Work:</label><br>
            <textarea id="summary" name="summary" rows="4" required></textarea><br>

            <label for="accomplishments">Accomplishments:</label><br>
            <textarea id="accomplishments" name="accomplishments" rows="4"></textarea><br>

            <label for="challenges">Challenges:</label><br>
            <textarea id="challenges" name="challenges" rows="4"></textarea><br>

            <label for="learning">Learning:</label><br>
            <textarea id="learning" name="learning" rows="4"></textarea><br>

            <input type="submit" name="submit" value="Submit">
        </div>
    </form>

    <script>
        function validateForm() {
    var department = document.getElementById("department").value;
    var startDate = document.getElementById("start_date").value;
    var endDate = document.getElementById("end_date").value;
    var summary = document.getElementById("summary").value;
    var accomplishments = document.getElementById("accomplishments").value;
    var challenges = document.getElementById("challenges").value;
    var learning = document.getElementById("learning").value;

    // Check if any field is empty
    if (department === "" || startDate === "" || endDate === "" || summary === "" || accomplishments === "" || challenges === "" || learning === "") {
        alert("All fields are required.");
        return false;
    }

    // Check if start date is greater than end date
    if (new Date(startDate) > new Date(endDate)) {
        alert("Assignment Period Start cannot be after Assignment Period End.");
        return false;
    }

    return true;
}
    </script>
</body>
</html>