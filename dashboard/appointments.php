<?php
session_start();
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Appointments</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>License Number</th>
                <th>Date</th>
                <th>Mechanic</th>
                <th></th>
                <th></th>
            </tr>
            <tbody>
            <?php
            $sql = "SELECT appointment.id,name,phone,license_number,date,mechanic.name FROM appointment, user WHERE appointment.user_id = user.id";
            $result= mysqli_query($conn, $sql);
            while ($row=mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['phone']."</td>";
                echo "<td>".$row['license_number']."</td>";
                echo "<td>".$row['date']."</td>";
                $sql2="SELECT name FROM mechanic WHERE id=".$row['mechanic_id'];
                $result2=mysqli_query($conn, $sql2);
                $row2=mysqli_fetch_assoc($result2);
                echo "<td>".$row2['name']."</td>";
                echo "<td><a href='edit_appointment.php?id=".$row['id']."'>Edit</a></td>";
                echo "<td><a href='delete_appointment.php?id=".$row['id']."'>Delete</a></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>