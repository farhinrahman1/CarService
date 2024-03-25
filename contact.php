<?php
session_start();
include('dbconnect.php');

if ($_SESSION['email'] == null || $_SESSION['email'] == "") {
    header('Location: login.php');
}

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $message = $_POST['message'];
    $message_id = $_SESSION['message_id'];

    $sql="INSERT INTO contact (message, message_id) VALUES ('$message','$message_id')";

    if (mysqli_query($conn,$sql)){
        echo "<script>alert('Message sent successfully')</script>";
        header('Location: contact.php');
    }else{
        echo "Error: ".$sql."<br>".mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('partials/navbar.php'); ?>
    <div class="container-contact">
        <h2>Contact Us</h2>
        <div class="contact-form">
        <div class="contact-form">
            <form action="contact.php" method="post">
                <div class="li2">
                <label class="text-contact" for="text"><h3>Message<h3></label><br>
                    <textarea class="mes" type="text" name="text" id="text" required></textarea>
                </div>
                <button class="contact-btn" type="submit" class="btn">Send Message</button>
            </form>
        </div>
        </div>
    </div>
    <?php include('partials/footer.php'); ?>
</body>
</html>