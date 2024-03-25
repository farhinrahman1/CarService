<?php
session_start();
include('dbconnect.php');
if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $car_color = $_POST['car_color'];
    $car_license= $_POST['car_license'];
    $car_engine_no = $_POST['car_engine_no'];
    $appoint_date = $_POST['appoint_date'];
    $appoint_id= $_POST['appoint_id'];
    $mech_name= $_POST['mech_name'];

    $sameDateCheck="SELECT * FROM appointment WHERE appoint_date='$appoint_date' AND mech_name='$mech_name'";
    $result=mysqli_query($conn,$sameDateCheck);

    if (mysqli_num_rows($result)>0){
        echo "<script>alert('You have already an appointment on this date with this mechanic')</script>";
    }else{
        $maxAppointmentsCheck="SELECT * FROM appointment WHERE appoint_date='$appoint_date' AND mech_name='$mech_name'";
        $result=mysqli_query($conn,$maxAppointmentsCheck);
        $rows=mysqli_num_rows($result);

        $maxAppointments="SELECT * FROM mechanic WHERE mech_name='$mech_name'";
        $result=mysqli_query($conn,$maxAppointments);
        $row=mysqli_fetch_assoc($result);
        $maxCars=$row['max_cars'];
        if ($rows>=$maxCars){
            echo "<script>alert('This mechanic has already reached the maximum number of appointments for this date')</script>";
        }else{
            $sql="INSERT INTO appointment (car_color,car_license,car_engine_no,appoint_date,appoint_id,mech_name) VALUES ('$car_color','$car_license','$car_engine_no','$appoint_date','$appoint_id','$mech_name')";
            if (mysqli_query($conn,$sql)){
                header('Location:thankyou.php');
                echo "<script>alert('Appointment added successfully')</script>";
            }else{
                echo "Error: ".$sql."<br>".mysqli_error($conn);
            }
        }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php include('partials/navbar.php'); ?>
    <div class="container_book">
        <h2>Book an Appointment</h2>
    <div class="book-form">
        <form action="appointment.php" method="post">
            <div class="li1">
            <label class="text1" for="car_color">Car Color</label>
            <input class="same" type="text" name="car_color" required>
            </div>
            <div class="li1">
            <label class="text1" for="car_license">Car License</label>
            <input class="same" type="text" name="car_license" required>
            </div>
            <div class="li1">
            <label class="text1" for="car_engine_no">Car Engine Number</label>
            <input class="same" type="text" name="car_engine_no" required>
            </div>
            <div class="li1">
            <label class="text1" for="appoint_date">Appointment Date</label>
            <input class="same" type="date" name="appoint_date" required>
            </div>
            <div class="li1">
            <label class="text1" for="appoint_id">Appointment ID</label>
            <input class="same" type="text" name="appoint_id" required>
            </div>
            <div class="li1">
            <label class="text1" for="mech_name">Mechanic Name</label>
            <input class="same" type="text" name="mech_name" required>
            </div>
            <button class="btn-book" type="submit">Book Appointment</button>
        </form>
    </div>
    </div>
    <?php include('partials/footer.php'); ?>
</body>
</html>