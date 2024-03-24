<?php
session_start();
require './dbconnect.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];

    $user="SELECT * FROM users WHERE email='$email'";
    $result=mysqli_query($conn,$user);

    if (mysqli_num_rows($result)==0){
        echo "<script>alert('User not found')</script>";
        die();
    }
    else{
        $row=mysqli_fetch_assoc($result);
        $verify=password_verify($_POST['password'],$row['password']);
        if ($row['email'==$email && $verify]){
            $_SESSION['email']=$row['email'];
            $_SESSION['name']=$row['name'];
            $_SESSION['phone']=$row['phone'];
            $_SESSION['password']=$row['password'];
            $_SESSION['role']=$row['role'];
            header('Location:index.php');
        }
        else{
            echo "<script>alert('Invalid password')</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include('partials/navbar.php'); ?>
    <div class="container">
        <h1>Login</h1>
        <div class="form">
        <form action="login.php" method="post">
            <label for="email"><h3>Email</h3></label>
            <input class="email" type="email" name="email" id="email" required>
            <br><br>
            <label for="password"><h3>Password</h3></label>
            <input class="password" type="password" name="password" id="password" required>
            <button class="btn" type="submit">Login</button>
        </form>
        </div>
</body>
</html>