<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
</body>
</html>
<header>
    <!-- create a black navbar with home,login,signup, and contact button -->
    <nav class="navbar">
    <h1>CarService</h1>
        <div class="buttons">
        <a class="navbar-brand" href="index.php">Home</a>
        <a class="navbar-brand" href="login.php">Login</a>
        <a class="navbar-brand" href="signup.php">Signup</a>
        <a class="navbar-brand" href="contact.php">Contact</a>
        </div>
        <?php
        if (isset($_SESSION['role'])){
            if ($_SESSION['role'] == 'admin'){
               echo '<a class="navbar-brand" href="admin.php">Admin</a>';
            }
            else{
                echo '<a class="navbar-brand" href="user.php">User</a>';
            }
        }?>
        <div>
            <?php
            if (isset($_SESSION['email'])){?>
                <a href="logout.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button></a>
                <?php} else{?>
                echo '<a href="login.php"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</button></a>';
                <?php
            }
            ?>  
        </div>
    </nav>
</header>
