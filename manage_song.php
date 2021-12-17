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
                    }
          ?></span>

          <div class="user-nav__drop">
          <ul class="user-nav__drop-list">
            <li class="user-nav__drop-item"><a href="logout.php" class="user-nav__drop-link">Setting</a></li>
            <li class="user-nav__drop-item"><a href="logout.php" class="user-nav__drop-link">Login</a></li>
            <li class="user-nav__drop-item"><a href="logout.php" class="user-nav__drop-link">Logout</a></li>
          </ul>
          </div>
        </div>
      </nav>
    </header>

    
    <section class="section-songs">
    <form method="post" class="section__playlist-form">
        <?php
  
        include ("connect.php");
        $sql="select * from song";
        $result = mysqli_query($connect, $sql);
        while($row =  mysqli_fetch_assoc($result)){
          $song_id =$row['song_id']; 
          $song_name =$row['song_name']; 
          $song_image =$row['song_img'];
          $song_price =$row['song_price'];
        ?>
        <div class="section__playlist-box">
            <img src="./img/<?php echo $song_image ?>" alt="" class="section__playlist-img">
            <h2 class="heading__secondary section__playlist-name"><?php echo $song_name ?></h2>
            <h2 class="heading__secondary section__playlist-price"><?php echo $song_price ?></h2>
            <a href="manage_song.php?delete_playlist_song=<?php echo $song_id ?>" class="section__playlist-btn--1 btn btn-ghost" style="font-size: 1.6rem;">Remove</a>
            <a href="update_song.php?<?php echo "id=$song_id" ?>" class="section__playlist-btn--2 btn btn-ghost" style="font-size: 1.6rem;">Update</a>
        </div>
        <?php 
        }
        
  ?>
  <a href="insertsong.php" class="section__playlist-btn btn btn-ghost" style="margin-top: 5rem;">Add new song</a>

    <?php
    
    if (isset($_GET["delete_playlist_song"])) {  
      $song_id = $_GET['delete_playlist_song'];
      $sql="DELETE from song where song_id =$song_id";
      $result = mysqli_query($connect, $sql);
      if ($result) {
        echo "<script>window.open('manage_song.php','_self')</script>";
      }
      else {
        echo "<script>alert('Error')</script>";
        echo "<script>window.open('manage_song.php','_self')</script>";
      }
    }
   ?>
    </form>
    </section>
</body>
</html>