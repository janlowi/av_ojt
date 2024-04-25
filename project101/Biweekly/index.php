<!DOCTYPE html>
<html>
<head>
    <title>AV Student Intern Report Form</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <form id="reportForm" action="submit_report.php" method="post" onsubmit="return validateForm()">
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

            if (department === "" || startDate === "" || endDate === "" || summary === "" || accomplishments === "" || challenges === "" || learning === "") {
                alert("All fields are required.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>