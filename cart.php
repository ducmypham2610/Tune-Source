<?php
    session_start();
    include ("connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
    <link rel="stylesheet" href="./style.css" />
    <title>Tune Source - All songs</title>
</head>
<body class="container">
<!-- Navigation -->
<div class="navigation">
      <input type="checkbox" class="navigation__checkbox" id="navi-toggle">

        <label for="navi-toggle" class="navigation__button">
          <span class="navigation__icon"> &nbsp;</span>
        </label>           
          <div class="navigation__background">&nbsp;</div>
            <nav class="navigation__nav">
              <ul class="navigation__list">
                <li class="navigation__item"><a href="index.php" class="navigation__link">Explore now</a></li>
                <li class="navigation__item"><a href="playlist.php" class="navigation__link">My playlist</a></li>
                <li class="navigation__item"><a href="cart.php" class="navigation__link">Shopping cart</a></li>
                <li class="navigation__item"><a href="#song" class="navigation__link">Top songs</a></li>
              </ul>
            </nav>
    </div>


    <!--Header-->
    <header class="header">
      <form action="search.php" class="search">
        <input type="text" name="user-query" class="search__input" placeholder="Search..." />
        <input type="submit" name="search" value="Search" class="search__button">
      </form>
      <nav class="user-nav">
      <div class="user-nav__user">
          <img
            src="./img/user.png"
            alt="User photo"
            class="user-nav__user-photo"
          />
          <span class="user-nav__user-name"><?php
                    include ("connect.php");
                    if(isset($_SESSION['username'])){
                        $username = $_SESSION['username'];
                        echo "
                        $username";
                    } else {
                        echo "<a href='login.php' class='side--bar__link'>Login</a>";
                    }
          ?></span>

          <div class="user-nav__drop">
          <ul class="user-nav__drop-list">
            <li class="user-nav__drop-item"><a href="" class="user-nav__drop-link">Setting</a></li>
            <li class="user-nav__drop-item"><a href="login.php" class="user-nav__drop-link">Login</a></li>
            <li class="user-nav__drop-item"><a href="logout.php" class="user-nav__drop-link">Logout</a></li>
          </ul>
          </div>
        </div>
      </nav>
    </header>

    <section class="section__cart">
        <h1 class="heading__primary">Shopping cart</h1>
    <form method="post" class="section__cart-form">
        <?php
  
      include ("connect.php");
      $user_id = $_SESSION['user_id'];
      $sql="select * from cart where user_id='$user_id'";
      $result = mysqli_query($connect, $sql);
      $check_user = mysqli_num_rows($result);
      if ($check_user == 0){
        echo "
        <h5>Your shopping cart is empty</h5>
        ";
      }
      else {
        $sql = "select cart_id, song_name, song_img, song_price from song, cart where song.song_id = cart.song_id AND user_id='$user_id'";
        $result = mysqli_query($connect, $sql);
        while($row =  mysqli_fetch_assoc($result)){
          $cart_id =$row['cart_id']; 
          $cart_song_name =$row['song_name']; 
          $cart_song_image =$row['song_img']; 
          $cart_song_price =$row['song_price'];   
        ?>
        <div class="section__cart-box">
            <img src="./img/<?php echo $cart_song_image ?>" alt="" class="section__cart-img">
            <h2 class="heading__secondary section__cart-name"><?php echo $cart_song_name ?></h3>
            <h2 class="heading__secondary section__cart-price"><?php echo $cart_song_price ?></h3>
            <a href="cart.php?delete_cart=<?php echo $cart_id ?>" class="section__cart-btn btn btn-ghost">Remove</a>
        </div>
        <?php 
        }
    } ?>
    <?php 
    
    if (isset($_GET["delete_cart"])) {  
      $cart_id = $_GET['delete_cart'];
      $sql="delete from cart where cart_id =$cart_id";
      $result = mysqli_query($connect, $sql);
      if ($result) {
        echo "<script>window.open('cart.php','_self')</script>";
      }
      else {
        echo "<script>alert('Error')</script>";
        echo "<script>window.open('cart.php','_self')</script>";
      }
    }
   ?>
    </form>

    <div class="payment">
    <h1 class="heading__primary">Payment Information</h1>
    <form method="post">
    <table class="payment__table">
      <tr>
        <td class="payment__infor"> Username</td>
        <td> <input type="text" id="usr" name="name" value="<?php echo $_SESSION['username'];  ?>" readonly></td>
      </tr>
      <tr>
        <td class="payment__infor"> Card type</td>
        <td><select class="custom-select" required id="bank" name="bank">
          <option selected></option>
          <option value="Visa">Visa</option>
          <option value="Master card">Master card</option>
        </select></td>
      </tr>
      <tr>
        <td class="payment__infor">Name on card</td>
        <td><input type="text" class="form-control"></td>
      </tr>
      <tr>
        <td class="payment__infor">Card number</td>
        <td><input type="text" class="form-control"></td>
      </tr>
      <tr>
        <td class="payment__infor">Expiration date</td>
        <td><input type="text" class="form-control" placeholder="03/31"></td>
      </tr>
      <tr>
        <td class="payment__infor">CVV</td>
        <td><input type="text" class="form-control" placeholder="xxx"></td>
      </tr>
      <tr>
        <td class="payment__infor"> Total</td>
        <td> <input type="text" name="total">
        </div></td>
      </tr>
      <tr>
        <td></td>
        <td> <input type="submit" class="btn" value="Pay"></td>
      </tr>
  </table>
    </form>
    </div>
    
    </section>
</body>
</html>