<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Avega Intern Report</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
    }
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    th {
        background-color: #f2f2f2;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:nth-child(odd) {
        background-color: #e9e9e9;
    }
    tr:hover {
        background-color: #ddd;
    }
    td.editable {
        background-color: #ffffff;
    }
    td.editable:hover {
        background-color: #f0f0f0;
    }
    td.editable:focus {
        background-color: #ffffcc;
    }
    .save-button {
        background-color: #4CAF50;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: none;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        cursor: pointer;
        border-radius: 5px;
    }
</style>
</head>
<body onload="loadData()">
    <div class="container">
        <center><h1>Intern Bi-weekly Report</h1></center>
        <center><h6>You must be able to complete this report every 2 weeks after your deployment</h6></center>
        <table id="reportTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Timestamp</th>
                    <th>Email Address</th>
                    <th>Name</th>
                    <th>Assigned Department</th>
                    <th>Assigned Period Start</th>
                    <th>Assigned Period End</th>
                    <th>Summary or Scope of Work</th>
                    <th>Accomplishment</th>
                    <th>Challenges</th>
                    <th>Learning & Conclusion</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                </tr>
                <!-- Add more rows as needed -->
                <tr>
                    <td>4</td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                    <td contenteditable="true" class="editable"></td>
                </tr>
            </tbody>
        </table>
        <button class="save-button" onclick="saveData()">Save Data</button>
    </div>

    <script>
        function saveData() {
            const tableRows = document.querySelectorAll('#reportTable tbody tr');
            let data = [];
            tableRows.forEach(row => {
                let rowData = [];
                row.querySelectorAll('.editable').forEach(cell => {
                    rowData.push(cell.innerText);
                });
                data.push(rowData);
            });
            localStorage.setItem('reportData', JSON.stringify(data));
            alert('Data saved successfully!');
        }

        function loadData() {
            const storedData = localStorage.getItem('reportData');
            if (storedData) {
                const parsedData = JSON.parse(storedData);
                const tableRows = document.querySelectorAll('#reportTable tbody tr');
                parsedData.forEach((rowData, index) => {
                    if (index < tableRows.length) {
                        const
