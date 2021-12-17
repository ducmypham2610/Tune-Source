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

    <h1 class="heading__primary">Add new song</h1>
    <form action="#" method ="POST" enctype="multipart/form-data" class="manage__form">   
    <label class="manage__label" for="name">Genre ID</label> 
    <select name="genre_id">
    <?php 
            include ("connect.php");
            $sql1 = "SELECT * FROM genre";
            $result = mysqli_query($connect, $sql1);
            while($row = mysqli_fetch_array($result)){
                $genre_id = $row['genre_id'];
                $genre_name = $row['name'];
        ?>
        <option value="<?php echo $genre_id ?>"><?php echo $genre_id; echo " " ; echo $genre_name ?></option>
        <?php } ?>
    </select><br><br>
    <label class="manage__label" for="name">Singer ID</label> 
    <select name="singer_id">
    <?php 
            include ("connect.php");
            $sql2 = "SELECT * FROM singer";
            $result = mysqli_query($connect, $sql2);
            while($row = mysqli_fetch_array($result)){
                $singer_id = $row['singer_id'];
                $singer_name = $row['singer_name'];
        ?>
        <option value="<?php echo $singer_id ?>"><?php echo $singer_id; echo " " ;echo $singer_name ?></option>
        <?php } ?>
    </select><br> <br>
    <label class="manage__label" for="name">Song's name</label> 
    <input type="text"  name="song_name" placeholder = "Name"><br><br>   
    <label class="manage__label" for="name">Price</label> 
    <input type="text" name="song_price" placeholder="Price"><br><br>  
    <label class="manage__label" for="name">Lyrics</label> 
    <input type="text" name="song_lyrics" placeholder="Lyrics"><br><br>
    <label class="manage__label" for="name">Description</label>   
    <input type="text"  name="song_description" placeholder = "Description"><br><br>
    <label class="manage__label" for="name">Image</label> 
    <input type="file"  name="song_image"><br><br>  
    <label class="manage__label" for="name">Audio</label> 
    <input type="file" name="song_audio"><br><br> 
    <input type="submit" name="insert_song" value = "Insert">
</form>
<?php
if(isset($_POST['insert_song'])){
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

    $sql ="INSERT INTO song(song_name,song_price,song_img,song_lyrics,song_description,song_audio,genre_id,singer_id) VALUES ('$song_name','$song_price','$song_image', '$song_lyrics','$song_description','$song_audio','$genre_id','$singer_id')";
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