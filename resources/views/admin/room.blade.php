<!DOCTYPE html>
<html lang="en">
<head>
    <title>Rooms</title>

    <style>
        body{
            font-family:Arial;
            padding:30px;
            background:#f1f5f9;
        }
        table{
            width:100%;
            border-collapse:collapse;
            background:white;
        }
        th, td{
            padding:15px;
            border:1px solid #ddd;
        }
        th{
            background:#2563eb;
            color:white;
        }

        .add-btn{
             background:#2563eb;
            color:white;
            padding:12px 20px;
            border:none;
            border-radius:5px;
            text-decoration:none;
        }

    </style>
</head>
<body>
    <h1>Room Management</h1>
    <br>
   
                <a href="" class="add-btn">
                    + Add room
                </a>
    <br><br>
    <table>
        <tr>
            <th>ID</th>
            <th>Room Number</th>
            <th>Type</th>
            <th>Price</th>
            <th>Status</th>
        </tr>
        <tr>
            <td>1</td>
            <td>101</td>
            <td>VIP</td>
            <td>$100</td>
            <td>Available</td>
        </tr>

    </table>

</body>
</html>