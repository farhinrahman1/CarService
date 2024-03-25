<?php
session_start();
include('dbconnect.php');

if (isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM appointment WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
}

if ($_SESSION['email']==null || $_SESSION['email']==""){
    header('Location: login.php');
}

if ($_SESSION['role']=="user"){
    header('Location: appointments.php');
}

if ($_SESSION['REQUEST_METHOD']=='POST'){
    $date=$_POST['date'];
    $mechanic_id=$_POST['mechanic_id'];
    $sql="SELECT * from appointment WHERE date='$date' AND mechanic_id=$mechanic_id";
    $result=mysqli_query($conn, $sql);
    if (mysqli_num_rows($result)>0){
        echo "<script>alert('Client already has an appointment on the same date')</script>";
        header('Location: edit_appointment.php?id='.$id);
    }

    $sql="UPDATE appointment SET date='$date', mechanic_id=$mechanic_id WHERE id=$id";
    if (mysqli_num_rows($result)>=$row['maxCars']){
        echo "<script>alert('Mechanic has all the slots booked on this date')</script>";
        header('Location: edit_appointment.php?id='.$id);
    }

    $sql="UPDATE appointment SET date='$date', mechanic_id=$mechanic_id WHERE id=$id";
    if (mysqli_query($conn, $sql)){
        header('Location: appointments.php');
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('header.php'); ?>
    <div class="container">
        <h1>Edit Appointment</h1>
        <form action="" method="post">
            <label for="date">Date</label>
            <input type="date" name="date" id="date" value="<?php echo $row['date']; ?>">
            <label for="mechanic_id">Mechanic</label>
            <select required name="mechanic_id" id="mechanic_id">
                <?php
                $sql = "SELECT * FROM mechanic";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)){
                    if ($row1['id']==$row['mechanic_id']){
                        echo " selected";
                        echo "<option value=".$row['id']." selected>".$row['name']."</option>";
                    }else{
                        echo "<option value=".$row['id'].">".$row['name']."</option>";
                    }
                }
                ?>
            </select>
            <input type="submit" value="Edit">
        </form>
    </div>
    <?php include('footer.php'); ?>
</body>
</html>