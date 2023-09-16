<?php

include 'connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
   header('location:login.php');
}
$count_content = $conn->prepare("SELECT * FROM 'content' WHERE tutor_id = ?");
$count_content->execute([$tutor_id]);
$total_contents = $count_content->rowCount();

$count_playlist = $conn->prepare("SELECT * FROM 'playlist' WHERE tutor_id = ?");
$count_playlist->execute([$tutor_id]);
$total_playlists = $count_playlist->rowCount();

$count_likes = $conn->prepare("SELECT * FROM 'likes' WHERE tutor_id = ?");
$count_likes->execute([$tutor_id]);
$total_likes = $count_playlist->rowCount();

$count_comment = $conn->prepare("SELECT * FROM 'comment' WHERE tutor_id = ?");
$count_comment->execute([$tutor_id]);
$total_comments = $count_comment->rowCount();



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>


<!-- profile section ends -->
<section class="profile">
   <h1 class="heading">profile details</h1>
   <div class="details">
<div class="tutor">
   <img src="../uploaded_files/<?= $fetch_profile['image'] ?>" alt="">
   <h3><?= $fetch_profile['name'] ?></h3>
   <span><?= $fetch_profile['profession'] ?></span>
   <a href="update.php" class="inline-btn">update profile</a>
</div>


   </div>
<div class="box-container">
<div class="box">
   <h3><?= $total_contents?></h3>
   <p>total comments</p>
   <a href="contents.php" class="btn">view contents</a>
</div>
<div class="box">
<h3><?= $total_playlists?></h3>
   <p>total playlists</p>
   <a href="playlists.php" class="btn">view playlists</a>
</div>










</section>











<!-- footer section starts  -->

<footer class="footer">

   &copy; copyright @ 2022 by <span>mr. web designer</span> | all rights reserved!

</footer>

<!-- footer section ends -->

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>