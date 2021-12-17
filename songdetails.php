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

    <section class="section-detail">
    <?php 
            include ("connect.php");
            $id = $_GET["id"];
            $sql = "SELECT * FROM song WHERE song_id={$id} ";
            $result = mysqli_query($connect,$sql);
            while ($row=mysqli_fetch_assoc($result)) {
                $song_id = $row['song_id'];
    ?>
    <div class="section-detail__box">
        <div class="section-detail__box--1">
          <img src="./img/<?php echo $row['song_img'] ?>" alt="<?php echo $row['song_name'] ?>" class="section-detail__img">
          <audio controls controlsList="nodownload" src="./music/<?php echo $row['song_audio'] ?>" class="section-songs__audio margin-bottom-big"></audio>
          <div class="section-detail__btn"> 
              <a href="index.php?add_cart=<?php echo $song_id ?>" class="btn btn-ghost margin-bottom-big heading__secondary">Add to Cart</a> 
              <a href="index.php?add_playlist=<?php echo $song_id ?>" class="btn btn-ghost heading__secondary">Add to playlist</a>    
          </div> 
        </div>     
        <div class="section-detail__description">
          <h2 class="heading__secondary color-tertiary"><?php echo $row['song_name'] ?></h2>                                       
          <h3 class="heading__tertiary">Lyrics</h3>
          <p class="section-detail__lyrics"><?php echo $row['song_lyrics'] ?></p>
        </div>
    </div>
    <?php
            }
    ?>
    <?php include("add_playlist.php"); ?>
    <?php include("add_cart.php"); ?>
    
    </section>
</body>
</html>