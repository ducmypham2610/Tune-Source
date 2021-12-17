<?php 
	include("connect.php");
	if (isset($_GET["add_playlist"])) {	
		$song_id =  $_GET['add_playlist'];
		if (isset($_SESSION['username']) && $_SESSION['username'] != null){
			$user_id = $_SESSION['user_id'];
			$sql="select * from playlist where song_id = $song_id AND user_id='$user_id'";
			$result = mysqli_query($connect, $sql);
			$check_song = mysqli_num_rows($result);
			if ($check_song > 0) {
				echo "<script>alert('Song is already in the playlist')</script>";
			}
			else {
				$sql = "insert into playlist(user_id, song_id ) values ('$user_id',$song_id ) ";
				$result = mysqli_query($connect, $sql);	
				if ($result) {
					echo "<script>alert('Song added to the playlist successfully!')</script>";
				}
				else {
					echo "<script>alert('Error')</script>";
				}
			}
		}
		else {
			echo "<script>alert('You need to be logged in to perform this action')</script>";
			echo "<script>window.open('login.php','_self')</script>";
		}
	}					
?>