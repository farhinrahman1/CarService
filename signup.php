<?php
session_start();
require './dbconnect.php';

if ($_SERVER['REQUEST_METHOD']=='POST'){
    $email=$_POST['email'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $password=password_hash($_POST['password'],PASSWORD_DEFAULT);
    
    $emailCheck="SELECT * FROM user WHERE email='$email'";
    $result=mysqli_query($conn,$emailCheck);

    if (mysqli_num_rows($result)>0){
        echo "<script>alert('User already exists')</script>";
        die();
    }
    else{
        $sql="INSERT INTO user (email,name,phone,password) VALUES ('$email','$name','$phone','$password')";
        $result=mysqli_query($conn,$sql);
        if ($result){
            $user="SELECT * FROM user WHERE email='$email'";
            $result=mysqli_query($conn,$user);
            $row=mysqli_fetch_assoc($result);
            $verify=password_verify($_POST['password'],$row['password']);
            if ($row["email"]==$email && $verify){
                $_SESSION['email']=$row['email'];
                $_SESSION['name']=$row['name'];
                $_SESSION['phone']=$row['phone'];
                $_SESSION['role']=$row['role'];
                $_SESSION['password']=$row['password'];
                header('Location: index.php');
            }
            else{
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
    <title>SignUp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php include './partials/navbar.php'?>
    <div class="container1">
        <h1>SignUp</h1>
        <div class="signupform">
        <form action="" method="post">
            <div >
            <label for="email"><h4>Email</h4></label>
            <input class="email1" type="email" name="email" placeholder="email" required><br><br>
            </div>
            <div>
            <label for="name"><h4>Name</h4></label>
            <input class="name1" type="text" name="name" placeholder="name" required><br><br>
            </div>
            <div>
            <label for="phone"><h4>Phone</h4></label>
            <input class="phone1" type="text" name="phone" placeholder="phone" required><br><br>
            </div>
            <div>
            <label for="password"><h4>Password</h4></label>
            <input class="password1" type="password" name="password" placeholder="password" required><br><br>
            </div>
            <button class="btn2" type="submit">SignUp</button>
        </form>
        </div>
    </div>
    <?php include './partials/footer.php'?>
</body>
</html>