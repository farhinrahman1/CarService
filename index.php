<?php
session_start();
include('dbconnect.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CarService</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include('partials/navbar.php');
    ?>
    <div class="container">
        <h1>Welcome to CarService</h1>
        <p>Book an appointment for your car service</p>
        <p>Get your car serviced by the best mechanics in town, at the best price</p>
        <p>We offer the best service in town</p>
        <a href="appointment.php"><button class="btn" type="submit">Book an Appointment</button></a>
    </div>
    <?php
    include('partials/footer.php');
    ?>
</body>
</html>