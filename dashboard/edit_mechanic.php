<?php
session_start();
include('dbconnect.php');

if ($_SESSION['email']==null || $_SESSION['email']==""){
    header('Location: login.php');
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM mechanic WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $maxCars = $_POST['maxCars'];

    $sql = "UPDATE mechanic SET name='$name', maxCars='$maxCars' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header('Location: mechanic.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Mechanic</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('partials/navbar.php'); ?>
    <a href="appointment.php">Appointments</a>
    <a href="mechanic.php">Mechanics</a>
    <a href="contact.php">Contact</a>

    <h1>Edit Mechanic</h1>
    <form action="add_mechanic.php" method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name"><br>
        <label for="maxCars">Max Cars:</label><br>
        <input type="number" id="maxCars" name="maxCars"><br>
        <input type="submit" value="Submit">
    </form>
    <?php include('partials/footer.php'); ?>
</body>
</html>