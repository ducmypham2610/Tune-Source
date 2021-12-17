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

    <section class="section-update">
        <h1 class="heading__primary section-update__heading">Update song</h1>
    <?php 
            include ("connect.php");
            $id = $_GET["id"];
            $sql = "SELECT * FROM song WHERE song_id={$id} ";
            $result = mysqli_query($connect,$sql);
            while ($row=mysqli_fetch_assoc($result)) {
                $song_id = $row['song_id'];
    ?>
    <form action="#" method ="POST" enctype="multipart/form-data" class="manage__form">  
    <label class="manage__label" for="name">Genre ID</label> 
    <input type="text"  name="genre_id" value = "<?php echo $row['genre_id'] ?>" class="manage__input"><br><br>
    <label class="manage__label" for="name">Singer ID</label>
    <input type="text"  name="singer_id" value = "<?php echo $row['singer_id'] ?>"><br><br>
    <label class="manage__label" for="name">Song's name</label>
    <input type="text"  name="song_name" value = "<?php echo $row['song_name'] ?>"><br><br>   
    <label class="manage__label" for="name">Price</label>
    <input type="text" name="song_price" value="<?php echo $row['song_price'] ?>"><br><br> 
    <label class="manage__label" for="name">Lyrics</label> 
    <input type="text" name="song_lyrics" value="<?php echo $row['song_lyrics'] ?>"><br><br>  
    <label class="manage__label" for="name">Description</label>
    <input type="text"  name="song_description" value = "<?php echo $row['song_description'] ?>"><br><br>
    <label class="manage__label" for="name">Image</label>
    <input type="file"  name="song_image" value="<?php echo $row['song_image'] ?>"><br><br>  
    <label class="manage__label" for="name">Audio</label>
    <input type="file" name="song_audio" value="<?php echo $row['song_audio'] ?>"><br><br> 
    <input type="submit" name="update_song" value = "Update">
</form>
    <?php
    }
    ?>
<?php
if(isset($_POST['update_song'])){
    $song_name= $_POST['song_name'];
    $genre_id = $_POST['genre_id'];
    $singer_id =$_POST['singer_id'];
    $song_price = $_POST['song_price'];
    $song_lyrics = $_POST['song_lyrics'];
    $song_description = $_POST['song_description'];
    // $song_image = $_POST['song_image'];
    // $song_audio = $_POST['song_audio'];
    $song_image = $_FILES['song_image']['name'];
    $song_image_tmp = $_FILES['song_image']['tmp_name'];
    move_uploaded_file($song_image_tmp,"img/$song_image");
    $song_audio = $_FILES['song_audio']['name'];
    $song_audio_tmp = $_FILES['song_audio']['tmp_name'];
    move_uploaded_file($song_audio_tmp,"music/$song_audio");

    $sql ="UPDATE song SET song_name = '$song_name',song_price = '$song_price',song_img = '$song_image',song_lyrics = '$song_lyrics',song_description = '$song_description',song_audio = '$song_audio',genre_id = '$genre_id',singer_id = '$singer_id' WHERE song_name = '$song_name'";
    $insert_song = mysqli_query($connect,$sql);
    if($insert_song){
        echo "<script>alert('Successfully!')</script>";
    }else {
        echo "<script>alert('Error!')</script>";
    }
}
?>
    
    </section>
</body>
</html>