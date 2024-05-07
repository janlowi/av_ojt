<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Table with Search Box</title>
<style>
    /* Style for the search box */
    .search-box {
        margin-bottom: 20px;
    }

    /* Style for the table */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    table th, table td {
        border: 5px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    table th {
        background-color: #f2f2f2;
    }
</style>
<link rel="stylesheet" href="../Assets/css/datatables.css" />
</head>
<body>


<table id="dataTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date</th>
            <th>Email</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>John lowi</td>
            <td>30</td>
            <td>johnlo@example.com</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Zyrah jane</td>
            <td>25</td>
            <td>zjane@example.com</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Bebe kho</td>
            <td>35</td>
            <td>bebb@example.com</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Maring tsu</td>
            <td>40</td>
            <td>marri@example.com</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Rhealyn yangg</td>
            <td>20</td>
            <td>ryang@example.com</td>
        </tr>
        <!-- Add more rows as needed -->
    </tbody>
</table>

<script src="../Assets/js/jquery.js"></script>
<script src="../Assets/js/datatables.js"></script>
<script>
new DataTable('#dataTable');
</script>

</body>