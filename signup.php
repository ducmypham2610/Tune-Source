<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
      integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
      crossorigin="anonymous"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./grid.css">
    <link rel="stylesheet" href="./style.css" />
    <title>Login</title>
</head>
<body>
<div class="form-container">
        <div class="header-box">
            <a href="index.php"><img src="./img/logo.png" alt="Logo" class="header-box__logo"></a>
            <nav>
                <ul class="nav__links">
                    <li class="nav__links--item"><a href="index.php" class="link color-primary nav__links--text">Home</a></li>
                    <li class="nav__links--item"><a href="#" class="link color-primary nav__links--text">About us</a></li>
                    <li class="nav__links--item"><a href="#" class="link color-primary nav__links--text">Contact</a></li>
                </ul>
            </nav>
        </div>

        <div class="section-form">
            <div class="row">
                <h2 class="heading__form">Sign up</h2>
            </div>
            <div class="row">
                <form action="#" method="POST" class="form">
                    <div class="row">
                        <div class="col span-1-of-3">
                            <label for="name">Username</label>
                        </div>
                        <div class="col span-2-of-3">
                            <input type="text" name="username" id="name" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col span-1-of-3">
                            <label for="name">Email</label>
                        </div>
                        <div class="col span-2-of-3">
                            <input type="text" name="email" id="email" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col span-1-of-3">
                            <label for="name">Phone</label>
                        </div>
                        <div class="col span-2-of-3">
                            <input type="text" name="phone" id="phone" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col span-1-of-3">
                            <label for="name">Password</label>
                        </div>
                        <div class="col span-2-of-3">
                            <input type="password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col span-1-of-3">
                            <label for="name">Confirm password</label>
                        </div>
                        <div class="col span-2-of-3">
                            <input type="password" name="password" id="password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col span-1-of-3">
                            <label>&nbsp;</label>
                        </div>
                        <div class="col span-2-of-3">
                            <input type="submit" name="signup" value="Sign up" >
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php 
        include("connect.php");
        //$connect =  new mysqli_connect (nhu tren) --> huong thu tuc
        
        if(isset($_POST['signup'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];

            $sql = "SELECT * FROM user where username='$username' or email = '$email'";

            $result = mysqli_query($connect,$sql);

            if(mysqli_num_rows($result)>0){
                echo '<script language="javascript">alert("Username or email has been already taken!"); window.location="signup.php";</script>';
                die();
            }
            else{
                $sql = "INSERT INTO user(username,password,email,telephone) VALUES ('$username','$password','$phone','$email')";

                if(mysqli_query($connect,$sql)){
                    echo '<script language="javascript">alert("Registration successfully!"); window.location="login.php";</script>';
                }
                else{
                    echo '<script language="javascript">alert("Registration failed! Please try again!"); window.location="signup.php";</script>';
                }
            }

            // $sql = "INSERT INTO user(username,password,phone,email) VALUES ('$username','$password','$phone','$email')";
            // $result = mysqli_query($connect,$sql);     
        }
        ?>
</div>
</body>
</html>