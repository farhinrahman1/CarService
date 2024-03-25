<?php
session_start();
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mechanics</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Mechanics</h1>
        <a href="add_mechanic.php">Add Mechanic</a>
        <table>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Daily Count</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $sql="SELECT * FROM mechanic";
            $result=mysqli_query($conn, $sql);
            if (mysqli_num_rows($result)>0){
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>".$row['name']."</td>";
                    echo "<td>".$row['maxCars']."</td>";
                    echo "<td>".$row['email']."</td>";
                    echo "<td><a href='edit_mechanic.php?id=".$row['id']."'>Edit</a></td>";
                    echo "<td><a href='delete_mechanic.php?id=".$row['id']."'>Delete</a></td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
    <?php include('footer.php'); ?>

</body>
</html>