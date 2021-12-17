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
        <input type="text" name="user-query"  class="search__input" placeholder="Search..." />
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
    
    <section class="section__playlist">
    <h1 class="heading__primary">My playlist</h1>
    <form method="post" class="section__playlist-form">
        <?php
  
      include ("connect.php");
      $user_id = $_SESSION['user_id'];
      $sql="select * from playlist where user_id='$user_id'";
      $result = mysqli_query($connect, $sql);
      $check_user = mysqli_num_rows($result);
      if ($check_user == 0){
        echo "
        <h5>Your shopping playlist is empty</h5>
        ";
      }
      else {
        $sql = "select playlist_id, song_name, song_img, song_audio from song, playlist where song.song_id = playlist.song_id AND user_id='$user_id'";
        $result = mysqli_query($connect, $sql);
        while($row =  mysqli_fetch_assoc($result)){
          $playlist_id =$row['playlist_id']; 
          $playlist_song_name =$row['song_name']; 
          $playlist_song_image =$row['song_img']; 
          $playlist_song_audio =$row['song_audio'];   
        ?>
        <div class="section__playlist-box">
            <img src="./img/<?php echo $playlist_song_image ?>" alt="" class="section__playlist-img">
            <h2 class="heading__secondary section__playlist-name"><?php echo $playlist_song_name ?></h3>
            <audio controls controlsList="nodownload" src="./music/<?php echo $playlist_song_audio ?>" class="section-playlist__audio"></audio>
            <a href="playlist.php?delete_playlist_song=<?php echo $playlist_id ?>" class="section__playlist-btn btn btn-ghost">Remove</a>
        </div>
        <?php 
        }
    } ?>
    <?php 
    
    if (isset($_GET["delete_playlist_song"])) {  
      $playlist_id = $_GET['delete_playlist_song'];
      $sql="DELETE from playlist where playlist_id =$playlist_id";
      $result = mysqli_query($connect, $sql);
      if ($result) {
        echo "<script>window.open('playlist.php','_self')</script>";
      }
      else {
        echo "<script>alert('Error')</script>";
        echo "<script>window.open('playlist.php','_self')</script>";
      }
    }
   ?>
    </form>
    </section>
</body>
</html>