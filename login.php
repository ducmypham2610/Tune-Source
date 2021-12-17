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
                <h2 class="heading__form">Login</h2>
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
                            <label for="name">Password</label>
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
                            <input type="submit"  name="login" value="Login" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="col span-1-of-3">
                            <p>&nbsp;</p>
                        </div>
                        <div class="col span-2-of-3">
                            <p><a href="signup.php" class="account" style="font-size: 14px;" >Don't have an account? <br>
                            Create one!</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <?php
        include("connect.php");
        //$connect =  new mysqli_connect (nhu tren) --> huong thu tuc
        
        // Hàm isset để kiểm tra xem có click button login ko?
        if(isset($_POST['login']))
        {
        // Lấy dữ liệu được nhập từ form, kiểm tra so với dữ liệu ở database
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Chọn trong bảng users, dòng nào có username = $username và password = $password
        $sql = " SELECT * FROM user where username = '$username' AND password = '$password' ";
        // Dùng hàm mysqli_query để thực thi truy vấn từ cơ sở dữ liệu và trả về kết quả
        $result = mysqli_query($connect, $sql);
        $row_user = mysqli_fetch_array($result);
        // Trả về kết quả là các hàng trong bảng được truy vấn --> dùng hàm mysqli_num_row($result)
        $check_login = mysqli_num_rows($result);
        // Nếu tìm thấy kết quả, tức là tìm thấy trong các hàng có username = $username và password = $password ---> check_login > 0
        if($check_login > 0){
            echo "
            <script>alert('Login successfully!');
            window.open('index.php','_self');</script>
            ";
            //Dùng biến $_SESSION để lưu thông tin biến
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $row_user['user_id'];
        }else {
            echo '<script language="javascript"> alert("Incorrect username or password! Please try again!") </script>';
        }
    }
    ?>
</div>
</body>
</html>