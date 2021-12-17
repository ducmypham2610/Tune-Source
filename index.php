<?php
    session_start();
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
    <title>Tune Source</title>
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

    <!-- Header -->
    <header class="header">
      <form action="search.php" method="get" class="search">
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
            <?php
                    include ("connect.php");
                    if(isset($_SESSION['username'])){
                        $SQL = "SELECT * FROM user";
                        $answer = mysqli_query($connect, $SQL);
                        while($row = mysqli_fetch_array($answer)) {
                            $role = $row['role'];
                            
                            if($role == "admin") {
                                ?>
                                <li class="user-nav__drop-item"><a href="manage.php" class="user-nav__drop-link">Manage</a></li>
                                <?php
                            } 
                            }
                        }
          ?>
          </ul>
          </div>
        </div>
      </nav>
    </header> 

    <!-- All song -->
    <section class="section-songs" id="song">
      <div class="section-songs__heading">
        <h1 class="heading__primary">Explore our world</h1>
      </div>
    <?php 
      include ("connect.php");
      $sql = "SELECT * FROM song";
      $result = mysqli_query($connect, $sql);
      while($row = mysqli_fetch_array($result)){
        $song_id = $row['song_id'];
        $song_name = $row['song_name'];
        $song_price = $row['song_price'];
        $song_image = $row['song_img'];
        $song_lyrics = $row['song_lyrics'];
        $song_audio = $row['song_audio'];
        ?>
        <div class="section-songs__box">
            <a href="songdetails.php?<?php echo "id=$song_id"?>" class="none-text-decoration"><img src="./img/<?php echo $song_image ?>" alt="" class="section-songs__img"></a>
            <a href="songdetails.php?<?php echo "id=$song_id" ?>" class="none-text-decoration"><h2 class="heading__secondary"><?php echo $song_name ?></h2></a>
            <audio controls controlsList="nodownload" src="./music/<?php echo $song_audio ?>" class="section-songs__audio"></audio>
        </div>
        <?php } ?>
        <?php include("add_cart.php"); ?>
    </section>

    <!-- section tours -->
    <section class="section-upgrade" id="tours">
                <div class="u-center-text u-margin-bottom-big">
                    <h2 class="heading__primary">
                        Upgrade your account
                    </h2>
                </div>
                <div class="section-upgrade_box">
                    <div class="section-upgrade_box-1">
                        <div class="card">
                            <div class="card__side card__side--front">
                                <div class="card__picture card__picture--1">
                                    &nbsp;
                                </div>
                                <h4 class="card__heading">
                                    <span class="card__heading-span card__heading-span--1">
                                        Normal
                                    </span>
                                </h4>
                                <div class="card__details">
                                    <ul>
                                      <li>Listen to music ad free</li>
                                      <li>Group session</li>
                                      <li>Download songs</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card__side card__side--back card__side--back-1">
                                <div class="card__cta">
                                    <div class="card__price-box">
                                        <p class="card__price-only">From</p>
                                        <div class="card__price-value">0.1$/day</div>
                                    </div>
                                    <a href="#popup" class="btn btn-ghost heading__secondary">Get started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-upgrade_box-2">
                        <div class="card">
                            <div class="card__side card__side--front">
                                <div class="card__picture card__picture--2">
                                    &nbsp;
                                </div>
                                <h4 class="card__heading">
                                    <span class="card__heading-span card__heading-span--2">
                                        VIP
                                    </span>
                                </h4>
                                <div class="card__details">
                                    <ul>
                                        <li class="card__details-description">Listen to music ad-free</li>
                                        <li>Play anywhere - even offline</li>
                                        <li>Download songs</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card__side card__side--back card__side--back-2">
                                <div class="card__cta">
                                    <div class="card__price-box">
                                        <p class="card__price-only">Only</p>
                                        <div class="card__price-value">15$/month</div>
                                    </div>
                                    <a href="#popup" class="btn btn-ghost heading__secondary">Get started</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="section-upgrade_box-3">
                        <div class="card">
                            <div class="card__side card__side--front">
                                <div class="card__picture card__picture--3">
                                    &nbsp;
                                </div>
                                <h4 class="card__heading">
                                    <span class="card__heading-span card__heading-span--3">
                                        Premium
                                    </span>
                                </h4>
                                <div class="card__details">
                                    <ul>
                                    <li>Listen to music ad-free</li>
                                        <li>Play anywhere - even offline</li>
                                        <li>Download songs</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card__side card__side--back card__side--back-3">
                                <div class="card__cta">
                                    <div class="card__price-box">
                                        <p class="card__price-only">Only</p>
                                        <div class="card__price-value">30$/month</div>
                                    </div>
                                    <a href="#popup" class="btn btn-ghost heading__secondary">Book now!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="footer">
            <div class="footer_box">
                <div class="footer_box-description">
                    <div class="footer__navigation">
                        <ul class="footer__list">
                            <li class="footer__item"><a href="#" class="footer__link">Company</a></li>
                            <li class="footer__item"><a href="#" class="footer__link">Contact us</a></li>
                            <li class="footer__item"><a href="#" class="footer__link">Career</a></li>
                            <li class="footer__item"><a href="#" class="footer__link">Privacy policy</a></li>
                            <li class="footer__item"><a href="#" class="footer__link">Terms</a></li>
                        </ul>
                    </div>
      </div>
            </div>
        </footer>
  </body>
</html>